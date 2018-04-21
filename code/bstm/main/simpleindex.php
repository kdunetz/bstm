<?php include("simpleheader.php"); ?>

<!-- Being Middle Pane -->
													
							<table class="nopad">
								<tr valign="top">
									<td>
<?php
  $view = $_GET['view'];
  if ($view == '' || $view == 'forgot_password' || $view == 'login' || $view == 'register' || $view == 'contact' || $view == 'how_it_works' || $view == 'about' || $view == 'list_of_coupon_sites' || $view == 'list_of_deals' || $view == 'home' || $view == 'search' || $view == 'add_zone')
  {
     if (isset($_GET['view']) && ($_GET['view'] == 'forgot_password'))
     {
        include("forgot_password.php");
     }
     else
     if (isset($_GET['view']) && ($_GET['view'] == 'login'))
     {
        include("login.php");
     }
     else
     if (isset($_GET['view']) && ($_GET['view'] == 'register'))
     {
        include("register.php");
     }
     else
     if (isset($_GET['view']) && ($_GET['view'] == 'contact'))
     {
        include("contact.php");
     }
     else
     if (isset($_GET['view']) && ($_GET['view'] == 'how_it_works'))
     {
        include("how_it_works.php");
     }
     else
     if (isset($_GET['view']) && ($_GET['view'] == 'search'))
     {
        include("search.php");
     }
     else
     if (isset($_GET['view']) && ($_GET['view'] == 'about'))
     {
        include("home_page_content.php");
     }
     else if (isset($_GET['view']) && ($_GET['view'] == 'list_of_coupon_sites'))
     {
        include("list_of_coupon_sites.php");
     }
     else if (isset($_GET['view']) && ($_GET['view'] == 'list_of_deals'))
     {
        include("list_of_deals.php");
     }
     else if (isset($_GET['view']) && ($_GET['view'] == 'add_zone'))
     {
        include("add_zone.php");
     }
     else
     if (!tep_session_is_registered('user_id')) 
     {
        include("home_page_content.php");
     }
     else if (tep_session_is_registered('user_id') && $_GET['view'] != 'search')
     {
        include("main_app.php");
     }
  }

  if ($view == 'coupon' || $view == 'product' || $view == 'sale' || $view == 'sale_line_item' || $view == 'deal' || $view == 'my_savings' || $view == 'my_shopping_list' || $view == 'my_stores' || $view == 'my_coupons' || $view == 'user' || $view == 'request_catalog_update' || $view == 'best_price' || $view == 'product_best_price' || $view == 'what_did_you_pay')
  {
     if (tep_session_is_registered('user_id')) 
     {
        if (isset($_GET['view']) && ($_GET['view'] == 'coupon'))
        {
           include("coupon.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'product'))
        {
           include("product.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'sale'))
        {
           include("sale.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'sale_line_item'))
        {
           include("sale_line_item.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'deal'))
        {
           include("deal.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_savings'))
        {
           include("my_savings.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_coupons'))
        {
           include("my_coupons.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_shopping_list'))
        {
           include("my_shopping_list.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_stores'))
        {
           include("my_stores.php");
        }
        else if (isset($_GET['view']) && (($_GET['view'] == 'best_price')) || ($_GET['view'] == 'product_best_price'))
        {
           include("best_price.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'what_did_you_pay'))
        {
           include("what_did_you_pay.php");
        }
        else
        if (isset($_GET['view']) && ($_GET['view'] == 'request_catalog_update'))
        {
           include("request_catalog_update.php");
        }
        else
        if (isset($_GET['view']) && ($_GET['view'] == 'user'))
        {
           include("user.php");
        }
        else if ($_GET['view'] != 'search')
        {
            include("main_app.php");
        }
     }
     else
     {
        echo "<div class=\"componentheading\">Error</div>\n";
        echo "This content is restricted by login.  Please <a href=/bstm/main/index.php?view=register&action=display>register</a> for an account to see this data";
     } 
  }
?>
<!--
												<div class="moduletable">
					<div>Copyright &#169; 2010 Bring Savings To Me. All Rights Reserved.</div>
<div></div>		</div> -->
	
									</td>
<!-- Divider Line -->
																	</tr>
							</table> <!-- table with 1 tr and X tds -->

						<div class="clr"></div>
					</div>
					<div class="clr"></div>
<!-- Footer Begin -->
<?php include("footer.php"); ?>
