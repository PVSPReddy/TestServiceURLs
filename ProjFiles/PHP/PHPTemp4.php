<?php
try
{
$url1 = "curl -L https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";
$url = "https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";

// $headers = get_headers($url);
// echo substr($headers[0], 9, 3);
// exit;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_HEADER, true);// this changes response to x-formulated data type
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$curl_response = curl_exec($curl);
$resp = json_decode($curl_response, true);
// echo json_encode($resp['folder_items']);
// exit;
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//echo $httpcode;
//echo "done";
//echo $curl_response;
/*
$responseArray = array(
	"status_code" => $httpcode ,
	"folder_items" => $resp,
	"message" => "task completed"
);
*/
$responseArray = array_merge
(
	array(
		"status_code" => $httpcode ,
		"message" => "task completed"
	),
	$resp
);
echo json_encode($responseArray);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>