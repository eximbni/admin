
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>Invoice</title>
		<!--link rel="stylesheet" href="style.css"-->
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		
		<style>
		    /* reset */

*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #f55656; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
		</style>
	</head>
	<body>
		<header>
			<h1>Invoice</h1>
			<span><img alt="" src="dist/img/eximlogos.png" width="200" style="margin-left: 55%;"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<?php
			    include('config.php');
				$id = $_GET['id'];
		        $sql_name = "SELECT u.name as user_name, u.business_address as business_address, u.business_name as business_name FROM franchiserequest_status fs, users u WHERE fs.id='$id' and fs.request_user_id=u.id";
		        $result_name = mysqli_query($conn,$sql_name);
		        while($row_name = mysqli_fetch_array($result_name))
		        {
		            $user_name = $row_name['user_name'];
		            $company_name = $row_name['business_name'];
		            $user_address = $row_name['business_address'];
		        }
		    ?>
				<b>Name :</b> <?php echo $user_name; ?><br/>
				<b>Company Name :</b> <?php echo $company_name; ?><br/>
				<b>Address :</b> <?php echo $user_address; ?><br/>
			<table class="meta">
			    <?php
			        include('config.php');
				    $id = $_GET['id'];
			        $sql_tot = "SELECT agreed_amount,transaction_date FROM `franchiserequest_status` WHERE id='$id'";
			        $result_tot = mysqli_query($conn,$sql_tot);
			        while($row_tot = mysqli_fetch_array($result_tot))
			        {
			            $transaction_date = $row_tot['transaction_date'];
			            $agreed_amount = $row_tot['agreed_amount'];
			        }
			    ?>
				<tr>
					<th><span>Invoice #</span></th>
					<td><span><?php echo $id; ?></span></td>
				</tr>
				<tr>
					<th><span>Date</span></th>
					<td><span><?php echo date('d-m-Y'); ?></span></td>
				</tr>
				<tr>
					<th><span>Amount Due</span></th>
					<td><span id="prefix">Rs.</span><span><?php echo $agreed_amount; ?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Sr.No.</span></th>
						<th><span>Description</span></th>
						<th><span>Amount</span></th>
						<th><span>Franchise Period</span></th>
						<th><span>Price</span></th>
					</tr>
				</thead>
				<tbody>
				    <?php 
				        include('config.php');
				        $id = $_GET['id'];
				        $sql_inv = "SELECT * FROM `franchiserequest_status` WHERE id='$id'";
				        $result_inv = mysqli_query($conn,$sql_inv);
				        while($row_inv = mysqli_fetch_array($result_inv))
				        {
				            $req_id = $row_inv['request_id'];
				            $agreed_amount = $row_inv['agreed_amount'];
				            $code = substr($req_id,0,2);
				            if($code=='CF')
				            {
				                $franch_type='Country Franchise';
				                $country_id = substr($req_id,3,3);
				                $sql_country = "SELECT * FROM `countries` WHERE country_id='$country_id'";
				                $result_country = mysqli_query($conn,$sql_country);
				                $row_country = mysqli_fetch_array($result_country);
				                $place = $row_country['name'];
				            }
				            else
				            {
				                $franch_type='State Franchise';
				                $country_id = substr($req_id,4,2);
				                $state_id = substr($req_id,9,1);
				                $sql_state = "SELECT * FROM `state` WHERE zone_id = '$state_id'";
				                $result_state = mysqli_query($conn,$sql_state);
				                $row_state = mysqli_fetch_array($result_state);
				                $place = $row_state['name'];
				            }
				        }
				    ?>
					<tr>
						<td>1</td>
						<td>Franchise request for <?php echo $place; ?> <?php echo $franch_type; ?></td>
						<td><?php echo $agreed_amount; ?></td>
						<td>12 Month</td>
						<td><?php echo $agreed_amount; ?></td>
					</tr>
				</tbody>
			</table>
		
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $agreed_amount; ?></span></td>
				</tr>
				<tr>
					<th><span>Tax Applicable</span></th>
					<td><span data-prefix>Rs.</span><span>0</span></td>
				</tr>
				<tr>
					<th><span>Grand Total</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $agreed_amount; ?></span></td>
				</tr>
			</table>
			
		</article>
		<button class="btn btn-primary" onclick="printwindow()" style="display:block; margin-top: 20%;margin-left: 47%;" name="print" id="print">Print</button>
	</body>
	<script>
	function printwindow()
	{
	    document.getElementById("print").style.display = "none";
	    window.print();
	    document.getElementById("print").style.display = "block";
	}
	
	</script>
</html>