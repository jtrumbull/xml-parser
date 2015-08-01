# XMLParser
I needed a quick way of outputting XML from an associative array on a few projects -this was the end result. I created 
this repository for later reference and fellow devs. At the time, It served it's purpose, however I am not actively 
developing this project -see the contributing section.

## Table of contents
* [Installation](#installation)
* [Usage](#usage)
* [Documentation](#documentation)
* [Contributing](#contributing)
* [Community](#community)
* [Copyright and license](#copyright-and-license)

## Installation
 * Download XMLParser from GitHub
 * Include into your source:
 
```PHP
include 'XMLParser.class.php';
```

##Usage

```PHP
include 'XMLParser.class.php'; // Include the project
header('Content-type: text/xml'); // Define the content-type

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

Will output:

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

## Documentation

### XMLParser::encode()

**Syntax:** 
```PHP
SimpleXMLElement XMLParser::encode( mixed $data [, string $root] )
```

### XMLParser::decode()
**Syntax:** 
```PHP
Array XMLParser::encode( mixed $string )
```
**Returns:** Array 

## Contributing

## Community

## Copyright and license

XML parser is distributed under the MIT License -see [LICENSE.md](https://github.com/jtrumbull/XMLParser/blob/master/LICENSE.md)