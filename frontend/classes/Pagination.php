<?php
class Pagination {
    private $_data = array();
    
    public function __construct() {}
    
    public function __construct($total_items, $current_page, $page_name) {
        global $config;
        $this->_data['page_name']       = $page_name;
        $this->_data['current_page']    = $current_page;
        $this->_data['total_items']     = $total_items;
        $this->_data['items_per_page']  = $config['items_per_page']; 
        $this->_data['total_pages']     = $this->_data['total_items'] / $this->_data['items_per_page'];
        
        if ($this->_data['total_items'] % $this->_data['items_per_page'] !== 0) {    
            $this->_data['total_pages']++;
        }   
    }
 
/** OUR GET AND SET METHODS **/    
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
/** END GET AND SET METHOD DEFINITIONS ***/

        
}

?>
