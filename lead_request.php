<?php 
   session_start();  
   $message = '';
   include("config.php");
   include("fcmpush.php");
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   	
   require '../PHPMailer/src/Exception.php';
   require '../PHPMailer/src/PHPMailer.php';
   //require 'PHPMailer/src/PHPMailerAutoload.php';
   require '../PHPMailer/src/SMTP.php';
   
   	
   	if(isset($_POST['otp_approve_lead']))
   	{
   		$lead_id = $_POST['approve_lead_id'];
   		$lead_cost = $_POST['lead_cost'];
   		$posted_date = date("Y-m-d H:i:00");
   		
   		$sql_accept = "update leads set status='1', lead_cost='$lead_cost' where id='$lead_id'"; 
   		$res_accept = mysqli_query($conn,$sql_accept);
   		if($res_accept)
   		{
   			$sql_postedby = "select u.email, u.id, u.country_id, l.leadref_id from leads l, users u where l.posted_by=u.id and l.id='$lead_id'";
   			$res_postedby = mysqli_query($conn,$sql_postedby);
   			$row_postedby = mysqli_fetch_array($res_postedby);
   			$uemail = $row_postedby['email'];
   			$posted_by = $row_postedby['id'];
   			$user_country = $row_postedby['country_id'];
   			$leadref_id = $row_postedby['leadref_id'];
   			//email sending
   
               $email = 'noreply@eximbni.com';
               $password = '@team&1234';
               $to_email = $uemail;
              // $to_cc = 'ganesh.vab@gmail.com';
   			$message = "Your lead request for $leadref_id is approved by admin";
   			$subject = "Lead $leadref_id Approved";
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
   			$mail->Send();
   
   
   
   
   			//email sending
   			
   			//FCM Push Notification
   			$fcmid ="select * from users where id='$posted_by' and device_id !='' ";
               $resid = mysqli_query($conn,$fcmid);
               if($resid){
                   while($furow = mysqli_fetch_assoc($resid)){
                       $id[]=$furow["device_id"];
                   }
               }
               $title = $subject;
   			$push_message = $message;
               fcm($push_message,$id,$title);
   			
   	  $ins_inbox= "INSERT INTO `inbox` (`user_id`, `country_id`, `title`, `notification`, `type`, `created`) VALUES ('$posted_by', '$user_country', '$subject', '$message', '1', '$posted_date')";
   	  $result_inbox = mysqli_query($conn,$ins_inbox);
   		
   	  $ins_unotify= "INSERT INTO `user_notification` (`user_id`, `country_id`, `title`, `notification`, `type`, `created`) VALUES ('$posted_by', '$user_country', '$subject', '$message', '1', '$posted_date')";
   	  $result_unotify = mysqli_query($conn,$ins_unotify);
         	
   			
   			
   			$message="<div class='alert alert-success'>Lead Approved</div>";
   			//echo "lead approved";
   		}
   		else
   		{
   			$message="<div class='alert alert-danger'>Failed to approve lead </div>";
   			//echo "Failed to approve lead";
   			//echo mysqli_error($conn);
   		}
   	}
   	
   	if(isset($_POST['approve_lead']))
   	{
   		//echo "hi";
   		$lead_id = $_POST['approve_lead_id'];
   		$lead_cost = $_POST['lead_cost'];
   		$posted_date = date("Y-m-d H:i:00");
   		
   		$lead_otp = "select * from leads where id='$lead_id' and status='2'";
   		$res_chkotp = mysqli_query($conn, $lead_otp);
   		$count_chkotp = mysqli_num_rows($res_chkotp);
   		if($count_chkotp==1) 
   		{
   			$sql_accept = "update leads set status='1', lead_cost='$lead_cost' where id='$lead_id'"; 
   			$res_accept = mysqli_query($conn,$sql_accept);
   			if($res_accept)
   			{
   				$sql_postedby = "select u.email, u.id, u.country_id, l.leadref_id from leads l, users u where l.posted_by=u.id and l.id='$lead_id'";
   				$res_postedby = mysqli_query($conn,$sql_postedby);
   				$row_postedby = mysqli_fetch_array($res_postedby);
   				$uemail = $row_postedby['email'];
       			$posted_by = $row_postedby['id'];
       			$user_country = $row_postedby['country_id'];
       			$leadref_id = $row_postedby['leadref_id'];				
   				
               $email = 'noreply@eximbni.com';
               $password = '@team&1234';
               $to_email = $uemail;
               $to_cc = 'ganesh.vab@gmail.com';
   			$message = "Your lead request for $leadref_id is approved by admin";
   			$subject = "Lead $leadref_id Approved";
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
   			$mail->Send();
   
   
   				//email sending
   				
   				//FCM Push Notification
       			$fcmid ="select * from users where id='$posted_by' and device_id !='' ";
                   $resid = mysqli_query($conn,$fcmid);
                   if($resid){
                       while($furow = mysqli_fetch_assoc($resid)){
                           $id[]=$furow["device_id"];
                       }
                   }
                   $push_message = "Your lead request for $leadref_id is rejected by admin";
   				$title = "Lead $leadref_id Rejected";
                   fcm($push_message,$id,$title);
   	
   				
   	  $ins_inbox= "INSERT INTO `inbox` (`user_id`, `country_id`, `title`, `notification`, `type`, `created`) VALUES ('$posted_by', '$user_country', '$subject', '$message', '1', '$posted_date')";
   	  $result_inbox = mysqli_query($conn,$ins_inbox);
   		
   	  $ins_unotify= "INSERT INTO `user_notification` (`user_id`, `country_id`, `title`, `notification`, `type`, `created`) VALUES ('$posted_by', '$user_country', '$subject', '$message', '1', '$posted_date')";
   	  $result_unotify = mysqli_query($conn,$ins_unotify);
         	
   				
   				$message="<div class='alert alert-success'>Lead Approved</div>";
   				//echo "lead approved";
   			}
   			else
   			{
   				$message="<div class='alert alert-danger'>Failed to approve lead </div>";
   				//echo "Failed to approve lead";
   				//echo mysqli_error($conn);
   			}
   		}
   		else
   		{
   			$message = "<div class='alert alert-danger'>User not verify the otp.</div>";
   		}
   	}
   	
   	if(isset($_POST['reject_lead']))
   	{
   		$lead_id = $_POST['reject_lead_id'];
   		$reason = $_POST['reason'];
   		$sql_reject = "update leads set status='99', reason='$reason' where id='$lead_id'";
   		$res_reject = mysqli_query($conn,$sql_reject);
   		if($res_reject)
   		{
   			//echo "lead rejected";
   			$message="<div class='alert alert-success'>Lead rejected</div>";
   			
   			//FCM Push Notification
   			$getuid = "select posted_by from leads where id='$lead_id'";
   			$resuid = mysqli_query($conn,$getuid);
   			$rowuid = mysqli_fetch_assoc($resuid);
   			$posted_by = $rowuid['posted_by'];
   			
   			$fcmid ="select * from users where id='$posted_by' and device_id !='' ";
               $resid = mysqli_query($conn,$fcmid);
               if($resid){
                   while($furow = mysqli_fetch_assoc($resid)){
                       $id[]=$furow["device_id"];
                   }
               }
   			
   			$sql_postedby = "select u.email, u.id, u.country_id, l.leadref_id from leads l, users u where l.posted_by=u.id and l.id='$lead_id'";
   			$res_postedby = mysqli_query($conn,$sql_postedby);
   			$row_postedby = mysqli_fetch_array($res_postedby);
   			$uemail = $row_postedby['email'];
       		$posted_by = $row_postedby['id'];
       		$user_country = $row_postedby['country_id'];
       		$leadref_id = $row_postedby['leadref_id'];				
   				
               $email = 'noreply@eximbni.com';
               $password = '@team&1234';
               $to_email = $uemail;
               $to_cc = 'ganesh.vab@gmail.com';
   			$message = "Your lead request for $leadref_id is rejected by admin";
   			$subject = "Lead $leadref_id Rejected";
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
   			$mail->Send();
   
   /*            $title = "Lead rejected";
   			$push_message = $message;
               fcm($push_message,$id,$title);*/
   			
   		}
   		else
   		{
   			$message="<div class='alert alert-danger'>Failed to reject lead </div>";
   			//echo "Failed to reject lead";
   			//echo mysqli_error($conn);
   		}
   	}
   	
   	if(isset($_POST['verified_otp']))
   	{
   		
   	}
   	
   	
   require "header1.php";
   
   ?>
  <style>
  .di{ margin-right:18px;padding:6px;text-align:center;}
  
 /* .pagination {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}*/
  
  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Lead Request</h1>
               <h4 style="color:red"><?php echo $message; ?></h4>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item">Leads </li>
                  <li class="breadcrumb-item active">Lead Request</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-2 di" id="p">Pending Leads</div>
            <div class="col-md-2 di" id="a">Approved Leads</div>
            <div class="col-md-2 di" id="r">Rejected Leads</div>
         </div>
      </div>
   </section>
  
    <section class="content" id="pendding">
      <div class="card">
         <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered" >
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Lead Age</th>
                     <th>Lead Type</th>
                     <th>Country</th>
                     <th>Ref ID</th>
                     <th>Posted By</th>
                     <th>HSN Code</th>
                     <th>Chapter</th> 
                     <th>Uom</th>
                     <th>Quantity</th>
                     <th>Description</th>
                     <th>Posted Date</th>
                     <th>Expiry Date</th> 
                     <th style="text-align:center">Action</th>
                     <th style="text-align:center">Reject</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=1; 
                     $sql_pend = "select l.*,u.name,co.name as country,ch.ch_description,uo.uom from leads l,users u, chapters ch, countries co, uoms uo where (l.status='0' or l.status='2') and l.posted_by=u.id and l.chapter_id=ch.id and  l.uom_id=uo.id and l.country_id=co.country_id order by l.id desc";
                     $res_pend = mysqli_query($conn,$sql_pend);
                     while($row_pend=mysqli_fetch_array($res_pend)) { 
                     	$status=$row_pend['status'];
                     ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $row_pend['lead_age'];?></td>
                     <td><?php echo $row_pend['lead_type']?></td>
                     <td><?php echo $row_pend['country']?></td>
                     <td><?php echo $row_pend['leadref_id']?></td>
                     <td><?php echo $row_pend['name']?></td>
                     <td><?php echo $row_pend['hsn_id']?></td>
                     <td><?php echo $row_pend['ch_description']?></td>
                     <td><?php echo $row_pend['uom']?></td>
                     <td><?php echo $row_pend['quantity']?></td>
                     <td><?php echo $row_pend['description']?></td>
                     <td><?php echo $row_pend['posted_date']?></td>
                     <td><?php echo $row_pend['expiry_date']?></td>
                     <?php  if($status==0) {?>
                     <td><button type="button" data-toggle="modal" data-target="#otpModal" id="<?php echo $row_pend['id']; ?>" onclick="verify_otp(this.id)" class="btn btn-outline-danger bt btn-sm">OTP Verify</button> </td>
                     <?php }else{ ?>
                     <td><button type="button" data-toggle="modal" data-target="#exampleModal" id="<?php echo $row_pend['id']; ?>" onclick="approve_lead(this.id)" class="btn btn-outline-success btn-sm">Approve</button> </td>
                     <?php } ?>
                     <td>
                        <button type="button" data-toggle="modal" data-target="#exampleModal1" id="<?php echo $row_pend['id']; ?>" onclick="reject_lead(this.id)" class="btn btn-outline-danger btn-sm">  Reject</button> 
                     </td>
                  </tr>
                  <?php $i++; } ?>
               </tbody>
            </table>
         </div>
         
      </div>
   </section>
 
   <section class="content" id="approve">
      <div class="card">
         <div class="card-body table-responsive">
            <table id="example3" class="table table-bordered" >
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Lead Type</th>
                     <th>Country</th>
                     <th>Posted For</th>
                     <th>Ref ID</th>
                     <th>Posted By</th>
                     <th>HSN Code</th>
                     <th>Chapter</th>
                     <th>Uom</th>
                     <th>Quantity</th>
                     <th>Description</th>
                     <th>Posted Date</th>
                     <th>Expiry Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=1;
                     include("config.php");
                     $sql_app = "select l.*,u.name,co.name as country,ch.ch_description,uo.uom from leads l,users u, chapters ch, countries co, uoms uo where l.status='1' and l.posted_by=u.id and l.chapter_id=ch.id and l.uom_id=uo.id and l.country_id=co.country_id order by l.id desc";
                     $res_app = mysqli_query($conn,$sql_app);
                     while($row_app=mysqli_fetch_array($res_app)) { 
                         $lead_id = $row_app['id'];
                     ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $row_app['lead_type']?></td>
                     <td><?php echo $row_app['country']?></td>
                     <td>
                        <?php
                           $sql_country = "select l.lead_id,l.country_id,co.name as country_name from lead_display_countries l, countries co where l.lead_id='$lead_id' and l.country_id=co.country_id";
                           $res_country = mysqli_query($conn,$sql_country);
                           while($row_country = mysqli_fetch_array($res_country))
                           {
                           echo $row_country['country_name'];echo "<br>";
                           }
                           ?>
                     </td>
                     <td><?php echo $row_app['leadref_id']?></td>
                     <td><?php echo $row_app['name']?></td>
                     <td><?php echo $row_app['hsn_id']?></td>
                     <td><?php echo $row_app['ch_description']?></td>
                     <td><?php echo $row_app['uom']?></td>
                     <td><?php echo $row_app['quantity']?></td>
                     <td><?php echo $row_app['description']?></td>
                     <td><?php echo $row_app['posted_date']?></td>
                     <td><?php echo $row_app['expiry_date']?></td>
                  </tr>
                  <?php $i++; } ?>
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
   </section>

   <section class="content" id="rejected">
      <div class="card">
         <div class="card-body table-responsive">
            <table id="example4" class="table table-bordered" >
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Lead Type</th>
                     <th>Country</th>
                     <th>Ref ID</th>
                     <th>Posted By</th>
                     <th>HSN Code</th>
                     <th>Chapter</th>
                     <!--th>Product</th-->
                     <th>Uom</th>
                     <th>Quantity</th>
                     <th>Description</th>
                     <th>Posted Date</th>
                     <th>Expiry Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=1;
                     include("config.php");
                     $sql_rej = "select l.*,u.name,h.hscode,h.english,co.name as country,ch.ch_description,uo.uom from leads l,users u,testhsncodes h, chapters ch,  countries co, uoms uo where l.status='99' and l.posted_by=u.id and l.hsn_id=h.hscode and l.chapter_id=ch.id and l.uom_id=uo.id and l.country_id=co.country_id order by l.id desc";
                     $res_rej = mysqli_query($conn,$sql_rej);
                     while($row_rej=mysqli_fetch_array($res_rej)) { ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $row_rej['lead_type']?></td>
                     <td><?php echo $row_rej['country']?></td>
                     <td><?php echo $row_rej['leadref_id']?></td>
                     <td><?php echo $row_rej['name']?></td>
                     <td><?php echo $row_rej['hscode']?></td>
                     <td><?php echo $row_rej['ch_description']?></td>
                     <!--td><?php echo $row_rej['english']?></td-->
                     <td><?php echo $row_rej['uom']?></td>
                     <td><?php echo $row_rej['quantity']?></td>
                     <td><?php echo $row_rej['description']?></td>
                     <td><?php echo $row_rej['posted_date']?></td>
                     <td><?php echo $row_rej['expiry_date']?></td>
                  </tr>
                  <?php $i++; } ?>
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
   </section>

    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
         	<div class="modal-content">
	         	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">	
		            <div class="modal-header">
		               <h5 class="modal-title" id="exampleModalLabel"><b>OTP Verify</b></h5>
		               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		               <span aria-hidden="true">&times;</span>
		               </button>
		            </div>
		            <div class="modal-body">	              
		                  <div class="row">
		                     <label>Mobile No.</label>&emsp;
		                     <p id="mobile_no"></p>
		                     &emsp;
		                     <input type="hidden" name="approve_lead_id" id="otp_lead_id" class="form-control">
		                     <label>Lead Cost</label>&nbsp;&nbsp;&nbsp;
		                     <input type="number" onkeydown="return event.keyCode !=69" class="form-control" name="lead_cost" placeholder="Enter Lead Cost" style="width:40%">
		                  </div>
		            </div>
	            	<div class="modal-footer">
	            		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	            		<!--button type="submit" name="approve_lead" class="btn btn-primary" data-dismiss="modal">Ok</button-->
	            		<input type="submit" name="otp_approve_lead" class="btn btn-primary" value="Apporve">
	            	</div>
	            </form>
         	</div>
        </div>
    </div>

   	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
         	<div class="modal-content">
	         	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		            <div class="modal-header">
		               <h5 class="modal-title" id="exampleModalLabel"><b>Lead Cost</b></h5>
		               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		               <span aria-hidden="true">&times;</span>
		               </button>
		            </div>
		            <div class="modal-body">
		                  <input type="number" onkeydown="return event.keyCode !=69" class="form-control" name="lead_cost" placeholder="Enter Lead Cost">
		                  <input type="hidden" name="approve_lead_id" id="approve_lead_id" class="form-control">
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		            	<!--button type="submit" name="approve_lead" class="btn btn-primary" data-dismiss="modal">Ok</button-->
		            	<input type="submit" name="approve_lead" class="btn btn-primary" value="Ok">
		            </div>
	            </form>
         	</div>
      	</div>
   	</div>

   	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
         	<div class="modal-content">
         		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		            <div class="modal-header">
		               <h5 class="modal-title" id="exampleModalLabel"><b>Reason</b></h5>
		               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		               <span aria-hidden="true">&times;</span>
		               </button>
		            </div>
               		<div class="modal-body">
                  		<input type="text" class="form-control" placeholder="Ente Reason" name="reason" required>
                  		<input type="hidden" name="reject_lead_id" id="reject_lead_id" class="form-control">
               		</div>
               		<div class="modal-footer">
                  		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  		<!--button type="submit" name="reject_lead" class="btn btn-primary">Ok</button-->
                  		<input type="submit" name="reject_lead" class="btn btn-primary" value="Ok">
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
  
