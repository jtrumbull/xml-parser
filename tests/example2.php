<?php
header('Content-type: text/xml');
include '../XMLParser.class.php';

$xml = XMLParser::encode(
    array(
        array(1,2,3,4,5),
        array(10,12,'A')
    )
);
echo $xml->asXML();