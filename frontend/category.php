<?php
  
/** Get category_id from category_name derived from URI */
$result = $db->query("SELECT category_id, category_descp, category_heading, category_subheading,
                       category_alt_descp 
                       FROM product_categories 
                       WHERE category_name = '". $route[1] ."'");
$data = $result->fetch_all(MYSQLI_ASSOC);

$data = Utility::flattenArray($data);
$catname = $route[1];

$result->close();

/**
* GET START AND END FOR MYSQL SELECT LIMIT
*/
if (isset($_GET['p']) && $_GET['p'] > 1) {
    $current_page = $_GET['p'];
    $_GET['p']--;
    $start = $_GET['p'] * $config['items_per_page'];

} else {
    $current_page = 1;
    $start = 0;
}

if (isset($_POST['items_per_page'])) {
    $end = $_POST['items_per_page'];
} else {
    $end = $config['items_per_page'];
}


/** Set template data before rendering header */
$template_data['page_title'] = $catname;
                      
require THEME_PATH . 'header.phtml';

/**
* GET TOTAL PRODUCT COUNT FOR THIS CATEGORY
*/
$result= $db->query("SELECT count(*) AS total_items
                        FROM products AS p
                        LEFT JOIN product_to_category USING(sku)
                        WHERE category_id = " . $data['category_id']);
$num = $result->fetch_object();

/** Build product data query */
$result = $db->query("SELECT p.sku, name, price, product_url, p.brand_id, brand_name, onsale, sale_price, featured
                        FROM products AS p
                        LEFT JOIN product_to_category USING(sku)
                        LEFT JOIN product_brands USING(brand_id)
                        WHERE category_id = " . $data['category_id'] ."
                        LIMIT $start, $end");

/** Prepare product media query for images, videos, pdfs */                        
$stmt = $db->prepare("SELECT product_media_name, product_media_url
                    FROM product_media
                    WHERE sku = ?
                    AND product_media_type = 'IMAGE'
                    AND product_media_num = 1");
$stmt->bind_param('s', $sku);

 
require THEME_PATH . 'category.phtml'; 
    

$stmt->close();
require THEME_PATH . 'footer.phtml';


?>
