<?php
class SyzygyFrontend {
    
    public function __construct() {
        
    }
    
    public function __destruct() {
        
    }
    
    
    public function simplifyArray($arr) {
        $new_array = [];
        
        foreach ($arr as $r) {
            foreach ($r as $k => $v) {
                $new_array[$k] = $v;
            }    
        }    
        
        return $new_array;
    }
}
?>
