<?php
$product = new Product($route[1]);
$media = $product->getMedia();


$template_data = [  'page_title'        => $product->name,
                    'page_description'  => $product->description,
];

require THEME_PATH . 'header.phtml';
?>

<div id="pageContentContainer">
    <div id="contentContainer" class="clearfix">
        <div id="content">
            <div id="productDetails">
                <div id="productMedia">
                <img width="400px" src="<?=$config['full_url'] . $product_images[0]['product_media_url'] . DSEP . $product_images[0]['product_media_name']?>"/>
                </div>
                <div id="productMeta">
                SKU: <?= $product->sku?>   <br /><br />
                NAME: <?= $product->name?> <br /> <br />
                DESCRIPTION: <?= $product->description?> <br />  <br />
                PRICE: $<?= $product->price?><br /> <br />
                <form name="addToCartForm" method="post" action="<?=$config['full_url'] . 'cart/add' ?>">
                <input type="text" name="<?=$product->sku?>_qty" size="3">
                <input type="submit" value="Add To Cart">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require THEME_PATH . 'footer.phtml';
?>