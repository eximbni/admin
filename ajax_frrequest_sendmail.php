<?php
date_default_timezone_set('Asia/Kolkata');
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

	include("config.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	//require '../PHPMailer/src/PHPMailerAutoload.php';
	require '../PHPMailer/src/SMTP.php';

	$to_email = $_POST['id'];

                //email sending
				$email = 'info123@eximbin.com';
                $password = 'EximBni.2020';
				$to_email = $to_email;
				$message = "Please fillup following form and send us on info@miioslimitted.com";
				$subject = "Fill up form and send us ";
					
				$mail = new PHPMailer(); // create a new object
				$mail->IsSMTP(); // enable SMTP
				$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
				$mail->SMTPAuth = true; // authentication enabled
				$mail->SMTPSecure = 'TLS'; // secure transfer enabled REQUIRED for Gmail
				$mail->Host = "mail.eximbin.com";
				$mail->Port = 587; // or 587
				$mail->IsHTML(true);
				$mail->Username = $email;
				$mail->Password = $password;
				$mail->SetFrom($email);
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->AddAddress($to_email);
				
    			if($mail->Send()){
                    $outp=1;
    			}else{
    			    $outp= 0;
    			}
    			
            	$outp=json_encode($outp);
            	echo $outp;
	
                $conn->close();

?>