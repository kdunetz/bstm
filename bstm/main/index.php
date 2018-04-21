<?php 
//file_put_contents("bstm.log", date("Y-m-d H:i:s") . " - " . $_SERVER['REMOTE_ADDR'] . " - " . $_SERVER["REQUEST_URI"] . " - " . $_SERVER['HTTP_REFERER'] . "\n", FILE_APPEND);
include("header.php"); ?>

<!-- First Pane Begin -->
						<div id="leftcolumn">
<!-- Begin Box 1 -->
															<div class="module_menu">
			<div>
				<div>
					<div>
													<h3>Resources</h3>
											<ul class="menu"><li class="item11"><a href="index.php?view=list_of_coupon_sites"><span>List of Coupon Sites</span></a></li>
											<li class="item11"><a href="index.php?view=list_of_deals"><span>List of Deals</span></a></li>
											<li class="item12"><a href="index.php?view=list_of_products"><span>List of Products</span></a></li>
<?php
  if (tep_session_is_registered('user_id')) 
  {
      echo "<li class=\"item11\"><a href=\"index.php?view=coupon&action=display_create_form\"><span>Enter Coupon</span></a></li>\n";
      echo "<li class=\"item11\"><a href=\"index.php?view=deal&action=display_create_form\"><span>Enter Deal</span></a></li>\n";
      echo "<li class=\"item11\"><a href=\"index.php?view=best_price&action=display_create_form\"><span>Enter Best Price</span></a></li>\n";
      if ($user_id == 1)
         echo "<li class=\"item11\"><a href=\"index.php?view=what_did_you_pay&action=display_list\"><span>What Did You Pay?</span></a></li>\n";
  }
?>
</ul>					</div>
				</div>
			</div>
		</div>
<!-- End Box 1 -->
<!-- Begin Box 2 -->
<?php
  if (!tep_session_is_registered('user_id')) 
  {
     include("login_box.php");
  }
  else
  {
     include("logoff_box.php");
  }
?>
<!-- End Box 2 -->
<!-- Begin Box 3 -->
<div class="module">
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="www.bringsavingstome.com" layout="button_count" show_faces="false" width="200"></fb:like>
</div>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-4542959536048980";
/* Bring Savings to Me Left Column */
google_ad_slot = "1973493264";
google_ad_width = 120;
google_ad_height = 240;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<!--
			<div class="module">
			<div>
				<div>
					<div>
													<h3>Jumi</h3>
											<div style="color:#FF0000;background:#FFFF00;">Jumi is working but there is <b>nothing to be shown</b>.<br />Write the code and/or specify the nonempty source of the code.</div>					
                                        </div>
				</div>
			</div>
		        </div>
-->
<!-- End Box 3 -->
<!-- Begin Box 4  -->
<!--
			<div class="module">
			<div>
				<div>
					<div>
													<h3>Jumi Copy</h3>
											<div style="color:#FF0000;background:#FFFF00;">Jumi is working but there is <b>nothing to be shown</b>.<br />Write the code and/or specify the nonempty source of the code.</div>					
                                        </div>
				</div>
			</div>
		        </div>
-->
<!-- End Box 4  -->
												</div>
<!-- End Left Pane -->

<!-- Being Middle Pane -->
												<div id="maincolumn">
													
							<table class="nopad">
								<tr valign="top">
									<td>
<?php
  $view = $_GET['view'];
  if ($view == '' || $view == 'forgot_password' || $view == 'login' || $view == 'register' || $view == 'contact' || $view == 'how_it_works' || $view == 'about' || $view == 'list_of_coupon_sites' || $view == 'list_of_deals' || $view == 'list_of_products' || $view == 'home' || $view == 'search' || $view == 'add_zone')
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
     else if (isset($_GET['view']) && ($_GET['view'] == 'list_of_products'))
     {
        include("list_of_products.php");
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
        //include("main_app.php");
        include("my_shopping_list.php");
     }
  }

  if ($view == 'coupon' || $view == 'product' || $view == 'sale' || $view == 'sale_line_item' || $view == 'deal' || $view == 'my_savings' || $view == 'my_shopping_list' || $view == 'savings_dashboard' || $view == 'my_stores' || $view == 'my_coupons' || $view == 'user' || $view == 'request_catalog_update' || $view == 'best_price' || $view == 'product_best_price' || $view == 'what_did_you_pay' || $view == 'admin')
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
        else if (isset($_GET['view']) && (($_GET['view'] == 'best_price')) || ($_GET['view'] == 'product_best_price'))
        {
           include("best_price.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_savings'))
        {
           include("my_savings.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'savings_dashboard'))
        {
           include("main_app.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_coupons'))
        {
           include("my_coupons.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_shopping_list'))
        {
           include("my_shopping_list.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'admin'))
        {
           include("admin.php");
        }
        else if (isset($_GET['view']) && ($_GET['view'] == 'my_stores'))
        {
           include("my_stores.php");
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
            //include("main_app.php");
            include("my_shopping_list.php");
        }
     }
     else
     {
        if (true)
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
           else if (isset($_GET['view']) && (($_GET['view'] == 'best_price')) || ($_GET['view'] == 'product_best_price'))
           {
              include("best_price.php");
           }
           else
           {
              echo "<div class=\"componentheading\">Error</div>\n";
              echo "This content is restricted by login.  Please <a href=/bstm/main/index.php?view=register&action=display>register</a> for an account to see this data";
           }
        }
        else
        {
           echo "<div class=\"componentheading\">Error</div>\n";
           echo "This content is restricted by login.  Please <a href=/bstm/main/index.php?view=register&action=display>register</a> for an account to see this data";
        } 
     }
  }
?>
<!--
												<div class="moduletable">
					<div>Copyright &#169; 2010 Bring Savings To Me. All Rights Reserved.</div>
<div></div>		</div> -->
	
									</td>
<!-- Divider Line -->
																			<td class="greyline">&nbsp;</td>
<!-- Left Pane Begin -->
										<td width="170">
<!-- Box 1 Begin -->
<?php include("tips.php"); ?>
<!-- Box 1 End -->
<!-- Box 2 Begin -->
<?php include("hot_deals.php"); ?>
<!-- Box 2 End -->
<!-- Box 3 Begin -->
<?php include("current_sales.php"); ?>
<!--<?php include("polls.php"); ?>-->
<!--
			<div class="moduletable">
					<h3>Who's Online</h3>
					 We have&nbsp;2 guests&nbsp;online		</div>
-->
<!-- Box 3 End -->
<!-- Box 4 Begin -->
<!--
			<div class="moduletable_text">
					<h3>Advertisement</h3>
					<div class="bannergroup_text">

	<div class="bannerheader">Featured Links:</div>

	<div class="bannerfooter_text">
		 <a href="http://www.joomla.org">Ads by Joomla!</a>	</div>
</div>		</div>
-->
<!-- Box 4 End -->
	
										</td>
																	</tr>
							</table> <!-- table with 1 tr and X tds -->

						</div>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
<!-- Footer Begin -->
<?php include("footer.php"); ?>
