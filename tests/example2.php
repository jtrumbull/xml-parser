<?php
header('Content-type: text/xml');
include '../xml-parser.class.php';
use XMLParser\XMLParser;

class klass {

  public $username = 'john_smith@some.domain';
  public $password = 'secret';
  public $greeting = 'Johnny boy';

}
$data = new klass();
$data->login_attempts = [
  '2015/01/01 07:21:00',
  '2015/01/01 07:21:20',
  '2015/01/01 07:22:15'
];
$xml = XMLParser::encode($data);
echo $xml->asXML();