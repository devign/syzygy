<?php

class ProductCollection extends Collection {
    private $_data = array();
    
    public function __construct($start = 0 , $end = 10) {
        global $db;
        
        $result = $db->query("SELECT sku, name, description, price, product_type 
                                FROM products
                                LIMIT $start, $end");
                                
        $temp = $result->fetchall();
        
        foreach ($temp as $row) {
            foreach ($row as $k => $v) {
                $this->_data[$k] = $v;
            }
        }
    }    
}

?>
