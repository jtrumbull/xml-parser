# XMLParser.class.php
## Installation
```PHP
include 'XMLParser.class.php';
```
##Usage
###XMLParser::encode()
**Syntax:** 
```PHP
SimpleXMLElement XMLParser::encode( mixed $data [, string $root] )
```
**Example:** 
```PHP
include 'XMLParser.class.php';
header('Content-type: text/xml');

$data = array(
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
);

$xml = XMLParser::encode( $data , 'response' );
echo $xml->asXML();
```
**Result:** 
```XML
<response status="success">
  <person id="987654321">
    <first_name>John</first_name>
    <last_name>Smith</last_name>
  </person>
  <address geo-coded="TRUE" lat="0.0000" lon="-0.0000">
    <street>123 Main Street</street>
    <city>Somewhere</city>
    <state>DE</state>
    <zip>12345</zip>
  </address>
  <other>
    <key>value</key>
    <list>
      <item>value1</item>
      <item>value2</item>
      <item>value3</item>
    </list>
  </other>
</response>
```
