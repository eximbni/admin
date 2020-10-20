<?php session_start(); ?>
<?php
$message = '';
include("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/PHPMailerAutoload.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['forward'])) {
    $id     = $_POST['forward_id'];
    $reason = $_POST['reason'];
    
    $sql_accept = "update franchise_request set status='2', reason='$reason' where id='$id'";
    $res_accept = mysqli_query($conn, $sql_accept);
    if ($res_accept) {
        
        $sql_users="select u.email,fr.request_id from franchise_request fr,users u where fr.id='$id' AND fr.user_id = u.id";
	    $chkres = mysqli_query($conn,$sql_users);
	    $count = mysqli_num_rows($chkres);
	    if($count>0){
	         $res_users =mysqli_fetch_array($chkres);
	         $uemail = $res_users['email'];
	         $urequest_id = $res_users['request_id'];
	    }        
        
        $message = "Your Franchise request for ".$urequest_id." is under process ";
		$subject = "Your Franchise request for ".$urequest_id." status ";
		
        $email = 'noreply@eximbni.com';
        $password = '@team&1234';
        $to_email = $uemail;
        $to_cc = 'miioslimited@gmail.com';
        $to_bcc = 'muralimiios@gmail.com';
        $message = $message;
        
		 	
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'none'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "mail.eximbni.com";
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->Username = $email;
		$mail->Password = $password;
		$mail->SetFrom($email);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($to_email);
        $mail->AddCC($to_cc);
        $mail->AddBCC($to_bcc);
		$mail->Send();       
      
        
        $message = "<div class='alert alert-success'>Franchise request Forwarded to sales department</div>";
        
    } else {
        $message = "<div class='alert alert-danger'>Failed to forward request to sales department<div>";
        //  echo "Failed to approve franchise";
        echo mysqli_error($conn);
    }
}

if (isset($_POST['reject'])) {
    $id         = $_POST['reject_id'];
    $reason     = $_POST['reason'];
    $sql_reject = "update franchise_request set status='99', reason='$reason' where id='$id'";
    $res_reject = mysqli_query($conn, $sql_reject);
    if ($res_reject) {
        
        $sql_users1="select u.email,fr.request_id from franchise_request fr,users u where fr.id='$id' AND fr.user_id = u.id";
	    $chkres1 = mysqli_query($conn,$sql_users1);
	    $count1 = mysqli_num_rows($chkres1);
	    if($count1>0){
	         $res_users1 =mysqli_fetch_array($chkres1);
	         $uemail = $res_users1['email'];
	         $urequest_id = $res_users1['request_id'];
	         
	    }          
        
        $message = "Your Franchise request for ".$urequest_id." is rejected ";
		$subject = "Your Franchise request for ".$urequest_id." status ";
		
        $email = 'noreply@eximbni.com';
        $password = '@team&1234';
        $to_email = $uemail;
        $to_cc = 'miioslimited@gmail.com';
        $to_bcc = 'muralimiios@gmail.com';
        $message = $message;
		 	
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'none'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "mail.eximbni.com";
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->Username = $email;
		$mail->Password = $password;
		$mail->SetFrom($email);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AddAddress($to_email);
        $mail->AddCC($to_cc);
        $mail->AddBCC($to_bcc);
		$mail->Send();          
        
        
        echo "Franchise Rejected";
        $message = "<div class='alert alert-success'>Franchise rejected</div>";
        
    } else {
        $message = "<div class='alert alert-danger'>Failed to reject franchise </div>";
        echo "Failed to reject franchise";
        echo mysqli_error($conn);
    }
}
?>  
  <style>
  .di{ margin-right:18px;padding:6px;text-align:center;}
  
  .pagination {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
  
  </style>
  

<?php
include "header.php";
?>

          <!-- /.navbar -->

          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <?php include("sidemenu.php"); ?>
         </aside>
            <div class="content-wrapper">
                 <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-left">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                          <li class="breadcrumb-item"><a href="">Franchise Module</a></li>
                          <li class="breadcrumb-item active">Request</li>
                        </ol>
                        <?php echo $message; ?>
                     </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-12">
                        <h4 style="text-align:center;"><b>Franchise Request</b></h4>
                      </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section>
                <div class="row">
                    <div class="col-md-2 di" id="p">Request Pending
                    </div>
                    <div class="col-md-2 di" id="up">Under Process
                    </div>                  
                    <div class="col-md-2 di" id="a">Approval
                    </div>
                    <div class="col-md-2 di" id="add">Activated Franchise
                    </div>
                        <div class="col-md-2 di" id="r">Rejected Franchise
                    </div>
                </div>
                
  
                </section>
            <section class="content" id="pending">
    
                  <div class="card">
                
          
               <div class="card-body table-responsive">
                      <table id="example1" class="table table-bordered" >
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Autogenerated ID</th>
                          <th>Franch Type</th>
                          <th>User Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Country</th>
                          <th>State</th> 
                          <th>View</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
<?php
$srno = 1;

$sql_franch = "SELECT fr.*,frt.franchise,frt.code,u.name,u.mobile,u.email,u.country_id as country, u.state_id as state FROM  franchise_request fr, franchise_type frt , users u WHERE  fr.franchise_type_id=frt.id and fr.user_id=u.id and fr.status='0'";
$res_franch = mysqli_query($conn, $sql_franch);
while ($row_franch = mysqli_fetch_array($res_franch)) {
    $franchise_type_id = $row_franch['franchise_type_id'];
    $country_id        = $row_franch['country_id'];
    $state_id          = $row_franch['state_id'];
    $user_country      = $row_franch['country'];
    $user_state        = $row_franch['state'];
    
    
    $user_countrysql = "SELECT s.name as state_name, c.name as country_name, co.continent as continent_name, se.gcontinent as region_name  FROM `countries` c, state s, continents co,sevencontinents se  WHERE c.country_id = s.country_id AND c.continent_id = co.id AND c.continent = se.id AND s.country_id='$user_country' AND s.zone_id='$user_state' LIMIT 0,1";
    $user_cquery     = mysqli_query($conn, $user_countrysql);
    $user_row        = mysqli_fetch_array($user_cquery);
    
    $user_country_name   = $user_row['country_name'];
    $user_state_name     = $user_row['state_name'];
    $user_continent_name = $user_row['continent_name'];
    $user_region_name    = $user_row['region_name'];
    
    if ($country_id != 0) {
        $countrys = "AND s.country_id='$country_id'";
    } else {
        $countrys = "";
    }
    
    if ($state_id != 0) {
        $states = "AND s.zone_id='$state_id'";
    } else {
        $states = "";
    }
    $fr_countrysql = "SELECT s.name as state_name, c.name as country_name FROM `countries` c, state s  WHERE c.country_id = s.country_id  $countrys $states  LIMIT 0,1";
    $fr_cquery     = mysqli_query($conn, $fr_countrysql);
    $fr_row        = mysqli_fetch_array($fr_cquery);
    
    $fr_country_name = $fr_row['country_name'];
    $fr_state_name   = $fr_row['state_name'];
    
    
    if ($franchise_type_id == '1') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = "";
        
    } elseif ($franchise_type_id == '2') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = $fr_state_name;
    } elseif ($franchise_type_id == '3') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = "";
    } elseif ($franchise_type_id == '4') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = "";
    } elseif ($franchise_type_id == '5') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = "";
    } elseif ($franchise_type_id == '6') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = "";
    } elseif ($franchise_type_id == '7') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = $fr_state_name;
    } elseif ($franchise_type_id == '8') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = $fr_state_name;
    } elseif ($franchise_type_id == '9') {
        $continent_name = "";
        $regional_name  = "";
        $country_name   = $fr_country_name;
        $state_name     = $fr_state_name;
    }
    
