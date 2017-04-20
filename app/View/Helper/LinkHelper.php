<?php 
App::uses('AppHelper', 'View/Helper');

class LinkHelper extends AppHelper {
	function bitly($url)
	{
		$format = 'xml';
		$version = '2.0.1';
		$login = 'solinichole';
		$appkey = 'R_1c6dd4d2938f4642ab392352fa368737';
		//create the URL
		$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
		
		//get the url
		//could also use cURL here
		$response = file_get_contents($bitly);
		
		//parse depending on desired format
		if(strtolower($format) == 'json')
		{
			$json = @json_decode($response,true);
			return $json['results'][$url]['shortUrl'];
		}
		else //xml
		{
			$xml = simplexml_load_string($response);
			return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
		}
	}
} 
