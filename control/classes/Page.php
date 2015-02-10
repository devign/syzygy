<?php

class Page extends SyzygyControl {
    private $_data = array();
    
    public function __construct($id) {
        global $db;
        
        parent::__construct();

        $result = $db->query("SELECT page_name, page_title, page_description, page_keywords, page_content, page_url
                    FROM cms_pages
                    WHERE page_id = $id");
        
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


}


?>
