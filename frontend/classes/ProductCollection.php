<?php

class ProductCollection extends Collection {
    private $_data = array();
    
    public function __construct() {
        global $db;
        
        $result = $db->query("SELECT sku, name, description, price 
                                FROM products
                                LIMIT 0, 10");
                                
        $temp = $result->fetchall();
        
        foreach ($temp as $row) {
            foreach ($row as $k => $v) {
                $this->_data[$k] = $v;
            }
        }
    }    
}

?>
