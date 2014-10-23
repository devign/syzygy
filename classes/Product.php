<?php
  
class Product {
    private $data = array();
    
    public function __construct($sku) {
        global $db;
        
        $result = $db->query("SELECT sku, brand_name, name, description, price, short_description
                    FROM products AS p
                    LEFT JOIN product_brands USING(brand_id)
                    WHERE sku = '". $sku ."'");
                    
        $temp_data = $result->fetch_all(MYSQLI_ASSOC);
        
        foreach ($temp_data as $temp) {
            foreach ($temp as $k => $v) {
                $this->data[$k] = $v;
            }
        }

    } 
    
    public function __get($name) {

        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
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
        $this->data[$name] = $value;
    }
    
    public function getMedia() {
        global $db;
        
        $sku = $this->data['sku'];
        
        $result = $db->query("SELECT * FROM product_media
                                WHERE sku = '" . $sku . "'");
                                
        $temp_data = $result->fetch_all(MYSQLI_ASSOC);
        
        return $temp_data;
    }
}
?>

