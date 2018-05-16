<?php
class AccessGoogleServices
{
    function AccessGoogleServiceCall($url, $method, $parameters, $Headers)
    {
        //$url = "https://script.google.com/macros/s/AKfycbx-jmj_70IEWRP3t5Z2QFSIkWakhYbTYvTMM2uTCCIE3ZXx0loS/exec";
        //$url = "https://script.googleusercontent.com/macros/echo?user_content_key=QBOVOPs8uM0MuYQfFyK4W7ilIEB7JgO5VE3NQdZf5lBf2-TjoSmEuBCOGgSjLLtW7tRX5g6S9ImDLwp3oOicSAK30yD0T8G3m5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnBOdbNCjBmbjEOOPRrZzbJVgEeGpP0pCiiIfVfhrzVlD0XAZUKozy0efPajHEymamqZYwDtuJYeH&lib=MeTk28aelQajx2xUtX-QeZ3cAfuWwl7sa";
        
        //CallAccessMethods();
        if(isset($method))
        {
            switch($method)
            {
                case "Get":
                    return ($this->GetData($url, $Headers));
                break;
                case "Post":
                    $this->PostData($url, $parameters, $Headers);
                break;
                case "Update":
                break;
                case "Delete":
                break;
                default:
                break;
            }
        }
    }

    function GetData($url, $Headers)
    {
        try
        {
            //$curl = curl_init($url);
            $curl = curl_init($url);
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
            return $responseArray;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage(); 
        }
    }

    function PostData($url, $data, $Headers)
    {
        try
        {

        }
        catch(PDOException $e)
        {

        }
    }

    function Second()
    {

            if($method === "POST" )
            {
                
            }
            else if($method === "GET")
            {
                
            }
            else if($method === "UPDATE")
            {
                
            }
            else if($method === "DELETE")
            {
                
            }
            else
            {
                
            }
    }
}
?>