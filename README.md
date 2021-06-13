# Petal Image Extractor

Web extractor for Petal Image website

## Installation:

```bash
composer require panduanvip/petal-image
```

### Usage:

```php
<?php

include 'vendor/autoload.php';

use PanduanVIP\WebExtractor\PetalImage;

$keyword = 'sepatu roda';
$results = json_decode(PetalImage::get($keyword));

echo '<pre>';
print_r($results);
```

**Result:** 
```
Array
(
    [0] => stdClass Object
        (
            [alt] => Jual Tian-E Sepatu roda Inline Skate Roda Karet Hitam / SepatuRoda ...
            [image] => https://ecs7.tokopedia.net/img/cache/700/product-1/2018/1/19/25169878/25169878_d9d8229d-2753-45bc-b712-4dea284a8387_700_700.jpg
            [thumbnail] => https://search-img-dra.dbankcdn.com/a1b200066d6a9d0d7c19fb87bf98d510
            [source] => https://www.tokopedia.com/agustinamall/tian-e-sepatu-roda-inline-skate-roda-karet-hitam-sepaturoda-tian-e
        )

    [1] => stdClass Object
        (
            [alt] => Jual Sepatu Roda Anak Inline Skate LAKOKO 101 Roda PU KARET Barang ...
            [image] => https://ecs7.tokopedia.net/img/cache/700/product-1/2019/6/23/1484250/1484250_c1fa5b60-bcab-4f09-99e1-805546134259
            [thumbnail] => https://search-img-dra.dbankcdn.com/5b61b56a69f2084a170db34c02c1bf4b
            [source] => https://www.tokopedia.com/psychedelic/sepatu-roda-anak-inline-skate-lakoko-101-roda-pu-karet-barang-import-36b4
        )

    .........
```
