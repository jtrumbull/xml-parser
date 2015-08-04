<?php
header('Content-type: text/xml');
include '../xml-parser.class.php';
use XMLParser\XMLParser;

class myClass {

  public $username = 'john_smith@some.domain';
  public $password = 'secret';
  public $greeting = 'Johnny boy.';

}
$x = new myClass();
$xml = XMLParser::encode(new myClass());
echo $xml->asXML();