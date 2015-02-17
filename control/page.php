<?php
$include_file = '';
$success_message = '';
$error_message = '';

if (isset($_POST['form_action'])) {
    if ($_POST['form_action'] == 'save') {

        $page_id = insertRecord('cms_pages', 'page_id');
        
    } else if (isset($_POST['form_action']) && $_POST['form_action'] == 'update') {

        $page_id            = $_POST['page_id'];
        $page_title         = $_POST['page_title'];
        $page_url           = $_POST['page_url'];
        $page_description   = $_POST['page_description'];
        $page_keywords      = $_POST['page_keywords'];
        $page_content       = $_POST['page_content'];
        
        $db->query("UPDATE page
                SET 
                page_title          = '$page_title',
                page_url            = '$page_url',
                page_description    = '$page_description',
                page_keywords       = '$page_keywords',
                page_content        = '$page_content'
                WHERE page_id = '$page_id'
                ");

    }
} else if ($route[1] == 'edit') {
    
    $page_id = $_GET['page_id'];
    
    $page = new Page($page_id);
    
    $include_file = 'page_edit.phtml';
    
} else if ($route[1] == 'create') {
    
    $include_file = 'page_create.phtml';
    
} else {
    
    $include_file = 'page_list.phtml';
    
}


require THEME_PATH . 'header.phtml';

require $include_file;

require THEME_PATH . 'footer.phtml';

?>
