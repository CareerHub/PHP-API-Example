<?php

class Helper {
    public function format_query($parameters, $primary='=', $secondary='&'){
        $query = "";
        foreach($parameters as $key => $value){
            $pair = array(urlencode($key), urlencode($value));
            $query .= implode($primary, $pair) . $secondary;
        }
        return rtrim($query, $secondary);
    }

	public function parse_response($raw) {
		$response = [];

	    $headers = array();
	    $http_ver = strtok($raw, "\n");
	    
	    while($line = strtok("\n")){
	        if(strlen(trim($line)) == 0) break;
	        
	        list($key, $value) = explode(':', $line, 2);
	        $key = trim(strtolower(str_replace('-', '_', $key)));
	        $value = trim($value);

	        if(empty($headers[$key])) {
	            $headers[$key] = $value;
	        } else if(is_array($headers[$key])) {
	            $headers[$key][] = $value;
	        } else {
	            $headers[$key] = array($headers[$key], $value);
	        }
	    }
	    
	    $response['headers'] = (object) $headers;
	    $response['data'] = json_decode(strtok(""));

	    return $response;
	}
}

$helper = new Helper;

echo '<h1>CareerHub API Access</h1>';

$host = ''; // THE HOST HERE
$id = ''; // YOUR ID HERE
$secret = ''; // YOUR SECRET HERE

$base_url = $host . 'oauth/token';
$format = 'json';
$parameters = array('grant_type' => 'client_credentials',
					'client_id' => $id,
					'client_secret' => $secret,
					'scope' => 'Trusted.Experiences');

$ch = curl_init();
$curlopt = array(CURLOPT_HEADER => true, 
				 CURLOPT_RETURNTRANSFER => true);

$curlopt[CURLOPT_HTTPHEADER] = array('Content-Type: application/x-www-form-urlencoded');
$curlopt[CURLOPT_POST] = true;
$curlopt[CURLOPT_POSTFIELDS] = $helper->format_query($parameters);
$curlopt[CURLOPT_URL] = $base_url;

echo '<strong>Options</strong><pre>';
var_dump($curlopt);
echo '</pre>';

curl_setopt_array($ch, $curlopt);
$raw = curl_exec($ch);
$info = (object) curl_getinfo($ch);
$error = curl_error($ch);
curl_close($ch);

echo "<strong>Raw Response</strong><pre>";
var_dump($raw);
echo "</pre>";

echo "<strong>Info</strong><pre>";
var_dump($info);
echo "</pre>";

// Are you seeing this error - 'SSL certificate problem: unable to get local issuer certificate'
// Ensure you have your curl.cainfo set
// Please use https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt

echo "<strong>Error</strong><pre>";
var_dump($error);
echo "</pre>";

$decoded = $helper->parse_response($raw);

echo "<strong>Decoded response</strong><pre>";
var_dump($decoded);
echo "</pre>";