?>
                               <tr>
                                  <td><?php
    echo $srno;
?></td>
                                  <td><?php
    echo $row_franch['request_id'];
?></td>
                                  <td><?php
    echo $row_franch['franchise'];
?></td>
                                  <td><?php
    echo $row_franch['name'];
?></td>
                                  <td><?php
    echo $row_franch['mobile'];
?></td>
                                  <td><?php
    echo $row_franch['email'];
?>
                                   <input type="hidden" id="usersid<?= $row_franch['id']; ?>" value="<?= $row_franch['user_id']; ?>" >
                                    <input type="hidden" id="useremail<?= $row_franch['id']; ?>" value="<?= $row_franch['email']; ?>" >
                                    <input type="hidden" id="counid<?= $row_franch['id']; ?>" value="<?= $row_franch['country_id']; ?>" >
                                    <input type="hidden" id="statid<?= $row_franch['id']; ?>" value="<?= $row_franch['state_id']; ?>" >
                                    <input type="hidden" id="franchise_type<?= $row_franch['id']; ?>" value="<?= $row_franch['code']; ?>" >
                                  
                                  </td>
                                  <td><?= $country_name; ?></td>
                                  <td><?= $state_name; ?></td>
                                  <td><input type="button" class="btn btn-success" value="View" onclick="view_activate(<?= $row_franch['id']; ?>)" <?= $sts1;?> > </td>
                                  <td>
                                      <select class="form-control" name="actions" id="actions" onchange="pendingAction(this.value)" >
                                          <option value="" > Select </option>
                                          <option value="<?= $row_franch['id'] . ","; ?>1" > Forward </option>
                                          <option value="<?= $row_franch['id'] . ","; ?>2" > Reject </option>
                                          <option value="<?= $row_franch['id'] . ","; ?>3" > Send Mail </option>
                                          <option value="<?= $row_franch['id'] . ","; ?>4" > Current Status  </option>
                                          
                                      </select>
                                </td>  
                                </tr>
                            <?php
    $srno++;
}
?>
                         
                        </tbody>
                        
                        
                      </table>
                    </div>
                
            </div>
            </section>
            <section class="content" id="underprocess">
    
                  <div class="card">
                
          
               <div class="card-body table-responsive">
                      <table id="example2" class="table table-bordered ">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Request_ID</th>
                          <th>User_Comments</th>
                          <th>Proposed_Amount</th>
                          <th>Sales_Head_Comments</th>
                          <th>Agreed_Amount</th>
                          <th>Last_Followup</th>
                          <th>Followup_Type</th>
                          <th>Followup_By</th>
                          <th>Remarks </th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                       <?php
$srno = 1;

