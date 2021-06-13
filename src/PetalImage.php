<?php

namespace PanduanVIP\WebExtractor;

use \RoNoLo\JsonExtractor\JsonExtractorService; 

class PetalImage{

	public static function get($keyword, $proxy='')
    {
		$html = self::curl($keyword, $proxy);

        $jsonExtractor = new JsonExtractorService();
        $data = @$jsonExtractor->extractAllJsonData($html);

        $blocks = $data[0]['imageData'] ?? [];

        $alt = '';
        $image = '';
        $thumbnail = '';
        $source = '';

        $results = [];

        foreach($blocks as $block){
            $alt = $block['title'] ?? '';
            $image = $block['extrainfo']['real_url'] ?? '';
            $thumbnail = $block['image'] ?? '';
            $source = $block['url'] ?? '';
            
            if(!empty($image)){
                $results[] = array('alt'=>$alt, 'image'=>$image, 'thumbnail'=>$thumbnail, 'source'=>$source);
            }
        }

        return json_encode($results);
    }

	private static function curl($keyword, $proxy='')
	{
		if (!function_exists('curl_version')) {
			die('cURL extension is disabled on your server!');
		}

		$keyword = str_replace(' ', '+', $keyword);
		$url = "https://petalsearch.com/search?query=$keyword&channel=image";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);	
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		}
		if (isset($_SERVER['HTTP_REFERER'])) {
			curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		if (!empty($proxy)) {
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

}