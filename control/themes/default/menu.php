<?php
$openMenu = '';
if ($action == 'orders') {
    $openMenu = 'collapse-orders';
} elseif ($action == 'products' || $action == 'categories') {
    $openMenu = 'collapse-products';
} 

?>

<script>
jQuery(document).ready(function() {
    jQuery('#<?=$openMenu?>').addClass('in');        
});  
</script>

         <div id="menu-wrapper" class="col-md-3">
             
            <nav id="desktop-menu">

              <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a  href="/control/dashboard">
                          <span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
                        </a>
                      </h4>
                    </div>
                    <!-- <div id="collapseOne" class="panel-collapse collapse">
                      <div class="panel-body">
                        
                      </div>
                    </div>-->
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-orders">
                          <span class="glyphicon glyphicon-star"></span> Orders
                        </a>
                      </h4>
                    </div>
                    <div id="collapse-orders" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="/control/orders/create"><span class="glyphicon glyphicon-chevron-right"></span> Create Order</a></li>
                          <li><a href="/control/orders/view"><span class="glyphicon glyphicon-chevron-right"></span> View Orders <span class="order-total">999</span></a></li>
                        </ul>
                      </div>
                    </div>
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-products">
                          <span class="glyphicon glyphicon-shopping-cart"></span> Products <span class="general-total">999</span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse-products" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="/control/products/create"><span class="glyphicon glyphicon-chevron-right"></span> Add Product </a></li>
                          <li><a href="/control/products/view"><span class="glyphicon glyphicon-chevron-right"></span> View Products</a></li>
                          <li><a href="/control/categories/view"><span class="glyphicon glyphicon-chevron-right"></span> Categories</a></li>
                          <li><a href="/control/brands/view"><span class="glyphicon glyphicon-chevron-right"></span> Brands</a></li>
                        </ul>
                      </div>
                    </div>
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-customers">
                          <span class="glyphicon glyphicon-user"></span> Customers
                        </a>
                      </h4>
                    </div>
                   <div id="collapse-customers" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="/control/customers/create"><span class="glyphicon glyphicon-chevron-right"></span> Add Customer</a></li>
                          <li><a href="/control/customers/view"><span class="glyphicon glyphicon-chevron-right"></span> View Customers</a></li>
                        </ul>
                      </div>
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-returns">
                          <span class="glyphicon glyphicon-transfer"></span> Returns
                        </a>
                      </h4>
                    </div>
                  <div id="collapse-returns" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="/control/returns/create"><span class="glyphicon glyphicon-chevron-right"></span> New Return</a></li>
                          <li><a href="/control/returns/view"><span class="glyphicon glyphicon-chevron-right"></span> View Returns</a></li>
                        </ul>
                      </div>
                    </div>
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="/control/vendors/view">
                          <span class="glyphicon glyphicon-list-alt"></span> Vendors
                        </a>
                      </h4>
                    </div>
                  <!--<div id="collapse-vendors" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Purchase Orders</a></li>
                        </ul>
                      </div>
                    </div>-->
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="/control/reports/view">
                          <span class="glyphicon glyphicon-stats"></span> Reports
                        </a>
                      </h4>
                    </div>
                  <!-- <div id="collapsefive" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Products</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Add Products</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Categories</a></li>
                        </ul>
                      </div>
                    </div> -->
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="/control/pages/view">
                          <span class="glyphicon glyphicon-file"></span> Pages
                        </a>
                      </h4>
                    </div>
                  <!--<div id="collapsesix" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> All Pages</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Drafts</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Add New</a></li>
                        </ul>
                      </div>
                    </div>-->
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="/control/media/view">
                          <span class="glyphicon glyphicon-picture"></span> Media
                        </a>
                      </h4>
                    </div>
                  <!-- <div id="collapseseven" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Image Library</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Video Library</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Add New</a></li>
                        </ul>
                      </div>
                    </div> -->
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="/control/mynotes/view">
                          <span class="glyphicon glyphicon-pushpin"></span> My Notes
                        </a>
                      </h4>
                    </div>
                  <!--<div id="collapsenine" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Note Archive</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Reminders</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Add Note</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Add Reminder</a></li>
                        </ul>
                      </div>
                    </div>-->
                  </div><!-- END Menu Item -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="/control/settings/view">
                          <span class="glyphicon glyphicon-cog"></span> Settings
                        </a>
                      </h4>
                    </div>
                  <!--<div id="collapseten" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="panel-location-arrow"></div>
                        <ul>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Shipping</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Payments</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Users</a></li>
                          <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span> Countries</a></li>
                        </ul>
                      </div>
                    </div>-->
                  </div><!-- END Menu Item -->
                </div>

            </nav>

          </div><!-- /.col-sm-12 /.col-lg-9 -->
          
          