$sql_franch = "SELECT fr.*,frt.franchise,u.name FROM  franchise_request fr, franchise_type frt , users u WHERE  fr.franchise_type_id=frt.id and fr.user_id=u.id and fr.status='2' order by fr.id desc";
$res_franch = mysqli_query($conn, $sql_franch);
while ($row_franch = mysqli_fetch_array($res_franch)) {
   
   $request_id = $row_franch['request_id'];
   
   $sql_fs = "SELECT * FROM `franchiserequest_status` WHERE `request_id` ='$request_id'"; 
   $qry_fs = mysqli_query($conn, $sql_fs);
   $num_fs = mysqli_num_rows($qry_fs);
   
   if($num_fs =='0'){
        
    
?>
                           <tr>
                              <td><?php
    echo $srno;
?></td>
                              <td><?php
    echo $row_franch['request_id'];
?></td>
                              <td><?php
    echo $row_franch['reason'];
?></td>
                              <td><input class="form-control" name="proposed_amount<?= $row_franch['id'] ?>" id="proposed_amount<?= $row_franch['id'] ?>"  placeholder="Enter Proposed Amount" >
                              <input class="form-control" type="hidden" name="request_id<?= $row_franch['id'] ?>" id="request_id<?= $row_franch['id'] ?>" value="<?= $row_franch['request_id'] ?>" placeholder="Enter Proposed Amount" >
                              <input class="form-control" type="hidden" name="request_userid<?= $row_franch['id'] ?>" id="request_userid<?= $row_franch['id'] ?>" value="<?= $row_franch['user_id'] ?>" placeholder="Enter Proposed Amount" >
                              <input class="form-control" type="hidden" name="comments_by<?= $row_franch['id'] ?>" id="comments_by<?= $row_franch['id'] ?>"  value="<?= $_SESSION['user_id'] ?>" >
                              </td>
                            
                              <td><input class="form-control" name="salehead_comment<?= $row_franch['id'] ?>" id="salehead_comment<?= $row_franch['id'] ?>"  placeholder="Enter Sales Head Comment" ></td>
                              <td><input class="form-control" name="agreed_amount<?= $row_franch['id'] ?>" id="agreed_amount<?= $row_franch['id'] ?>"  placeholder="Enter Agreed Amount" ></td>
                              <td><input class="form-control" name="last_followup<?= $row_franch['id'] ?>" id="last_followup<?= $row_franch['id'] ?>"  placeholder="Enter Last Followup" ></td>                              
                                  <td>
                                      <select class="form-control" name="followup_type" id="followup_type<?= $row_franch['id'] ?>">
                                          <option value=" " > Select </option>
                                          <option value="Email" > Email </option>
                                          <option value="Mobile" > Mobile         </option>
                                          
                                      </select>
                                </td>                            
                              
                              <td><input class="form-control" name="followup_by<?= $row_franch['id'] ?>" id="followup_by<?= $row_franch['id'] ?>"  placeholder="Enter Last Followup By" ></td>
                              
                              <td><input class="form-control" name="remarks<?= $row_franch['id'] ?>" id="remarks<?= $row_franch['id'] ?>"  placeholder="Enter Remark" ></td>
                              <td><input type="button" class="btn btn-success" value="Update" onclick="approveRequest(<?php
    echo $row_franch['id'];
?>)"> </td>
                            </tr>
                        <?php
    $srno++;
    }
}
?>
                         
                        </tbody>
                        
                        
                      </table>
                      
                      
                      
                    </div>
                
            </div>
            </section>
            <section class="content" id="approve">
    
                  <div class="card">
                
          
               <div class="card-body table-responsive">
                      <table id="example3" class="table table-bordered">
                        <thead>
                        <tr>
                          <tr>
                          <th>Sr,No</th>
                          <th>Request User Name</th>
                          <th>Request ID</th>
                          <th>Proposed Amount</th>
                          <th>Agreed Amount</th>
                          <th>Generate Invoice</th>
                          <th>Activate Franchise</th>
                        
                        </tr>
                        
                        </tr>
                        </thead>
                        <tbody>
                          <?php
$srno = 1;

