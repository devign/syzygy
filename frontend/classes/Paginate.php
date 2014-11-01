<?php
class Paginate {
    public $total_pages, $current_page, $total_items, $items_per_page;
    
    public function __construct($total_items, $current_page) {
        global $config;
        $this->current_page = $current_page;
        $this->total_items = $total_items;
        $this->items_per_page = $config['items_per_page'];
        $this->total_pages = $this->total_items / $this->items_per_page;    
    }    
}

?>
