<?php
try
{
	$url1 = "curl -L https://script.google.com/macros/s/AKfycbxR_xKju3dN5Wfj7FTLLxCmhOgZOLtv0d7FhUhVh80JtkuJdJI/exec";
    $url = "https://script.google.com/macros/s/AKfycbxR_xKju3dN5Wfj7FTLLxCmhOgZOLtv0d7FhUhVh80JtkuJdJI/exec"."?"."Contenttype=application/json";
    $val = array("name"=>"labnol", "blog"=>"ctrlq", "type"=>"post");
    $data = json_encode($val);
    /*the below type is a mistake
    //$curl = curl_init(($url."?"."Contenttype=application/json"));///
    */
    //this below one works check $url end points for more details.
    $curl = curl_init($url);
    //echo $url;
/*
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_CONNECTTIMEOUT => 0,
        CURLOPT_POSTFIELDS => $data//array('name' => 'labnol', 'blog' => 'ctrlq', 'type' => "post" )
        ));
        $curl_response = curl_exec($curl);
        //echo $curl_response;
        */
    
	curl_setopt($curl, CURLOPT_URL, $url);
    //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
	//curl_setopt($curl, CURLOPT_HEADER, true);// this changes response to x-formulated data type
	//curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
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