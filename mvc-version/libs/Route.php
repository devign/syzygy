<?php
class Route {
    private $uri;
    public $controller;
    public $method;
    public $params = [];
    
    public function __construct($u) {
        $this->uri = $u;
        $this->uri = rtrim($this->uri, '/');
        $route = explode('/', $uri);
        
        if (false != $id = isPage($route[0])) {
            $this->controller = 'page';
            $this->method = $route[1]; 
        } elseif (false != $sku = isProduct($route[0])) {
            $new_route = 'store' . DSEP . 'product.php?' . $sku;
        } else {
            $new_route = 'store' . DSEP . $route[0] . '.php?' . $route[1];
        }

        
    }
    
    private function isPage($i) {
      
        $result = $db->query("SELECT page_id FROM cms_pages WHERE page_url = '$i'");
        $id = $result->fetch_object();
        
        if (isset($id)) {
            return $id->page_id;
        } else {
            return false;
        }                        
    }

    private function isProduct($i) {
     
        $result = $db->query("SELECT sku FROM product_metadata WHERE product_url = '$i'");
        $sku = $result->fetch_object();
        
        if (isset($sku)) {
            return $sku->sku;
        } else {
            return false;
        }                        
    }

}


?>