<script type="text/javascript">
$(document).ready(function(){
   //	 alert();
   	$("#approve").hide();
   	$("#rejected").hide();
   	$("#p").css("background", "white");
    
    $("#p").click(function(){
    	$("#pendding").show();
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
   		$("#pendding").hide();
   		$("#rejected").hide();
    });

    $("#r").click(function(){
        $("#rejected").show();   	
   		$("#r").css("background", "white");
   		$("#p").css("background", "none");
   		$("#a").css("background", "none");   		
   		$("#pendding").hide();
   	  	$("#approve").hide();
    });

});
</script>
<script>

   function approve_lead(clicked_id)
   {
   	//alert(clicked_id);
   	document.getElementById("approve_lead_id").value=clicked_id;
   }
   function verify_otp(clicked_id)
   {
   	//alert(clicked_id);
   	document.getElementById("otp_lead_id").value=clicked_id;
   	$.ajax({
   		type:"POST",
   		url:"get_number.php",
   		data:{
   			lead_id:clicked_id
   		},
   		dataType:'json',
   		success:function(response)
   		{
   			$("#mobile_no").empty();
   			console.log("Mobile=",response);
   			$("#mobile_no").append(response);
   		},
   		error:function(error)
   		{
   			console.log(error);
   		},
   	});
   }
   function reject_lead(clicked_id)
   {
   	//alert(clicked_id);
   	document.getElementById("reject_lead_id").value=clicked_id;
   }
   
   function verified_otp(clicked_id)
   {
   	
   	document.getElementById('otp_lead_id').value=clicked_id;
   }
</script>