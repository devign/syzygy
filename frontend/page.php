<?php
$page = new Page($route[1]);

$template_data = [ 
                'page_title'        => $page->page_title,
                'page_description'  => $page->page_description,
                'page_keywords'     => $page->page_keywords,
                'page_content'      => $page->page_content,
];

require THEME_PATH . 'header.phtml';

?>


<div class="container">
 
    <?=$template_data['page_content']?>
 
</div>

<?php
 
require THEME_PATH . 'footer.phtml';   
    
?>
