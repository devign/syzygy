<?php

if ($route[1] === 'create') {
    $include_file = 'category_create.phtml';                                                
} else if ($route[1] === 'edit') {
    $include_file = 'category_edit.phtml';
} else {
    $include_file = 'category_list.phtml';
}

require THEME_PATH . 'header.phtml';

require $include_file;
  
require THEME_PATH . 'footer.phtml';


?>
