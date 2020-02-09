<?php

namespace App\Http\Libraries;

class Fabelio
{

    static function returnJsonProduct($url)
    {
        $html = @file_get_contents($url);
        if (!$html) {
            return [];
        }
        $result = [];
        $dom  = new \DOMDocument();
        libxml_use_internal_errors(1);
        $dom->loadHTML($html);
        $xpath = new \DOMXpath($dom);
        $jPath = $xpath->query(
            '//script[@type="application/ld+json"]'
        );
        $clear = str_replace(
            "\r\n", "", trim($jPath->item(0)->nodeValue)
        );
        $jScript = json_decode($clear, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // get images
            $nodeMagento = $xpath->query(
                '//script[@type="text/x-magento-init"]'
            );
            $jImage = [];
            foreach ($nodeMagento as $key => $value) {
                $clear = str_replace(
                    "\r\n", "", trim($value->nodeValue)
                );
                $args = json_decode($clear, true);
                // check nested
                if (!empty($args['[data-gallery-role=gallery-placeholder]'])) {
                    if (!empty($args['[data-gallery-role=gallery-placeholder]']['mage/gallery/gallery'])) {
                        $jImage = $args['[data-gallery-role=gallery-placeholder]']['mage/gallery/gallery']['data'];
                    }
                }
            }

            $result = self::jsonParser([
                'content' => $jScript,
                'images' => $jImage
            ]);
        }
        return $result;
    }

    static function jsonParser($args)
    {
        $content = $args['content'];
        return [
            'name' => $content['name'],
            'brand' => $content['brand'],
            'description' => strip_tags($content['description']),
            'url' => $content['url'],
            'sku' => $content['sku'],
            'price' => $content['offers']['price'],
            'image' => json_encode($args['images'])
        ];
    }
}
