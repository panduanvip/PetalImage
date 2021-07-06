<?php

namespace PanduanVIP\WebExtractor;

use PanduanVIP\Helpers\Please;
use RoNoLo\JsonExtractor\JsonExtractorService; 

class PetalImage{

	public static function get($keyword, $proxy='')
    {
        $keyword = str_replace(' ', '+', $keyword);
		$url = "https://petalsearch.com/search?query=$keyword&channel=image";

		$html = Please::getWebContent($url, $proxy);

        $results = [];

        if(empty($html)){
            return json_encode($results);
        }

        $jsonExtractor = new JsonExtractorService();
        $data = $jsonExtractor->extractAllJsonData($html);

        $blocks = $data[0]['imageData'] ?? [];

        $alt = '';
        $image = '';
        $thumbnail = '';
        $source = '';

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

}