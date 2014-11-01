<?php

class Product {

    private $_data;
    
    public function __construct($sku) {
        global $db;
        
        $result = $db->query("SELECT p.sku, brand_id, name, description, short_description, price, weight, features, 
                                page_title, product_url, keywords
                                FROM products AS p
                                LEFT JOIN product_metadata USING(sku)
                                WHERE p.sku = '$sku'");


        $product_data = $result->fetch_all(MYSQLI_ASSOC);
        
        foreach ($product_data as $row) {
            foreach ($row as $k => $v) {
                $this->_data[$k] = $v;
            }
        }
        $result->close();    
            
    }

    public function __get($name) {

        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }   
    
    public function __set($name, $value) {
        $this->_data[$name] = $value;
    }
        
    public function add() {
        
    }         
    
    public function remove() {
        
    }
    
    public function save() {
        
    }
    
    public function view() {
        
    }
    
    public function getCategories($sku = null) {
        global $db;
        if (isset($sku)) {
            $this->_data['sku'] = $sku;
        }
        
        $tmpCats = array();
        
        $result = $db->query("SELECT category_id FROM product_to_category WHERE sku = '" . $this->_data['sku'] . "'");

        while ($row = $result->fetch_object()) {
            array_push($tmpCats, $row->category_id);
        }
        
        $result->close();
        
        return $tmpCats;
        
    }  

    public function getMedia($sku = null) {
        global $db;
        
        $stmt = $db->prepare("SELECT product_media_url, product_media_name, product_media_alt
                            FROM product_media
                            WHERE sku = '" . $this->_data['sku'] ."'");
                      
        $stmt->execute();
        $result = $stmt->get_result();
        $tmp = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        
        return $tmp;   
        
    }
    
    public function getVendors($sku = null) {
        global $db;
        if (isset($sku)) {
            $this->_data['sku'] = $sku;
        }
        $tmpVendors = array();
        
        $result = $db->query("SELECT vendor_id FROM product_to_vendor WHERE sku = '" . $this->_data['sku'] . "'");
        
        while ($row = $result->fetch_object()) {
            array_push($tmpVendors, $row->vendor_id);    
        }
        
        $result->close();
        
        return $tmpVendors;

    }

    public function getStores($sku = null) {
        global $db;
        if (isset($sku)) {
            $this->_data['sku'] = $sku;
        }
        
        $tmp = array();
        
        $result = $db->query("SELECT store_id FROM product_to_store WHERE sku = '" . $this->_data['sku'] . "'");

        while ($row = $result->fetch_object()) {
            array_push($tmp, $row->store_id);
        }
        
        $result->close();
        
        return $tmp;    
    }

    public function getFeatures($sku = null) {
        global $db;
        if (isset($sku)) {
            $this->_data['sku'] = $sku;
        }
        
        $tmpCats = array();
        
        $result = $db->query("SELECT category_id FROM product_to_category WHERE sku = '" . $this->_data['sku'] . "'");

        while ($row = $result->fetch_object()) {
            array_push($tmpCats, $row->category_id);
        }
        
        $result->close();
        
        return $tmpCats;    
    }
      
}  

?>