$sql_francha = "SELECT fs.*, u.name FROM  franchiserequest_status fs, users u WHERE fs.request_user_id=u.id  and fs.status='0' order by fs.id desc";
$res_francha = mysqli_query($conn, $sql_francha);
while ($row_francha = mysqli_fetch_array($res_francha)) {
    

 $request_id = $row_francha['request_id'];  
 $exp_res = explode('-', $request_id);
 
 $cf_type = $exp_res[0];
 $country_id = $exp_res[1];
 $state_id = $exp_res[2];
 
 if($cf_type == 'SF'){
      
     $sql_cfc = "SELECT commission,name FROM `franchise_users` WHERE country_id = '$country_id' AND franchise_type='CF' AND state_id =''";
     $qry_cfc = mysqli_query($conn,$sql_cfc);
     $num_cfc = mysqli_num_rows($qry_cfc);
     if($num_cfc > 0){
        $res_cfc = mysqli_fetch_array($qry_cfc);
        $cf_commission =  $res_cfc['name']." ( ".$res_cfc['commission']." ) ";
        
     }else{
       $cf_commission = "0";  
     }
    
     $sql_admu = "SELECT name, email FROM `admin_users` WHERE country_id = '$country_id' AND state_id ='$state_id'";
     $qry_admu = mysqli_query($conn,$sql_admu);
     $num_admu = mysqli_num_rows($qry_admu);
     if($num_admu > 0){
        $res_admu = mysqli_fetch_array($qry_admu);
        $stateIncharge_name =  $res_admu['name']." ( ".$res_admu['email']." )";
            
     }else{
        $stateIncharge_name =  "Incharge Not Available";
     }   
        $sql_admu1 = "SELECT name, email FROM `admin_users` WHERE country_id = '$country_id'";
         $qry_admu1 = mysqli_query($conn,$sql_admu1);
         $num_admu1 = mysqli_num_rows($qry_admu1);
         if($num_admu1 > 0){
            $res_admu1 = mysqli_fetch_array($qry_admu1);
            $countryIncharge_name =  $res_admu1['name']." ( ".$res_admu1['email']." )";
         }else{
            $countryIncharge_name =  "Incharge Not Available";
         }
 }else{
    $cf_commission = "0";  
    $stateIncharge_name =  "Incharge Not Available"; 
    
        $sql_admu1 = "SELECT name, email FROM `admin_users` WHERE country_id = '$country_id'";
         $qry_admu1 = mysqli_query($conn,$sql_admu1);
         $num_admu1 = mysqli_num_rows($qry_admu1);
         if($num_admu1 > 0){
            $res_admu1 = mysqli_fetch_array($qry_admu1);
            $countryIncharge_name =  $res_admu1['name']." ( ".$res_admu1['email']." )";
         }else{
            $countryIncharge_name =  "Incharge Not Available";
         }    
    
 } 

  $session_userid = $_SESSION['user_id'];
  $sql_admu12 = "SELECT name, email FROM `admin_users` WHERE id = '$session_userid'";
  $qry_admu12 = mysqli_query($conn,$sql_admu12);
  $num_admu12 = mysqli_fetch_array($qry_admu12);
  $approvedby_name =  $num_admu12['name'];

?>
                           <tr>
                              <td><?php
    echo $srno;
?></td>
                              <td><?php
    echo $row_francha['name'];
?></td>
                              <td><?php
    echo $row_francha['request_id'];
?>
                             <input class="form-control" type="hidden" id="country_fc<?= $row_francha['id'] ?>" value="<?= $cf_commission ?>" >
                             <input class="form-control" type="hidden" id="country_si<?= $row_francha['id'] ?>" value="<?= $countryIncharge_name ?>" >
                             <input class="form-control" type="hidden" id="state_si<?= $row_francha['id'] ?>" value="<?= $stateIncharge_name ?>" >
                             <input class="form-control" type="hidden" id="approved_person<?= $row_francha['id'] ?>" value="<?= $approvedby_name ?>" >
                             <input class="form-control" type="hidden" id="request_id<?= $row_francha['id'] ?>" value="<?= $row_francha['request_id'] ?>" >
                             <input class="form-control" type="hidden" id="agreed_amount<?= $row_francha['id'] ?>" value="<?= $row_francha['agreed_amount'] ?>" >
                              </td>
                              <td><?php
    echo $row_francha['proposed_amount'];
?></td>
                              <td><?php
    echo $row_francha['agreed_amount'];
?></td>
                              <td><input type="button" class="btn btn-info" value="Generate Invoice" onclick="generate(<?= $row_francha['id'] ?>)"> </td>
                              <td><input type="button" class="btn btn-success" value="Verify By Admin" onclick="verifyby(<?= $row_francha['id'] ?>)"> </td>
                            </tr>
                          <?php
    $srno++;
}
?>
                         
                        </tbody>
                        
                        
                      </table>
                    </div>
                
            </div>
            </section>
            <section class="content" id="additional">
    
                  <div class="card">
                
          
               <div class="card-body table-responsive">
                      <table id="example4" class="table table-bordered">
                        <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Request Id</th>
                          <th>Franch Type</th>
                          <th>User Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Country</th>
                          <th>State</th>
                          <th>Sales Team Incharge</th>
                          <th>Team Incharge Email</th>
                          <th>View Invoice</th>
                          <th>View Details</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $srno = 0;
                            $sql_franch = "SELECT fr.*,frt.franchise,frt.id as franchise_type_id FROM  franchise_users fr, franchise_type frt , users u WHERE  fr.franchise_type=frt.code and fr.user_id=u.id and fr.status='1'";
                            $res_franch = mysqli_query($conn, $sql_franch);
                            while ($row_franch = mysqli_fetch_array($res_franch)) {
                                
                                $srno++;
                                $franchise_type_id = $row_franch['franchise_type_id']; 
                                $country_id        = $row_franch['country_id'];
                                $state_id          = $row_franch['state_id']; 
                                $frcode          = $row_franch['frcode']; 
                                 
                                
                                $sql_frn_req = "SELECT id as franchise_reqid FROM `franchise_request` WHERE request_id like '$frcode%' AND status='1'";
                                $qry_frn_req = mysqli_query($conn,$sql_frn_req);
                                $num_frn_req = mysqli_num_rows($qry_frn_req);
                                if($num_frn_req > 0){
                                    $res_frn_req = mysqli_fetch_array($qry_frn_req);
                                    $franchise_reqid = $res_frn_req['franchise_reqid'];
                                    $sts = "";
                                }else{
                                    $franchise_reqid = "";
                                    $sts = "disabled";
                                }
                                
                                
                                $sql_frn_req1 = "SELECT id as franchise_statusid FROM `franchiserequest_status` WHERE request_id Like '$frcode%' AND status='1'";
                                $qry_frn_req1 = mysqli_query($conn,$sql_frn_req1);
                                $num_frn_req1 = mysqli_num_rows($qry_frn_req1);
                                if($num_frn_req1 > 0){
                                    $res_frn_req1 = mysqli_fetch_array($qry_frn_req1);
                                    $franchise_statusid = $res_frn_req1['franchise_statusid'];
                                    $sts1 = "";
                                }else{
                                    $franchise_statusid = "";
                                    $sts1 = "disabled";
                                }
                                
                                
                              
                                if ($country_id != 0) {
                                    $countrys = "AND s.country_id='$country_id'";
                                } else {
                                    $countrys = "";
                                }
                                
                                if ($state_id != 0) {
                                    $states = "AND s.zone_id='$state_id'";
                                } else {
                                    $states = "";
                                }
                                $fr_countrysql = "SELECT s.name as state_name, c.name as country_name FROM `countries` c, state s  WHERE c.country_id = s.country_id  $countrys $states  LIMIT 0,1";
                                $fr_cquery     = mysqli_query($conn, $fr_countrysql);
                                $fr_row        = mysqli_fetch_array($fr_cquery);
                                
                                $fr_country_name = $fr_row['country_name'];
                                $fr_state_name   = $fr_row['state_name'];
 
                                 if ($franchise_type_id == '1') { 
                                    $country_name   = $fr_country_name;
                                    $state_name     = "";
                                    
                                }else if($franchise_type_id == '2') { 
                                    $country_name   = $fr_country_name;
                                    $state_name     = $fr_state_name;
                                }else{
                                    $country_name   = ""; 
                                    $state_name     = ""; 
                                }                              
                                if($franchise_type_id == '1'){
                                    $sql_inname = "SELECT name as incharge_name, email as incharge_email FROM `admin_users` where country_id='$country_id'";
                                    $res_inname = mysqli_query($conn, $sql_inname);
                                    $row_inname = mysqli_fetch_array($res_inname);
                                    $incharge_name = $row_inname['incharge_name'];
                                    $incharge_email = $row_inname['incharge_email'];
                                }else if($franchise_type_id == '2')
                                {
                                    $sql_stateinname = "SELECT name as incharge_name, email as incharge_email FROM `admin_users` where state_id='$state_id'";
                                    $res_stateinname = mysqli_query($conn, $sql_stateinname);
                                    $row_stateinname = mysqli_fetch_array($res_stateinname);
                                    $incharge_name = $row_stateinname['incharge_name'];
                                    $incharge_email = $row_stateinname['incharge_email'];
                                }else{
                                    $incharge_name = "";
                                    $incharge_email = "";
                                }
                                // $country_name   = ""; 
                                // $state_name     = ""; 
                            ?>
                               <tr>
                                    <td><?= $srno; ?></td>
                                    <td><?= $row_franch['frcode'];?></td>
                                    <td><?= $row_franch['franchise'];?></td>
                                    <td><?= $row_franch['name']; ?></td>
                                    <td><?= $row_franch['mobile']; ?></td>
                                    <td><?= $row_franch['email']; ?></td>
                                    <td><?= $country_name; ?></td>
                                    <td><?= $state_name; ?></td>
                                    <td><?= $incharge_name; ?></td>
                                    <td><?= $incharge_email; ?></td>
                                    <td><input type="button" class="btn btn-info" value="View Invoice" onclick="generate_activate(<?= $franchise_statusid; ?>)" <?= $sts1;?> > </td>
                                    <td><input type="button" class="btn btn-success" value="View Details" onclick="view_activate(<?= $franchise_reqid; ?>)" <?= $sts1;?> > </td>
                                </tr>
                            <?php
                                }
                            ?>
                         
                        </tbody>
                        
                        
                      </table>
                    </div>
                
            </div>
            </section>
            
            <section class="content" id="rejected">
    
                  <div class="card">
                
          
               <div class="card-body">
                      <table id="example5" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Request Id</th>
                          <th>Franch Type</th>
                          <th>User Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Country</th>
                          <th>State</th>
                          <th>View Details</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $srno = 0;
                            $sql_franch = "SELECT fr.*,frt.franchise,u.name,u.mobile,u.email FROM  franchise_request fr, franchise_type frt , users u WHERE  fr.franchise_type_id=frt.id and fr.user_id=u.id and fr.status='99'";
                            $res_franch = mysqli_query($conn, $sql_franch);
                            while ($row_franch = mysqli_fetch_array($res_franch)) {
                                
                                $srno++;
                                $franchise_type_id = $row_franch['franchise_type_id']; 
                                $country_id        = $row_franch['country_id'];
                                $state_id          = $row_franch['state_id']; 
                                $frcode          = $row_franch['request_id']; 
                                 
                                
                                if ($country_id != 0) {
                                    $countrys = "AND s.country_id='$country_id'";
                                } else {
                                    $countrys = "";
                                }
                                
                                if ($state_id != 0) {
                                    $states = "AND s.zone_id='$state_id'";
                                } else {
                                    $states = "";
                                }
                                $fr_countrysql = "SELECT s.name as state_name, c.name as country_name FROM `countries` c, state s  WHERE c.country_id = s.country_id  $countrys $states  LIMIT 0,1";
                                $fr_cquery     = mysqli_query($conn, $fr_countrysql);
                                $fr_row        = mysqli_fetch_array($fr_cquery);
                                
                                $fr_country_name = $fr_row['country_name'];
                                $fr_state_name   = $fr_row['state_name'];
 
                                 if ($franchise_type_id == '1') { 
                                    $country_name   = $fr_country_name;
                                    $state_name     = "";
                                    
                                }else if($franchise_type_id == '2') { 
                                    $country_name   = $fr_country_name;
                                    $state_name     = $fr_state_name;
                                }else{
                                    $country_name   = ""; 
                                    $state_name     = ""; 
                                }                              
                                
                                // $country_name   = ""; 
                                // $state_name     = ""; 
                            ?>
                               <tr>
                                    <td><?= $srno; ?></td>
                                    <td><?= $frcode;?></td>
                                    <td><?= $row_franch['franchise'];?></td>
                                    <td><?= $row_franch['name']; ?></td>
                                    <td><?= $row_franch['mobile']; ?></td>
                                    <td><?= $row_franch['email']; ?></td>
                                    <td><?= $country_name; ?></td>
                                    <td><?= $state_name; ?></td>
                                     <td><input type="button" class="btn btn-success" value="View" onclick="view_activate(<?= $row_franch['id']; ?>)" > </td>
                                </tr>
                            <?php
                                }
                            ?>
                         
                        </tbody>
                        
                        
                      </table>
                    </div>
                
            </div>
            </section>
            </div>
            


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Forward Comments</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php
echo $_SERVER['PHP_SELF'];
?>" method="POST">
      <div class="modal-body">
        <input type="text"  class="form-control" placeholder="Enter Comments" name="reason" required autocomplete="off" size="10" >
        <input type="hidden" name="forward_id" id="forward_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
        <input type="submit" name="forward" class="btn btn-primary" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Reject Comments</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php
