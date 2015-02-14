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

?>
<div class="container">
 
      <div class="row">
        <div class="col-lg-9 col-lg-offset-1">

<div>
    <h2>Your Cart</h2>
    
    <?php if ($cart_empty == 1) : ?>    
        <div>Your cart is empty</div>
    <?php else : ?>
    <form name="cart" method="post" action="/cart/edit">
    <table id="cart">
    <tr>
    <th>Quantity</th><th>SKU</th><th>Name</th><th>Price</th> <th>Ext. Price</th>
    </tr>
    <?php while ($row = $result->fetch_object()) :?>
    <?php 
        $ext_price = sprintf('%.2f', $row->quantity * $row->price);
        $cart_total += $ext_price;    
    ?>
    <tr>
    <td><input type="text" name="<?=$row->sku?>_qty" value="<?=$row->quantity?>" size="2"></td>
    <td><?=$row->sku?></td><td><?=$row->name?></td>
    <td style="text-align:right"><?=$row->price?></td><td style="text-align:right"><?=$ext_price?></td>
    </tr>
    <?php endwhile; ?>
    <tr><td><input type="submit" value="Update" /></td>
    <?php $cart_total = sprintf('%.2f', $cart_total) ?>
    <td style="text-align:right" colspan="3">Total:</td><td style="text-align:right"><?=$cart_total?></td></tr>
    </table>
    </form>
    
    <?PHP endif; ?>
</div>
</div>
</div>
</div>

<?php 
$result->close();
require THEME_PATH . 'footer.phtml';

?>