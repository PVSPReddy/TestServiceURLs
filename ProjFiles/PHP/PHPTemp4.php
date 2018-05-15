<?php
$url = "curl -L https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec?start=1325437200&end=1325439000";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_HEADER, true);// this changes response to x-formulated data type
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$curl_response = curl_exec($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo $httpcode;
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