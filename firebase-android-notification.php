<?php 

function notifyAndroid($message,$fire_base_id,$activity = null){
	$server_id = "AAAA2wdwfnk:APA91bENJ70vfYq2aIdzWngNBCtEvvCKuRFcFGsmbel-4xMqV-nkPTfpZymq1aoLPAdTFA_0xylkeVQ_Wx44Yy4G701XXiD0LTfJDMnxrgN3AFt07yMp-e62pzlIkFYF8Hdrf3IAJV3-ur1k1oeRblRSp_iWACDYSw";

	if(is_null($activity)){
		$msg = array
		(   
			'body' => $message,
			'title' => 'New Notification From BIPE ERP',
			'icon'  => 'myicon',
			'sound' => 'mySound'
		);
	}else{
		$msg = array
		(   
			'body' => $message,
			'title' => 'New Notification From BIPE ERP',
			'icon'  => 'myicon',
			'sound' => 'mySound',
			'click_action' => $activity
		);
	}
	$fields = array
	(
		'to'        => $fire_base_id,
		'notification'  => $msg
	);
	$headers = array
	(
		'Authorization: key=' . $server_id,
		'Content-Type: application/json'
	);
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);
	$stdObject = json_decode($result);
	if($stdObject->success){
		return true;
	}else{
		return false;
	}
}

?>