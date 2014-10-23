<?php

class Media extends SyzygyFrontend {
    private $data = array(array());
    
    public function __construct($sku) {
        global $db;
        
        $result = $db->query("SELECT * FROM product_media
                                WHERE sku = '" . $sku . "'");
                                
        $temp_data = $result->fetch_all(MYSQLI_ASSOC);
        
        print_r($temp_data); 
    }   
    
    public function __get($name) {
         
        
    } 
}

?>
