<?php
try
{
	$url1 = "curl -L https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";
	$url = "https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	//curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	//curl_setopt($curl, CURLOPT_HEADER, true);// this changes response to x-formulated data type
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	$response = (array)json_decode($curl_response);
	$responseArray = array_merge
    (
        array
        (
            //"selected_method" => $processNO,
            //"executed_method" => $executedMethod,
            //"edited_time" => $executedTime,
            "status_code" => "UnKnown" ,
            "message" => "task completed"
        ),
        $response
	);
	curl_close($curl);
	echo json_encode($responseArray);
	//exit;
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

/*
header('Access-Control-Allow-Origin: ' . "*");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

//header('Access-Control-Max-Age: 604800');
  //if you need special headers
//header('Access-Control-Allow-Headers: x-requested-with');
*/
?>