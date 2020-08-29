<?php
	include("config.php");
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	//require '../PHPMailer/src/PHPMailerAutoload.php';
	require '../PHPMailer/src/SMTP.php';
	
	if(isset($_POST['id'])){
	    
	    $id = $_POST['id'];
    	$request_id = $_POST['request_id'];
    	$request_userid = $_POST['request_userid'];
    	$comments_by = $_POST['comments_by'];
    	$comments = $_POST['salehead_comment'];
    	$proposed_amount = $_POST['proposed_amount'];
    	$last_followup = $_POST['last_followup'];
    	$followup_by = $_POST['followup_by'];
    	$followup_type = $_POST['followup_type'];
    	$agreed_amount = $_POST['agreed_amount'];
    	
    	$remarks = $_POST['remarks'];

    	$created_date = date('Y-m-d H:i:s');
    	
        $sql_fs = "SELECT * FROM franchiserequest_status WHERE request_id ='$request_id' AND request_user_id ='$request_userid' ";
        
        $qry_fs = mysqli_query($conn,$sql_fs);
        $num_fs = mysqli_num_rows($qry_fs);
        
        if($num_fs == 0){
            
            $sql_accept = "update franchise_request set status='3' where request_id='$request_id'";
            $res_accept = mysqli_query($conn, $sql_accept);
            if ($res_accept)
            {
                $sqlcheck = "INSERT INTO `franchiserequest_status` (`request_id`,`request_user_id`, `comments_by`, `comments`, `proposed_amount`, `last_followup`, `followup_by`, `followup_type`, `agreed_amount`, `status`, `created_date`) VALUES ('$request_id','$request_userid', '$comments_by', '$comments', '$proposed_amount', '$last_followup', '$followup_by', '$followup_type', '$agreed_amount', '0', '$created_date')";			
                $resquery = mysqli_query($conn, $sqlcheck);
                if($resquery){
                
                	$get_email = "SELECT email FROM users WHERE id = '$request_userid' ";
            	    $res_email = mysqli_query($conn,$get_email);
                    $row_email = mysqli_fetch_array($res_email);
                    $to_email = $row_email['email'];                
                
                    //email sending
    				$email = 'info@eximbin.com';
                    $password = 'EximBni.2020';
    				$to_email = $to_email;
    			    $to_cc = 'miioslimited@gmail.com';
                    $to_bcc = 'muralimiios@gmail.com';
    				$message = "Your franchise request for $request_id is update to  Approval Process.";
    				$subject = "Franchise Request for $request_id status ";
    					
    				$mail = new PHPMailer(); // create a new object
    				$mail->IsSMTP(); // enable SMTP
    				$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    				$mail->SMTPAuth = true; // authentication enabled
    				$mail->SMTPSecure = 'TLS'; // secure transfer enabled REQUIRED for Gmail
    				$mail->Host = "mail.eximbin.com";
    				$mail->Port = 25; // or 587
    				$mail->IsHTML(true);
    				$mail->Username = $email;
    				$mail->Password = $password;
    				$mail->SetFrom($email);
    				$mail->Subject = $subject;
    				$mail->Body = $message;
    				$mail->AddAddress($to_email);
            		$mail->AddCC($to_cc);
            		$mail->AddBCC($to_bcc);
        			if($mail->Send()){
                        $outp=1;
        			}else{
        			    $outp= 0;
        			}       				
    			//email sending	
                
                    $outp=1;
                }else{
                    $outp= 0;
                } 
                
                
            }else{
                $outp= $sql_accept;
                
            }         
            
            
        }else{
            $outp= 0;
        }
        

        			
        $outp=json_encode($outp);
        echo $outp;
    	$conn->close();

	}
?>