<?php 
$template = '';

if (isset($route[1]) && $route[1] == 'info' ) {
    $template = 'checkout_info.phtml';
} else if (isset($route[1]) && $route[1] == 'review') {
    $template = 'checkout_review.phtml';
} else if (isset($route[1]) && $route[1] == 'thankyou') {
    $template = 'checkout_thankyou.phtml';
} else {
    $template = 'checkout.phtml';
}

$template_data = [
                    'page_title' => 'Checkout',
                    'page_description' => 'Checkout page.'
];

require THEME_PATH . 'header.phtml'; 

require THEME_PATH . $template;

require THEME_PATH . 'footer.phtml';

?>
