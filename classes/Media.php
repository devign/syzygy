<?php

class Media {
    protected $_data;
    
    public function __construct() {
        global $db;
        
        $result = $db->query("SELECT * FROM product_media
                                WHERE sku = '" . $sku . "'");
                                
        $temp_data = $result->fetch_all(MYSQLI_ASSOC);
        
        print_r($temp_data); 
                
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
    
        
}

?>
