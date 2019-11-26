<?php
/**
 * Created by PhpStorm.
 * User: Turgay
 * Date: 26.11.2019
 * Time: 11:54
 */

$url = "http://.........:8161/api/jolokia/read/org.apache.activemq:type=Broker,brokerName=.......";
$curl = curl_init();
curl_setopt_array($curl, Array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_USERPWD => 'admin:admin',
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain')
));
$response = curl_exec($curl);
curl_close($curl);

$object = json_decode($response);
echo "Total:" . $object->value->TotalMessageCount . "\n";
echo "TotalDequeueCount:" . $object->value->TotalDequeueCount . "\n";
echo "TotalConnectionsCount:" . $object->value->TotalConnectionsCount . "\n";
foreach ($object->value->Queues as $object) {
    if ((preg_match_all('/(.*)destinationName=(.*),destinationType=Queue(.*)/', $object->objectName, $match, PREG_SET_ORDER))) {
        echo $match[0][2] . "\n";
    }
}
