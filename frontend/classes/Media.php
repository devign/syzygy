<?php

class Media {
    protected $_data = array();
    
    public function __construct($sku, $num) {
        global $db;
        
        $result = $db->query("SELECT * FROM product_media
                                WHERE sku = '" . $sku . "'
                                and product_media_num = " . $num);
                                
        $temp_data = $result->fetch_all(MYSQLI_ASSOC);
        
        foreach ($temp_data as $row) {
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
    
    public static function getTotalExisting($sku) {
        global $db;
        
        $result = $db->query("SELECT count(*) AS num FROM product_media WHERE sku = '" . $sku ."'");
        $count = $result->fetch_object();
        $result->close();
        
        return $count->num;
        
    }    
}

?>
