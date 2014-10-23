<?php

class Page extends SyzygyFrontend {
    public $page_title;
    public $page_description;
    public $page_keywords;
    public $page_content;
    
    public function __construct($id) {
        global $db;
        
        parent::__construct();

        $result = $db->query("SELECT page_title, page_description, page_keywords, page_content FROM cms_pages
                    WHERE page_id = $id");
        
        $temp_data = $result->fetch_all(MYSQLI_NUM);  
        
        $this->page_title       = $temp_data[0][0]; 
        $this->page_description = $temp_data[0][1];
        $this->page_keywords    = $temp_data[0][2];
        $this->page_content     = $temp_data[0][3];     
    }
    
    


}


?>
