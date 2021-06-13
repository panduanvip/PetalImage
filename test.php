<?php

include 'vendor/autoload.php';

use PanduanVIP\WebExtractor\PetalImage;

$keyword = 'sepatu roda';
$results = json_decode(PetalImage::get($keyword));

echo '<pre>';
print_r($results);