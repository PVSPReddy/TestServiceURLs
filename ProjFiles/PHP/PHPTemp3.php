<?php

/*
//to get post or get or .. request method type
$method = $_SERVER['REQUEST_METHOD'];
//echo $method."\n";

//to get data type like xml or json or text type
if(isset($_SERVER["CONTENT_TYPE"]))
{
	// echo $_SERVER["CONTENT_TYPE"];
	$requestContentType = $_SERVER["CONTENT_TYPE"];
	// if($requestContentType != "application/json")
	// {
	// 	$requestContentType = "application/json";
	// }
	// echo $requestContentType."\n";
}
else
{
	$requestContentType = "application/json";
	// echo "CONTENT_TYPE is not set.";
	// exit;
}

//$rawData = array('error' => 'No mobiles found!',
//'method' => $method);

$rawData = json_decode(file_get_contents('php://input'),true);
*/

/*
if (isset($_SERVER["HTTP_ORIGIN"]) === true) {
	$origin = $_SERVER["HTTP_ORIGIN"];
	$allowed_origins = array(
		"http://public.app.moxio.com",
		"https://foo.app.moxio.com",
		"https://lorem.app.moxio.com"
	);
	if (in_array($origin, $allowed_origins, true) === true) {
		header('Access-Control-Allow-Origin: ' . $origin);
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: POST');
		header('Access-Control-Allow-Headers: Content-Type');
	}
	if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
		exit; // OPTIONS request wants only the policy, we can stop here
	}
}
*/

header('Access-Control-Allow-Origin: ' . "*");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

//header('Access-Control-Max-Age: 604800');
  //if you need special headers
//header('Access-Control-Allow-Headers: x-requested-with');

//$curl = curl_init($url);
// $url = "https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec&ndplr=1";
$url = "https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_HEADER, true);// this changes response to x-formulated data type
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
//echo "done";
echo $curl_response;
//print($curl_response);
//echo "done ended";
exit;
if ($curl_response === false) 
{
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
//$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}

$response = $curl_response; /*array("message"=>"Songs cannot be retrived.",
                 "code"=>"0",
                 $curl_response
                 );*/
return $response;
exit;
echo 'response ok!';
//var_export($decoded->response);

// class GASServices
// {
//     function TestOne($url)
//     {
//     }
// }
?>