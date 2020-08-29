<?php
	include("config.php");
	
	if(isset($_POST['request_id'])){
	     
    	$request_id = $_POST['request_id']; 
    	
        $otp1 = mt_rand(1111,9999);
        $otp2 = mt_rand(1111,9999);
     
        $vinodmobile1  = '918008004474';
        //$vinodmobile1  = '918861656026';
        $muralimobile2 = '919901396644';
        //$muralimobile2 = '917744966820';
        
        

            $otpdel1 = "DELETE FROM otp WHERE mobile = '$vinodmobile1'";
		    $resdel1 = mysqli_query($conn,$otpdel1);
     
     	    $otpdel2 = "DELETE FROM otp WHERE mobile = '$muralimobile2'";
		    $resdel2 = mysqli_query($conn,$otpdel2);
		            
        
     
        $msg1 = "Franchise with ReqID: $request_id has completed payment. Please share OTP to to activate Franchise. Your EXIMBNI verification OTP code is ".$otp1.". Please DO NOT share this OTP with anyone.";
		$msg1 = urlencode($msg1);
		
		$msg2 = "Franchise with ReqID: $request_id has completed payment. Please share OTP to to activate Franchise. Your EXIMBNI verification OTP code is ".$otp2.". Please DO NOT share this OTP with anyone.";
		$msg2 = urlencode($msg2);
     
     	    $otpins1 = "insert into otp (mobile, otp) values('$vinodmobile1','$otp1')";
		    $resotp1 =mysqli_query($conn,$otpins1);
     
     	    $otpins2 = "insert into otp (mobile, otp) values('$muralimobile2','$otp2')";
		    $resotp2 =mysqli_query($conn,$otpins2);
		    
		    $otpurl1 = "http://sms.datagenit.in/API/sms-api.php?auth=D!~3727SzpGFICCeC&msisdn=".$vinodmobile1."&senderid=SMSOTP&message=".$msg1;
	        $res1 = file_get_contents($otpurl1);
            if($res1){
                $outp1=1;
            }else{
                $outp1= 0;
            }
            	        
		    $otpurl2 = "http://sms.datagenit.in/API/sms-api.php?auth=D!~3727SzpGFICCeC&msisdn=".$muralimobile2."&senderid=SMSOTP&message=".$msg2;
	        $res2 = file_get_contents($otpurl2);
            if($res2){
                $outp2=1;
            }else{
                $outp2= 0;
            }            
       
       $outp = $outp1 + $outp2;
       
        			
      //  $outp=json_encode($outp);
        echo $outp;
    	$conn->close();

	}
?>