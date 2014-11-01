<?php
  
class Cart {

    public $session;
    public $cartId;
    private $lineNo;
    
    public function __construct() {
    
        $this->session = $this->getCartSession();
        
        if ($this->cartExists() === false) {
            $this->createCart();
            $this->lineNo = 1;
        } 
        
            
    }
    
    public function add() {
        global $db;
//      echo $this->session . ' : ' . $this->cartId . ' : ' . $this->lineNo . ' : ' . $sku . ' : ' . $qty;
        
        foreach ($_POST as $k => $v) {
            /* Check if key matches _qty and extract sku from key */
            if (preg_match('/_qty$/', $k) === 1 && isset($_POST[$k]) && $_POST[$k] != 0) {
                list($sku, $gar) = explode('_', $k);
                $qty = $_POST[$k]; 
                $result = $db->query("SELECT quantity FROM cart_line_items WHERE sku = '" . $sku ."'");
                /* If item already exists in cart, update quantity */
                if ($obj = $result->fetch_object()) {
                    $qty += $obj->quantity;
                    $result = $db->query("UPDATE cart_line_items SET quantity = $qty WHERE sku = '$sku'");
                /* Insert item into cart */
                } else {    
                    $result = $db->query("INSERT INTO cart_line_items(cart_id, line_no, sku, quantity)
                            VALUES($this->cartId, $this->lineNo, '$sku', $qty)");
                            
                    $this->lineNo++;
                }
                
                
            }
        }
                              
    }
    
    public function edit() {
        global $db;
        $result = $db->query("DELETE FROM cart_line_items 
                        WHERE cart_id = ". $this->cartId);
        
        $this->lineNo = 1;                
        $this->add();
    }

    public function cartEmpty() {
        global $db;

        $result = $db->query("SELECT count(*) AS num 
                            FROM cart_line_items
                            WHERE cart_id = " . $this->cartId); 
        
        $obj = $result->fetch_object();

        if ($obj->num > 0) {
            return false;
        } else {
            return true;
        }        
    }
    private function cartExists() {
        global $db;

        $result = $db->query("SELECT cart_id, MAX(line_no) AS next_line 
                            FROM cart c
                            LEFT JOIN cart_line_items USING(cart_id)
                            WHERE c.session_id = '" . $this->session . "'"); 
        
        $obj = $result->fetch_object();
        
        if (isset($obj->cart_id)) {
            $this->cartId = $obj->cart_id;
            $this->lineNo = $obj->next_line + 1;
            return true;
        } else {
            return false;
        }

    }
    

    private function createCart() {
        global $db;
        $db->query("INSERT INTO cart(cart_date, session_id)
                    VALUES(NOW(), '". $this->session ."')");
        
        $result = $db->query("SELECT cart_id FROM cart WHERE session_id = '". $this->session ."'");
        $obj = $result->fetch_object();     
                       
        $this->cartId = $obj->cart_id;    
    }
    
    
    private function createCartSession() {
        global $db, $config;
        $result = $db->query("SELECT SHA(NOW() * RAND()) AS sess");
        $obj = $result->fetch_object();  
        

        return $obj->sess;  
    }    
    
        
    private function getCartSession() {
        global $config;

        if (isset($_COOKIE['PHPSESSID'])) {
            return $_COOKIE['PHPSESSID'];
            
        } else {
            return $this->createCartSession();
        }    
    } 
    

    
}
?>