echo $_SERVER['PHP_SELF'];
?>" method="POST">
      <div class="modal-body">
        <input type="text"  class="form-control" placeholder="Enter Comments" name="reason" required autocomplete="off" size="10" >
        <input type="hidden" name="reject_id" id="reject_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
        <input type="submit" name="reject" class="btn btn-primary" value="Ok">
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b> Verify OTP and Approve Franchise Request. </b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label">Country Franchise Commissions</label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" name="country_franch_commission" id="country_franch_commission" readonly>
                </div>                
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label">Country Sales Incharge</label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" name="country_sales_incharge" id="country_sales_incharge" readonly>
                </div>                
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label">State Sales Incharge</label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" name="state_sales_incharge" id="state_sales_incharge" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label">Approved Person </label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" name="approved_person" id="approved_person" readonly>
                </div>              
            </div>
          </div>


          <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label"> Appointed Date</label>
                </div>
                <div class="col-md-12">
                    <input type="date"  class="form-control" name="appointment_date" id="appointment_date" required autocomplete="off" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label"> Renewal Date</label>
                </div>
                <div class="col-md-12">
                    <input type="date"  class="form-control" name="renewal_date" id="renewal_date" required autocomplete="off" >
                </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label"> Mr.Vinod OTP</label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" placeholder="Enter Mr.Vinod OTP" name="verifyotp1" id="verifyotp1" required autocomplete="off" maxlength="4"  >
                </div>             
            </div>    
            <div class="col-md-6">
                <div class="col-md-12">
                  <label class="label"> Mr.Murali OTP</label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" placeholder="Enter Mr.Murali OTP" name="verifyotp2" id="verifyotp2" required autocomplete="off" maxlength="4" >
                </div>
            </div>

          </div>

          <div class="row">
                 <div class="col-md-12">
                  <label class="label"> Franchise Commissions</label>
                </div>
                <div class="col-md-12">
                    <input type="text"  class="form-control" placeholder="Enter Franchise Commision" name="franch_commission" id="franch_commission" required autocomplete="off" size="10" >
                    <input type="hidden" name="verifyto" id="verifyto" class="form-control">
                    <input type="hidden" name="verify_referal_id" id="verify_referal_id" class="form-control" >
                    <input type="hidden" name="verify_agreed_amount" id="verify_agreed_amount" class="form-control" >
                </div>             
          </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
        <input type="button" name="verify" class="btn btn-success" value="Verify & Approve" onclick="verifyotpapprove()">
      </div>
      </form>
    </div>
  </div>
