<?php
$product = new Product($route[1]);
$media = new Media($product->sku, 1);
$mediaCollection = new MediaCollection($product->sku);
$category= $product->getCategory();

$template_data = [  'page_title'        => $product->name,
                    'page_description'  => $product->description,
];

require THEME_PATH . 'header.phtml';

require THEME_PATH . 'product.phtml';

require THEME_PATH . 'footer.phtml';

?>
