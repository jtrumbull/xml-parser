<?php
header('Content-type: text/xml');
include '../xml-parser.class.php';
use XMLParser\XMLParser;

$xml = XMLParser::encode(array(
    'attr:status'=>'success',
    'Person'=>array(
        'attr:id'=>987654321,
        'First Name'=>'John',
        'Last Name'=>'Smith'
    ),
    'Address'=>array(
        'attr:'=>array(
            'geo-coded'=>TRUE,
            'lat'=>'0.0000',
            'lon'=>'-0.0000'
        ),
        'Street'=>'123 Main Street',
        'City'=>'Somewhere',
        'State'=>'DE',
        'Zip'=>'12345'
    ),
    'other'=>array(
        'key'=>'value',
        array('value1','value2','value3')
    )
),'response');
echo $xml->asXML();