</div>






<!-- DataTables -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 
  
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->

<script type="text/javascript">

  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
     $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true, 
    });
    $('#example5').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      
    });    
    
  });
</script>

<script type="text/javascript">
$(document).ready(function(){
    
      $("#approve").hide();
      $("#rejected").hide();
      $("#additional").hide();
      $("#underprocess").hide();
      $("#p").css("background", "white");
      
      $("#p").click(function(){
        $("#pending").show();
        $("#p").css("background", "white");
        $("#up").css("background", "none");
        $("#a").css("background", "none");
        $("#r").css("background", "none");
        $("#add").css("background", "none");
          $("#approve").hide();
          $("#rejected").hide();
          $("#additional").hide();
          $("#underprocess").hide();
      });
      
      $("#a").click(function(){
        $("#approve").show();
            $("#p").css("background", "none");
            $("#r").css("background", "none");
            $("#up").css("background", "none");
            $("#a").css("background", "white");
            $("#add").css("background", "none");
            $("#pending").hide();
            $("#additional").hide();
            $("#rejected").hide();
            $("#underprocess").hide();
      });
      
      $("#r").click(function(){
            $("#rejected").show();
            $("#r").css("background", "white");
            $("#up").css("background", "none");
            $("#p").css("background", "none");
            $("#a").css("background", "none");
            $("#add").css("background", "none");
            $("#pending").hide();
            $("#approve").hide();
            $("#additional").hide();
            $("#underprocess").hide();
      });
      
    $("#add").click(function(){
        $("#additional").show();
        $("#add").css("background", "white");
        $("#r").css("background", "none");
        $("#up").css("background", "none");
        $("#p").css("background", "none");
        $("#a").css("background", "none");
        
        $("#pending").hide();
        $("#approve").hide();
        $("#rejected").hide();
        $("#underprocess").hide();
    });
 
     $("#up").click(function(){
        $("#underprocess").show();
        $("#add").css("background", "none");
        $("#r").css("background", "none");
        $("#up").css("background", "white");
        $("#p").css("background", "none");
        $("#a").css("background", "none");
        
        $("#additional").hide();
        $("#pending").hide();
        $("#approve").hide();
        $("#rejected").hide();
    });
    
});
</script>
<script type="text/javascript">
 
