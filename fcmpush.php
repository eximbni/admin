<?php
#prep the bundle
function fcm($fmessage,$id,$title){
	 foreach ($id as $ids) {
     $msg = array
          (
		'body' 	=> $fmessage,
		'title'	=> $title
             	
          );
	$fields = array
			(
				'to'=> $ids,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' ."AAAARgssQZA:APA91bHH5fcXuC8WJGe3DM2HxZhHqcau-128aCftQ_O50Db0skmYGCa-4yvc45aLPXGt1zq9yTBvmYUXt9JIuJ6ihOnyLU9xV_KpWfcPY6t_ltIg1M4bGRZuefR6dbnGcBTng3rWIHzy",
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		$result= array($result);
		curl_close( $ch );
}
}

?>