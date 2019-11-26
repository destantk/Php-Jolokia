<?php
/**
 * Created by PhpStorm.
 * User: Turgay
 * Date: 26.11.2019
 * Time: 12:51
 */

$url = 'http://...HOSTNAME....:8161/admin/queueBrowse/.....QUEUE_NAME...?view=rss&feedType=rss_2.0';
$curl = curl_init();
curl_setopt_array($curl, Array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_USERPWD => 'admin:admin'
));
$data = curl_exec($curl);
curl_close($curl);
$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

foreach ($xml->channel->item as $item) {
    $object = json_decode($item->description);
    var_export($object);
}