function pendingAction(selectedid){
   console.log(" values : ",selectedid);
   //alert("Hi"); 
var action = selectedid.split(",");
   console.log("action val : ",action );
   var rowsval = action["0"];
   var actionval = action["1"];
    console.log("rowsval val : ",rowsval );
    console.log("actionval val : ",actionval );
    if(actionval==1){
        $("#exampleModal").modal("show");
        $("#exampleModal1").modal("hide");
        document.getElementById("forward_id").value=rowsval;
        
    }else if(actionval==2){
        $("#exampleModal1").modal("show");
        $("#exampleModal").modal("hide");        
        document.getElementById("reject_id").value=rowsval;
        
    }else if(actionval==3){
        sendmail(rowsval);
        
    }else if(actionval==4){
        checkavailable(rowsval);
        
    }else{
        alert("Please select actions");
        return false;
    }
    
}
        

function approveRequest(clicked_id){
     

    var proposed_amount = $("#proposed_amount"+clicked_id).val();
    var salehead_comment = $("#salehead_comment"+clicked_id).val();
    var agreed_amount = $("#agreed_amount"+clicked_id).val();
    var last_followup = $("#last_followup"+clicked_id).val();
    var remarks = $("#remarks"+clicked_id).val();
    var request_id = $("#request_id"+clicked_id).val();
    var request_userid = $("#request_userid"+clicked_id).val();
    var followup_by = $("#followup_by"+clicked_id).val();
    var comments_by = $("#comments_by"+clicked_id).val();
    var followup_type = $("#followup_type"+clicked_id).val(); 
   
/*    
    console.log("Selected row is : "+clicked_id);
    console.log("request_id ",request_id);
    console.log("comments_by ",comments_by);
    console.log("request_userid ",request_userid);
    console.log("proposed_amount ",proposed_amount);
    console.log("salehead_comment ",salehead_comment);
    console.log("agreed_amount ",agreed_amount);
    console.log("last_followup ",last_followup);
    console.log("followup_type ",followup_type);
    console.log("followup_by ",followup_by);
    console.log("remarks ",remarks);
    */
    
    if(proposed_amount ==""){
        alert("Please enter proposed amount");
        $("#proposed_amount"+clicked_id).focus();
        return false;
    } 
    
    if(salehead_comment ==""){
        alert("Please enter sales head comment");
        $("#salehead_comment"+clicked_id).focus();
        return false;
    } 
    
    if(agreed_amount ==""){
        alert("Please enter agreed amount");
        $("#agreed_amount"+clicked_id).focus();
        return false;
    }

    
    if(last_followup ==""){
        alert("Please enter last followup");
        $("#last_followup"+clicked_id).focus();
        return false;
    }      
    
    if(followup_type ==""){
        alert("Please select followup type");
        $("#followup_type"+clicked_id).focus();
        return false;
    }
    
    
    if(followup_by ==""){
        alert("Please enter name of followup by");
        $("#followup_by"+clicked_id).focus();
        return false;
    }

    if(remarks ==""){
        alert("Please enter remarks");
        $("#remarks"+clicked_id).focus();
        return false;
    }
    
    
 
        $.post("ajax_updateRequest.php", {id:clicked_id,request_id:request_id,comments_by:comments_by,salehead_comment:salehead_comment, proposed_amount: proposed_amount,last_followup:last_followup,followup_by:followup_by,followup_type:followup_type, agreed_amount:agreed_amount, remarks:remarks,request_userid:request_userid}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 1){
               alert("Franchise request updated from under process to approval");
               window.location.href = "franchise_request.php";
               location.reload();
            }else if(resultdata == 2){
               alert("You are already updated franchise request.");
               window.location.href = "franchise_request.php";
            }else{
               alert("Something went wrong. Please try again."); 
               return false;
            }
        });    
    
    
}
 



