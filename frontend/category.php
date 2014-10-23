<?php
/** Get category_id from category_name derived from URI */
$result = $db->query("SELECT category_id FROM product_categories WHERE category_name = LOWER('". $route[1] ."')");
$data = $result->fetch_all(MYSQLI_ASSOC);

$catid = $data[0]['category_id'];
$catname = $route[1];

$result->close();

/** Set template data before rendering header */
$template_data['page_title'] = $catname;
                      
require THEME_PATH . 'header.phtml';

/** Build product data query */
$result = $db->query("SELECT p.sku, name, price, product_url
                        FROM products AS p
                        LEFT JOIN product_to_category USING(sku)
                        LEFT JOIN product_metadata USING(sku)
                        WHERE category_id = $catid");

/** Prepare product media query for images, videos, pdfs */                        
$stmt = $db->prepare("SELECT product_media_name, product_media_url
                    FROM product_media
                    WHERE sku = ?
                    AND product_media_type = 'IMAGE'");
$stmt->bind_param('s', $sku);

?>

<div id="pageContentContainer">
    <div id="contentContainer" class="clearfix">
        <div id="breadcrumbs">
            Home &gt; <?=$catname?>
        </div>
<br />  <br /><br />  <br />        
        <div id="content" class="clearfix">
            <div id="categoryProducts">
            <?php while ($product = $result->fetch_object()) : ?>
                <div class="product">
                <?php 
                    $sku = $product->sku;
                    $stmt->execute();
                    $media_result = $stmt->get_result();
                    $media = $media_result->fetch_object();
                ?>
                <div class="productImage">
                <a href="<?=$config['full_url'] . $product->product_url?>">
                <img src="<?= $config['full_url'] . $media->product_media_url . DSEP . $media->product_media_name?>" width="100px" />
                </a>
                </div>
                <?= $product->name?><br />
                <?= $product->price?>
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
<br /><br /><br /><br />
</div>

<?php
$stmt->close();
require THEME_PATH . 'footer.phtml';
?>

