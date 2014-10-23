<?php

if ($route[1] === 'create') {
    $include_file = 'category_create.phtml';                                                
} else if ($route[1] === 'view') {
    $include_file = 'category_list.phtml';
} else if ($route[1] === 'edit') {
    $include_file = 'category_edit.phtml';
}

require THEME_PATH . 'header.phtml';
?>

<?php if (isset($include_file)) : ?>
    <?php require $include_file; ?>
<?php else : ?>
          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <div id="searchCriteria" style="float:right;">
              <form name="searchForm" action="customers.php" method="post">
              <input type="hidden" name="action" value="search">
              <span class="inputLabel">SEARCH: <input type="text" name="search_value" value="" size="20">

              <button class="button" onClick="searchForm.submit();">GO!</button>

              </form>
              </div>
              <h1><span class="glyphicon glyphicon-shopping-cart"></span> Product Categories</h1>
              </section>

            <section id="content">
                <div id="actionNavContainer">
                    <ul id="actionNav">
                    <li><a href="/control/categories/create">Add New Category</a></li>
                    </ul>
                </div>
            

    	        <div style="padding-top:40px">
      	            <?php printCategoryList(); ?>
    	        </div>

            </section>

        </div><!-- /.col-sm-12 /.col-lg-9 -->

<?php endif; ?>        
<?php
    require THEME_PATH . 'footer.phtml';
?>