function sendmail(clicked_id)
{
    console.log("Selected row is : "+clicked_id);
    var emailid = $("#useremail"+clicked_id).val();
    var userid = $("#usersid"+clicked_id).val();
    var counid = $("#counid"+clicked_id).val();
    var staeid = $("#statid"+clicked_id).val(); 
    var franid = $("#franchise_type"+clicked_id).val();
  
 
        $.post("ajax_frrequest_sendmail.php", {id: emailid}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 1){
               alert("Email sent Successfully");
              // location.reload();
            }else{
               alert("Email Not sent. Something went wrong"); 
               return false;
            }
        });
        
    
}
 
 
function checkavailable(clicked_id)
{

    console.log("Selected row is : "+clicked_id);
    var emailid = $("#useremail"+clicked_id).val();
    var userid = $("#usersid"+clicked_id).val();
    var counid = $("#counid"+clicked_id).val();
    var staeid = $("#statid"+clicked_id).val();
    var franid = $("#franchise_type"+clicked_id).val();
  
 
        $.post("ajax_checkFranchiseAvailability.php", {franid: franid,counid:counid,staeid:staeid}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 1){
               alert("Franchise users not appointed. You can appoint new user for this post.");
               //location.reload();
            }else{
               alert("Franchise users already appointed. You cann't appoint new user for this post."); 
               return false;
            }
        });

}

function generate(clicked_id){
    
    var request_id = $("#request_id"+clicked_id).val();
    window.location.href = "invoice.php?id="+clicked_id;
        
}

function generate_activate(clicked_id){
    
    var request_id = $("#request_id"+clicked_id).val();
    window.location.href = "invoice.php?id="+clicked_id;
        
}


function view_activate(clicked_id){
    
    var request_id = $("#request_id"+clicked_id).val();
    window.location.href = "show_franch_details.php?id="+clicked_id;
        
}

function verifyby(clicked_id){
    
        var request_id = $("#request_id"+clicked_id).val();
        var agreed_amount = $("#agreed_amount"+clicked_id).val();
        var country_fc =  $("#country_fc"+clicked_id).val();
        var country_si = $("#country_si"+clicked_id).val();
        var state_si = $("#state_si"+clicked_id).val();
        var approved_person  = $("#approved_person"+clicked_id).val();
       //alert(agreed_amount);
       // $("#verifyModal").modal("show");  
       // $("#verifyto").val(clicked_id); 
        $("#verify_referal_id").val(request_id); 
        $("#verify_agreed_amount").val(agreed_amount);  
        $("#country_franch_commission").val(country_fc);
        $("#country_sales_incharge").val(country_si);
        $("#state_sales_incharge").val(state_si);
        $("#approved_person").val(approved_person);
                
         $.post("ajax_sendotptoadmin.php", {request_id: request_id}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 2){
               alert("OTP Sent on Admin contact number.");
                $("#verifyModal").modal("show");  
                $("#verifyto").val(clicked_id); 
            }else{
               alert("Something went wrong, Please try again."); 
               return false;
            }
        });  
         
}


function verifyotpapprove(){
    
        var franch_commission = $("#franch_commission").val();
        var verifyto = $("#verifyto").val();
        var verify_referal_id = $("#verify_referal_id").val();
        var agreed_amount = $("#verify_agreed_amount").val();
        var appointment_date = $("#appointment_date").val();
        var renewal_date = $("#renewal_date").val();
        
        var verifyotp1 = $("#verifyotp1").val();
        var verifyotp2 = $("#verifyotp2").val();
 
/*    console.log("franch_commission ",franch_commission);
    console.log("verifyto ",verifyto);
    console.log("verify_referal_id ",verify_referal_id);
    console.log("agreed_amount ",agreed_amount);
    console.log("verifyotp1 ",verifyotp1);
    console.log("verifyotp2 ",verifyotp2); */      
        
    if(appointment_date ==""){
        alert("Please select appointment date");
        $("#appointment_date").focus();
        return false;
    }
     
    if(renewal_date ==""){
        alert("Please select renewal date");
        $("#renewal_date").focus();
        return false;
    }
               
    if(verifyotp1 ==""){
        alert("Please enter mr.vinod otp");
        $("#verifyotp1").focus();
        return false;
    }

    if(verifyotp2 ==""){
        alert("Please enter mr.murali otp");
        $("#verifyotp2").focus();
        return false;
    }
    if(franch_commission ==""){
        alert("Please enter franchise commission");
        $("#franch_commission").focus();
        return false;
    }
       

        $.post("ajax_approveVerifyOtp.php", {request_id: verify_referal_id,franch_commission : franch_commission,verifyto:verifyto, verifyotp1 : verifyotp1,verifyotp2 : verifyotp2, agreed_amount : agreed_amount  , appointment_date : appointment_date, renewal_date : renewal_date}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 1){
               alert("Franchise request approved successfully.");
                location.reload();
            }else if(resultdata == 3){
               alert("Mr.Vinod OTP is not verify. Invalid OTP"); 
               return false;
            }else if(resultdata == 4){
               alert("Mr.Murali OTP is not verify. Invalid OTP");
                return false;
            }else if(resultdata == 7){
               alert("Both OTP's invalid.");
                return false;
            }else{
               alert("Something went wrong, Please try again."); 
               return false;
            }
        });  
        
}
</script>
</body>
</html>