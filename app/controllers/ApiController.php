<?php

class ApiController{

	private $app_id;
	private $app_key;
	private $api_url;
    private $referer_url;

	public function __construct(){

        /*Set API variables*/
		$this->app_id 	      = Config::get('app.app_id');
		$this->app_key        = Config::get('app.app_key');
		$this->api_url 	      = Config::get('app.api_url');
        $this->referer_url    = Config::get('app.url');
	}

    /*Don't Change anything below*/
	public function request($method = 'GET',$resource = '/',$params = array(),$returnArray = false){

        $request                = array();
        $method                 = strtoupper($method);
        $request['method']      = $method;
        $request['resource']    = $resource;
        $request['params']      = $params;
        


        $api_data = array();
        $api_data['app_id']             = $this->app_id;
        $api_data['app_key']            = $this->app_key;
        $api_data['encoded_request']    = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->app_key, json_encode($request), MCRYPT_MODE_ECB));
         
        $api_referer_url 	= $this->referer_url;
        $api_target_url 	= $this->api_url;
        $api_target_url 	.= $resource;
        $api_target_url     .= ($method == 'GET') ? '?'.http_build_query($api_data) : '';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_target_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_REFERER, $api_referer_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);
 
        $result = curl_exec($ch);
        
        if($returnArray){$result = json_decode($result);}
        
        curl_close($ch);
        
        if($result == false) {
        	$result                     = new stdClass;
            $result->success            = false;
            $result->method             = $method;
            $result->resource           = $resource;
            $result->error_message      = 'API error occured.';
            if($returnArray == false){$result = json_encode($result);}
        	return $result;
        }

        return $result;
	}
}
