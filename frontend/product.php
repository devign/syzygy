<?php
$product = new Product($route[1]);
$media = new Media($product->sku, 1);
$mediaCollection = new MediaCollection($product->sku);

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
                <img width="400px" src="<?=$config['full_url'] . $media->product_media_url . DSEP . $media->product_media_name?>"/>
                <div id="product-image-thumbs">
                <?php while ($newMedia = $mediaCollection->iterate()) :?>
                    <div style="float:left;padding-right:10px">
                    <a href=""><img src="<?=$config['full_url'] . $newMedia->product_media_url . DSEP . $newMedia->product_media_name?>" width="80px" /></a>
                    </div>
                <?php endwhile; ?>
                </div>
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