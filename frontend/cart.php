<?php
$cart = new Cart();
$cart_total = 0;
$cart_empty = 0;
 
if (isset($route[1]) && $route[1] === 'add') {
   $cart->add();  
} elseif (isset($route[1]) && $route[1] === 'edit') {
   $cart->edit(); 
}

/** Display cart aka cart view **/
$template_data['page_title'] = 'Your Cart'; 
require THEME_PATH . 'header.phtml';


if (!$cart->cartEmpty()) {
    $result = $db->query("SELECT cli.sku, quantity, name, price
                        FROM cart AS c
                        LEFT JOIN cart_line_items AS cli USING(cart_id)
                        LEFT JOIN products USING(sku)
                        WHERE c.cart_id = '" . $cart->cartId . "'");
} else {
    $cart_empty = 1;
}          
$result->close();

require THEME_PATH . 'cart.phtml';



require THEME_PATH . 'footer.phtml';

?>