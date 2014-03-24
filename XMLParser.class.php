<?php
class XMLParser {

    private static $_defaultRootNode = 'root';

    private static $_defaultListNode = 'list';

    private static $_defaultItemNode = 'item';

    private static $_defaultEncoding = 'UTF-8';

    private static $_defaultVersion  = '1.0';

    private static $_defaultAttrTag  = 'attr:';

    public static function encode( $data, $root = NULL ) {
        if ($data instanceof SimpleXMLElement) { return $data; }
        try {
            $data = self::_validateEncodeData($data);
            $version = self::$_defaultVersion;
            $encode  = self::$_defaultEncoding;
            $XMLStr  = "<?xml version=\"".$version."\"?>";
            $node    = self::_formatName( is_null($root) ? self::$_defaultRootNode : $root );
            $value   = ($isarray = is_array($data)) ? NULL : self::_formatValue($data);
            $XMLStr .= "<$node>$value</$node>";
            $xml = new SimpleXMLElement($XMLStr);
            if($isarray){ $xml = self::_addChildren($xml,$data); }
            return $xml;
        }
        catch( Exception $e ){ trigger_error($e->getMessage(), E_USER_ERROR); }
    }

    private function _validateEncodeData($data) {
        if( is_object($data) ){ throw new Exception("Invalid data type supplied for XMLParser::encode"); }
        return $data;
    }

    private function _addChildren( $element, $data ) {
        foreach ( $data as $key => $value ) {
            $isattr = preg_match('/^'.self::$_defaultAttrTag.'([a-z0-9\._-]*)/',$key, $attr);
            if($isattr) { if(is_array($value)){
                    foreach( $value as $k=>$v ) {
                        $element->addAttribute( self::_formatName($k), self::_formatValue($v) );
                    }
                } else { $element->addAttribute( self::_formatName($attr[1]), self::_formatValue($value) ); }
                continue;
            }
            $node = self::_formatName(
                is_numeric($key) ?
                    ( is_array($value) ? self::$_defaultListNode : self::$_defaultItemNode ) :
                    $key
            );
            if( is_array($value) ) {
                $child = $element->addChild($node);
                self::_addChildren($child,$value);
                continue;
            }
            $element->addChild($node,$value);
        }
        return $element;
    }

    private static function _formatName($string) {
        $p = [ '/[^a-z0-9\._ -]/i'=>'','/(?=^[[0-9]\.\-\:^xml])/i'=>self::$_defaultItemNode.'_','/ /'=>'_' ];
        return strtolower(preg_replace(array_keys($p),array_values($p),$string));
    }

    private static function _formatValue($string) {
        return is_null($string)?'NULL':(is_bool($string)?self::_bool($string):$string);
    }

    private static function _bool($bool) { return $bool?'TRUE':'FALSE'; }

    public static function decode( $xml, $uproot = FALSE ) {
        if (!$xml instanceof SimpleXMLElement) {
            $xml = new SimpleXMLElement($xml);
        } return self::_toArray( $xml );
    }

    private static function _toArray( $element ) {
        $array = []; $attributes = (array)$element->attributes();
        if(array_key_exists('@attributes',$attributes)){ $array['attr:'] = $attributes['@attributes']; }
        foreach($element->children() as $key => $child) {
            $value = (string)$child;
            $_children = self::_toArray($child);
            $_push = ($_hasChild = (count($_children)>0)) ? $_children : $value;
            if( $_hasChild && !empty($value) && $value !== '') { $_push[]=$value; }
            $array[$key] = $_push;
        }
        return $array;
    }
}