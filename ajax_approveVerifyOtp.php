<?php
	include("config.php");
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	//require '../PHPMailer/src/PHPMailerAutoload.php';
	require '../PHPMailer/src/SMTP.php';
	
	if(isset($_POST['request_id'])){
	     
    	$request_id = $_POST['request_id']; 
    	$verifyto = $_POST['verifyto']; 
    	$franch_commission = $_POST['franch_commission']; 
    	$vinodOtp = $_POST['verifyotp1']; 
    	$muraliOtp = $_POST['verifyotp2']; 
    	$agreed_amount = $_POST['agreed_amount'];
    	$appointment_date = $_POST['appointment_date']; 
    	$renewal_date = $_POST['renewal_date'];
    	
    	
        $otp1 = mt_rand(1111,9999);
        $otp2 = mt_rand(1111,9999);
     
        $vinodmobile1  = '918008004474';
        //$vinodmobile1  = '918861656026';
        $muralimobile2 = '919901396644';
        //$muralimobile2 = '917744966820';
        
            $otpdel1 = "SELECT * FROM otp WHERE mobile = '$vinodmobile1' AND otp = '$vinodOtp' ";
		    $resdel1 = mysqli_query($conn,$otpdel1);
            $numotp1 = mysqli_num_rows($resdel1);
            if($numotp1 > 0){
                $outp1= 0;
            }else{
                $outp1= 3;
            }            
     	    $otpdel2 = "SELECT * FROM otp WHERE mobile = '$muralimobile2' AND otp = '$muraliOtp' ";
		    $resdel2 = mysqli_query($conn,$otpdel2);
            $numotp2 = mysqli_num_rows($resdel2);
            if($numotp2 > 0){
                $outp1= 0;
            }else{
                $outp1= 4;
            }  		            
        
       $outps = $outp1 + $outp2;
       if($outps == 0){
           
            $sql_accept = "update franchise_request set status='1' where request_id='$request_id'";
            $res_accept = mysqli_query($conn, $sql_accept);
            if ($res_accept)
            {
                $sql_fr_status="SELECT agreed_amount FROM franchiserequest_status WHERE id = '$verifyto'";
                $qry_fr_status = mysqli_query($conn, $sql_fr_status);
                $res_fr_status = mysqli_fetch_array($qry_fr_status);
                $agreed_amount = $res_fr_status['agreed_amount'];
                
                
                $sql_franch1 = "SELECT fr.*,frt.franchise,frt.code,u.name,u.mobile,u.email,u.id as user_id FROM franchise_request fr, franchise_type frt, users u WHERE fr.franchise_type_id=frt.id and fr.user_id=u.id and fr.request_id='$request_id'";
                $res_franch1 = mysqli_query($conn, $sql_franch1);
                $row = mysqli_fetch_array($res_franch1);
            
                $fr_id = $row["id"];
                $user_id = $row["user_id"];
                $name = $row["name"];
                $mobile = $row["mobile"];
                $uemail = $row["email"];
                $country_id = $row["country_id"];
                $state_id = $row["state_id"];  
                $franchise_type_id = $row['franchise_type_id'];
                $code = $row["code"]; 
                $request_id = $row["request_id"];
                
                if($franchise_type_id == 2){
                    $frcode = "SF-".$country_id."-".$state_id ;
                }else{
                    $frcode = "CF-".$country_id;
                }
                
                $refnumber = $code."-".rand(11111111,99999999);
          
                $password = md5('123456');
                $ins = "insert into franchise_users (user_id,password,name,mobile,email,franchise_type,country_id,state_id,commission,amount,frcode,status,created_date,expiry_date) values('$user_id', '$password','$name','$mobile','$uemail','$code', '$country_id', '$state_id','$franch_commission','$agreed_amount','$frcode','1','$appointment_date','$renewal_date')";
                 $resins = mysqli_query($conn, $ins);
    
                if ($resins)
                {

                    $sql_accept1 = "update franchiserequest_status set status='1' where id='$verifyto'";
                    $res_accept1 = mysqli_query($conn, $sql_accept1);

                    $sql_accept2 = "update users set isfranchise='1' , franchise_type_id='$franchise_type_id' where id='$user_id'";
                    $res_accept2 = mysqli_query($conn, $sql_accept2);
                    
                    $sql_accept3 = "update franchise_request set status ='1' where id='$fr_id'";
                    $res_accept3 = mysqli_query($conn, $sql_accept3);
                   
                    if($franchise_type_id == 2){
                        
                         
                        //Identifying Commission
                        
                        
                        $cfrcode = "CF-" . $country_id;
                        $getcf = "select * from franchise_users where frcode='$cfrcode'";
                        $resgetcf = mysqli_query($conn, $getcf);
                        if (mysqli_num_rows($resgetcf) > 0)
                        {
                            while ($rowcf = mysqli_fetch_assoc($resgetcf))
                            {
                                $franchise_id = $rowcf["id"];
                                $frcommission = $rowcf["commission"];
                            }
                        
                            $totalcommission = $agreed_amount * $frcommission / 100;
                            
                          
                        }
                        else {
                            $totalcommission = $agreed_amount * 4.5;
                        }
                        
                        //Identifying Commission code ends here
                        
                      
                        
                        //country Franchise Commission
                        
                        
                        $cfrcode = "CF-" . $country_id;
                        $getcf = "select * from franchise_users where frcode='$cfrcode'";
                        $resgetcf = mysqli_query($conn, $getcf);
                        if (mysqli_num_rows($resgetcf) > 0)
                        {
                            while ($rowcf = mysqli_fetch_assoc($resgetcf))
                            {
                                $franchise_id = $rowcf["id"];
                                $frcommission = $rowcf["commission"];
                            }
                        
                            $cfamount = $totalcommission-$sfamount;
                            
                            $payment_date = date("Y-m-d");
                            $cfcom = "insert into frachise_accounts (user_id,franchise_id,amount,payment_for,payment_date,status) values ('$user_id','$franchise_id','$cfamount','franchise deposit','$payment_date','0')";
                            $rscf = mysqli_query($conn, $cfcom);
                        
                        }
                        
                        //country franchise code ends here
                         $payment_date = date("Y-m-d");
                        //R&D Amount code starts here
                        
/*                        $rnd_amount = $agreed_amount*0.1;
                        $insrnd = "insert into rndfund (user_id,state,amount,country, payment_for,payment_date,status) values ('$user_id','$state_id','$rnd_amount','$country_id','franchise deposit','$payment_date','1') ";
                        $resrnd = mysqli_query($conn,$insrnd);
                        */
                        //R&D Amount code ends here
                        
                        
                        //EximBNI Account code starts here
                    //$exim_amount  = $agreed_amount-($cfamount+$rnd_amount);
                         $exim_amount  = $agreed_amount-($cfamount);
                         $eximcom = "insert into eximfund (user_id,state_id,country_id,payment_for,amount,status,payment_date) values ('$user_id','$state_id','$country_id','franchise deposit','$exim_amount','1','$payment_date')";
                            $resexim = mysqli_query($conn, $eximcom);
                        //EximBni code Ends Here
                     
                    }else{
                        
                          $payment_date = date("Y-m-d");
                           //R&D Amount code starts here
                        
/*                        $rnd_amount = $agreed_amount*0.1;
                        $insrnd = "insert into rndfund (user_id,state,amount,country, payment_for,payment_date,status) values ('$user_id','$state_id','$rnd_amount','$country_id','franchise deposit','$payment_date','1') ";
                        $resrnd = mysqli_query($conn,$insrnd);*/
                        
                        //R&D Amount code ends here                     
                        
                        //EximBNI Account code starts here
                       // $exim_amount  = $agreed_amount-($rnd_amount);
                         $exim_amount  = $agreed_amount;
                         $eximcom = "insert into eximfund (user_id,state_id,country_id,payment_for,amount,status,payment_date) values ('$user_id','$state_id','$country_id','franchise deposit','$exim_amount','1','$payment_date')";
                            $resexim = mysqli_query($conn, $eximcom);
                        //EximBni code Ends Here                     
                        
                        
                    }
                    
                            
                    $otpdel1 = "DELETE FROM otp WHERE mobile = '$vinodmobile1'";
        		    $resdel1 = mysqli_query($conn,$otpdel1);
             
             	    $otpdel2 = "DELETE FROM otp WHERE mobile = '$muralimobile2'";
        		    $resdel2 = mysqli_query($conn,$otpdel2);
        		            
                    
                    //email sending
    				$email = 'info@eximbin.com';
                    $password = 'EximBni.2020';
    				$to_email = $uemail;
    				$to_cc = 'miioslimited@gmail.com';
                    $to_bcc = 'muralimiios@gmail.com';
    				$message = "Your franchise request for  $frcode approved by admin and your Ref Number is : $refnumber ";
    				$subject = "Franchise Request Approved";
    					
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
    				$mail->Send(); 
    				
                    $outp = 1 ;
                } 
               
           }else{
               $outp = $outps;
           }
        	
        			
 	    }
 	    
 	          // $outp=json_encode($outp);
        echo $outp;
    	$conn->close();
 }
?>