<?php 
$message='';
	include("config.php");
	
	if(isset($_POST['payout']))
	{
		$id = $_POST['fr_id'];
		$amount = $_POST['amount'];
		$txn_date = $_POST['txn_date'];
		$txn_id = $_POST['txn_id'];
		$sql_payout = "INSERT INTO `franchise_payouts`(`franchise_id`, `payout`, `payout_date`, `txn_id`, `status`) values('$id','$amount','$txn_date','$txn_id','1')";
		$res_reject = mysqli_query($conn,$sql_payout);
		if($res_reject)
		{
			//Get Wallet Amount
			$sql_wallet = "SELECT * FROM `franchise_wallet` WHERE franchise_id='$id'";
			$res_wallet = mysqli_query($conn,$sql_wallet);
			$row_wallet = mysqli_fetch_array($res_wallet);
			$walletamt = $row_wallet['wallet'];
			
			$total = $walletamt - $amount;
			
			//update wallet
			$up_wallet = "update franchise_wallet set wallet='$total' where franchise_id='$id'";
			$res_up_wallet = mysqli_query($conn,$up_wallet);
			if($res_up_wallet)
			{
				$message="<div class='alert alert-success'>Payout Added Successfully</div>";
			}
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to add payout </div>";
			echo "Failed to reject franchise";
			echo mysqli_error($conn);
		}
	}
	
require "header1.php";
?>  
  <style>
  .di{ margin-right:38px;padding:6px;text-align:center;}
  </style>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Franchise Payouts</h1>
            <h4 style="color:red"><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Franchise </li>
              <li class="breadcrumb-item active">Franchise Payouts</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <section class="content">
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-md-2 di" id="p">New </div>
			</div>
            <div class="card">
                <div class="card-body table-responsive"> 
                    <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franchise Name</th>
						  <th>Mobile</th>
						  <th>Email</th>
						  <th>Country</th>
						  <th>State</th>
						  <th>Amount</th>
						  <th>Action</th>
						 
						</tr>
						</thead>
						<tbody>
							<?php
								include("config.php");
								$sql_franch = "select fr.*, fra.wallet, c.name as country, s.name as state from franchise_users fr, franchise_wallet fra, countries c, state s where fr.id = fra.franchise_id and fr.country_id=c.country_id and s.zone_id = fr.state_id";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
								<tr>
								  <td><?php echo $row_franch['id']; ?></td>
								  <td><?php echo $row_franch['name']; ?></td>
								  <td><?php echo $row_franch['mobile']; ?></td>
								  <td><?php echo $row_franch['email']; ?></td>
								  <td><?php echo $row_franch['country']; ?></td>
								  <td><?php echo $row_franch['state']; ?></td>
								  <td><?php echo $row_franch['wallet']; ?></td>
								  <input type="hidden" name="fr_id" value="<?php echo $row_franch['id']; ?>">	
								  <td><button type="button" data-toggle="modal" data-target="#exampleModal1" id="<?php echo $row_franch['id']; ?>" onclick="payout(this.id)" class="btn btn-outline-success btt">Pay Now</button> </td>
								</tr>
							<?php } ?>
						  
						</tbody>
					  </table>
                </div>
            </div>
        </div>
    </section>
    
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Payment</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="modal-body">
		<label>Amount</label>
		<input type="number" name="amount" onkeydown="return event.keyCode !=69" class="form-control" placeholder="Enter Amount">
		<label>Txn ID</label>
		<input type="text" name="txn_id" class="form-control" placeholder="Enter Transation ID">
		<label>Txn Date</label>
		<input type="date" name="txn_date" class="form-control" placeholder="Select Date">
		<input type="hidden" name="fr_id" id="fr_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
		<input type="submit" name="payout" class="btn btn-primary" value="Ok">
      </div>
	  </form>
    </div>
  </div>
</div>
</div>

<?php
require "footer1.php"
?>

<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function(){
	 
	  $("#approve").hide();
	  $("#rejected").hide();
	  $("#p").css("background", "white");
  $("#p").click(function(){
    $("#pending").show();
	$("#p").css("background", "white");
	$("#a").css("background", "none");
		$("#r").css("background", "none");
	$("#approve").hide();
	  $("#rejected").hide();
  });
  $("#a").click(function(){
    $("#approve").show();
	
		$("#p").css("background", "none");
		$("#r").css("background", "none");
		$("#a").css("background", "white");
	$("#pending").hide();
	 
	  $("#rejected").hide();
  });
  $("#r").click(function(){
    $("#rejected").show();
	
		$("#r").css("background", "white");
		$("#p").css("background", "none");
		$("#a").css("background", "none");
		
	$("#pending").hide();
	  $("#approve").hide();
  });
});
</script>
<script>
function payout(clicked_id)
{
	alert(clicked_id);
	document.getElementById("fr_id").value=clicked_id;
}
</script> 
