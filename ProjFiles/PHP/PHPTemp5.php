<?php
//require_once("UserService.php");
//require_once("ServiceController.php");

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


//to get values from url that attached
$userRequest = "";
if(isset($_GET["userRequest"]))
{
    $userRequest = $_GET["userRequest"];
    //echo $userRequest."\n";
}
else
{
    $userRequest="faultRequest";
}

//$rh = new RequestHandler();


//$rawData = array('error' => 'No mobiles found!',
//'method' => $method);

$rawData = json_decode(file_get_contents('php://input'),true);

if(strpos($requestContentType,'application/json') !== false)
{
    //here we are converting data from json object to an array
    $json = json_decode(file_get_contents('php://input'),true);
    //$raw =  Request_Handler($userRequest, $json);
    $raw = HandleRequest($userRequest);
    $response = encodeJson($raw);
    echo $response."\n";
}
else if(strpos($requestContentType,'text/html') !== false)
{
    print_r($_REQUEST."\n");
    //echo $response;
}
else if(strpos($requestContentType,'application/xml') !== false)
{
    $response = new SimpleXMLElement($response);
    print_r($_REQUEST."\n");
    //echo $response;
}
else if(strpos($requestContentType,'application/x-www-form-urlencoded') !== false)
{
    $response = new SimpleXMLElement($response);
    print_r($_REQUEST."\n");
    //echo $response;
}
else
{
	//here we are converting data from json object to an array
    $json = json_decode(file_get_contents('php://input'),true);
    //$raw =  Request_Handler($userRequest, $json);
    $raw = HandleRequest($userRequest);
    $response = encodeJson($raw);
    echo $response."\n";
}

function HandleRequest($processNO)
{
    echo "process started level 1.0";
    //exit;
    $executedMethod = "";
    $response=array();
    $url1 = "curl -L https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";
    $url = "https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";

    echo "process started level 1.1";

    try
    {
    switch($processNO)
    {
        case "1":

            echo "process started level 2";
            $executedMethod = "step 1 execution started";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            //curl_setopt($curl, CURLOPT_HEADER, true);// this changes response to x-formulated data type
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            echo "process started level 3";
            $response = json_decode($curl_response, true);
            $executedMethod = "step 1 executed";
            echo "process started level 4";
            // echo json_encode($resp['folder_items']);
            // exit;
            //$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // $responseArray = array_merge
            // (
            //     array
            //     (
            //         "status_code" => $httpcode ,
            //         "message" => "task completed"
            //     ),
            //     $resp
            // );
            // $response = $responseArray;
            curl_close($curl);
            //echo json_encode($responseArray);

        break;
        case "2":

            $executedMethod = "step 2 execution started";
            $curl_response = file_get_contents($url);
            $response = json_decode($curl_response, true);
            $executedMethod = "step 2 executed";

        break;
        case "3":

            $executedMethod = "step 3 execution started";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl,CURLOPT_FOLLOWLOCATION, true);
            $curl_response = curl_exec($curl);
            $response = json_decode($curl_response, true);
            $executedMethod = "step 3 executed";
            curl_close($curl);
        
        break;
        case "4":
        break;
        case "5":
        break;
        case "6":
        break;
        default :
        break;
    };
}
catch(PDOException $ex)
{
    $response = array("error_report" => $ex->getMessage());
}
    $responseArray = array_merge
    (
        array
        (
            "selected_method" => $processNO,
            "executed_method" => $executedMethod,
            "edited_time" => "2018/05/15 11:02:00",
            "status_code" => "not Available" ,
            "message" => "task completed"
        ),
        $response
    );
    return $responseArray;
}

function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}

function encodeHtml($responseData) {

		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;
	}


function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		//var_dump("receiveservice.php".$jsonResponse);
		return $jsonResponse;
	}
?>