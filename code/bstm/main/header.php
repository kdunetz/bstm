<?php 
require('configure.php');
require('database.php');
tep_db_connect();
require('functions.php');
require('../common/functions2.php');

require('general.php');
require('html_output.php');
require('boxes.php');
require('table_block.php');
// require('sessions.php');
require('initialize.php');

if ($_GET['view'] == 'mobile_view')
{
   $override_redirect = false;
   tep_session_unregister('override_redirect');
}
/* KAD is putting this here because function is in general.php */
if ($mobile_browser > 0 && !isset($_GET['override_redirect']) && !$override_redirect) {
   $url = "http://www.bringsavingstome.com/bstm/mobile/index.php?";
/* KAD need to make this dynamic ..just wanted to get it going for this one use case */
   if ($_GET['view'] == "best_price") 
      $_GET['view'] = "product_best_price";
/* we assume that view is the first argument after the "?" */
   if (isset($_GET['view']))
      $url .= "view=" . $_GET['view'];
   if (isset($_GET['action']))
      $url .= "&action=" . $_GET['action'];
   if (isset($_GET['searchword']))
      $url .= "&searchword=" . $_GET['searchword'];
   if (isset($_GET['sale_line_item_id']))
      $url .= "&sale_line_item_id=" . $_GET['sale_line_item_id'];
   if (isset($_GET['product_id']))
      $url .= "&product_id=" . $_GET['product_id'];
   if (isset($_GET['sale_id']))
      $url .= "&sale_id=" . $_GET['sale_id'];
   if (isset($_GET['deal_id']))
      $url .= "&deal_id=" . $_GET['deal_id'];
   if (isset($_GET['coupon_id']))
      $url .= "&coupon_id=" . $_GET['coupon_id'];
   if (isset($_GET['product_best_price_id']))
      $url .= "&product_best_price_id=" . $_GET['product_best_price_id'];
   tep_redirect($url);
}
if (isset($_GET['override_redirect'])) 
{
   $override_redirect = true;
   tep_session_register('override_redirect');
}

// initialize the message stack for output messages
require('message_stack.php');
$messageStack = new messageStack;

$error = false;
if ($_GET['view'] == 'login' && isset($_GET['action']) && ($_GET['action'] == 'process')) {
$email_address = tep_db_prepare_input($_POST['email_address']);
$password = tep_db_prepare_input($_POST['password']);

// Check if email exists
$check_user_query = tep_db_query("select *, concat(first_name, ' ', last_name) as user_name FROM user where email = '" . tep_db_input($email_address) . "'");
if (!tep_db_num_rows($check_user_query)) {
//echo "in here 1";
$error = true;
} else {
$check_user = tep_db_fetch_array($check_user_query);
// Check that password is good
//if (!tep_validate_password($password, $check_user['password'])) {
$password = base64_encode(sha1($password,true));
if ($password != $check_user['password']) {
$error = true;
//echo "in here 2";
} else {
//echo "in here 3";

$user_id = $check_user['user_id'];
$user_name = $check_user['user_name'];
$first_name = $check_user['first_name'];
$zipcode = $check_user['zipcode'];
$role = $check_user['role'];
$email = $check_user['email'];
$location_filter = $check_user['location'];
$location_filter .= "," . $check_user['location2'];
$location_filter .= "," . $check_user['location3'];
$location_filter .= "," . $check_user['location4'];
$location_filter .= "," . $check_user['location5'];
tep_session_register('user_id');
tep_session_register('user_name');
tep_session_register('first_name');
tep_session_register('zipcode');
tep_session_register('location_filter');
tep_session_register('role');
tep_session_register('email');

tep_db_query("update user set date_of_last_login = now(), number_of_logins = number_of_logins + 1 where user_id = '" . (int)$user_id . "'");

tep_redirect(tep_href_link('index.php'));
}
}
}
$view = $_GET['view'];
if (!tep_session_is_registered('user_id') && ($view == 'my_shopping_list' || $view == 'my_savings')) 
{
$_GET['view'] = "";
$_GET['action'] = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
<head>
<meta name="google-site-verification" content="5UetU9UxveMAbVBGCHNiGEdCuCRrN9T9TrBYoPYzUH4" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="Coupons, Groupons, Save, Living Social, Money, Save Money, Sales, Best Price, AOL WOW" />
<meta name="description" content="Bring Savings To Me - Where the Money Comes to You" />
<?php 
if ($_GET['view'] == 'sale_line_item' && $_GET['action'] == 'display')
{
   if (isset($_GET['sale_line_item_id']))
   {
     $objects_query = tep_db_query("SELECT sale_line_item.*, sale.end_date, store.store_name, product.product_name FROM sale, store, sale_line_item, product WHERE sale_line_item.sale_id = sale.sale_id AND sale.store_id = store.store_id AND sale_line_item.product_id = product.product_id AND sale_line_item.sale_line_item_id = " . $_GET['sale_line_item_id']);
     $objects = tep_db_fetch_array($objects_query);
     $_GET['title'] = $objects['product_name'] . " on Sale at " . $objects['store_name'];
   }
}
if (($_GET['view'] == 'best_price' || $_GET['view'] == 'product_best_price') && ($_POST['action'] == 'edit' || $_POST['action'] == 'create' || $_GET['action'] == 'display'))
{
   if (isset($_POST['product_best_price_id']))
   {
      $_GET['product_best_price_id'] = $_POST['product_best_price_id'];
   }
   if (isset($_GET['product_best_price_id']))
   {
     $objects_query = tep_db_query("SELECT product_best_price.*, store.store_name, vendor.vendor_name, product.product_name FROM product_best_price, store, product, vendor WHERE product.vendor_id = vendor.vendor_id AND product_best_price.store_id = store.store_id AND product_best_price.product_id = product.product_id AND product_best_price.product_best_price_id = " . $_GET['product_best_price_id']);
     $objects = tep_db_fetch_array($objects_query);
     $_GET['title'] = $objects['product_best_price_name'] . " Price Alert for " . $objects['store_name'];
   }
}
?>
<title>Bring Savings To Me<?php if (strlen($_GET['title']) > 0) echo " - " . $_GET['title']; ?></title>
<!--<link href="/bstm/ui/index.php?format=feed&amp;type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />-->
<!--<link href="/bstm/ui/index.php?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" /> -->
<link href="/bstm/ui/images/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
<script type="text/javascript" src="/bstm/ui/media/system/js/mootools.js"></script>
<script type="text/javascript" src="/bstm/ui/media/system/js/caption.js"></script>
<script type="text/javascript" src="/bstm/ui/media/system/js/validate.js"></script> <!-- added to validate forms -->



<link rel="stylesheet" href="/bstm/ui/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/rhuk_milkyway/css/template5.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/rhuk_milkyway/css/blue.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/rhuk_milkyway/css/blue_bg.css" type="text/css" />

<!-- added for calendars -->
<link rel="stylesheet" type="text/css" media="all" href="/bstm/ui/includes/js/jscalendar-1.0/calendar-system.css" title="green" />
<script type="text/javascript" src="/bstm/ui/includes/js/jscalendar-1.0/calendar_stripped.js"></script>
<script type="text/javascript" src="/bstm/ui/includes/js/jscalendar-1.0/lang/calendar-en.js"></script>
<script type="text/javascript" src="/bstm/ui/includes/js/jscalendar-1.0/calendar-setup_stripped.js"></script>

<!--[if lte IE 6]>
<link href="/bstm/ui/templates/rhuk_milkyway/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25106886-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body id="page_bg" class="color_blue bg_blue width_fmax">
<a name="up" id="up"></a>
<div class="center" align="center">
<div id="wrapper">
	<div id="wrapper_r">
		<div id="header">
			<div id="header_l">
				<div id="header_r">
					<div id="logo"></div>
					<div class="bannergroup"> 

<div class="banneritem">

<script type="text/javascript"><!--
google_ad_client = "ca-pub-4542959536048980";
/* Bring Savings To me */
google_ad_slot = "6274819872";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<div class="clr"></div> 
</div>

</div> 
				</div>
			</div>
		</div>

		<div id="tabarea">
			<div id="tabarea_l">
				<div id="tabarea_r">
					<div id="tabmenu">
					<table cellpadding="0" cellspacing="0" class="pill">
						<tr>
							<td class="pill_l">&nbsp;</td>
							<td class="pill_m">
							<div id="pillmenu">
								<ul id="mainlevel-nav">
<?php
$id = "";
$breadCrumb = "";
if (tep_session_is_registered('user_id')) {
  if ($role == 'admin')
  {
     if (strpos($_SERVER['REQUEST_URI'], "view=admin") !== false)
     {
        $breadCrumb = "Admin";
        $id = "id=\"active_menu-nav\"";
     }
     echo "<li><a href=\"index.php?view=admin&action=list\" class=\"mainlevel-nav\"" . $id . " >Admin</a></li>\n";
     $id = "";
  }
  //$breadCrumb = "My Shopping List";
  if (strpos($_SERVER['REQUEST_URI'], "view=my_shopping_list") !== false || strpos($_SERVER['REQUEST_URI'],'view') === false)
  {
     $breadCrumb = "My Shopping List";
     $id = "id=\"active_menu-nav\"";
  }
  echo "<li><a href=\"index.php?view=my_shopping_list&action=list\" class=\"mainlevel-nav\"" . $id . " >My Shopping List</a></li>\n";
}
else
{
   if (strpos($_SERVER['REQUEST_URI'], "view=home") !== false || strpos($_SERVER['REQUEST_URI'],'view') == false)
   {
      $id = "id=\"active_menu-nav\"";
   }
   echo "<li><a href=\"index.php?view=home&action=display\" class=\"mainlevel-nav\"" . $id . " >Home</a></li>\n";
}

if (tep_session_is_registered('user_id')) {
   $id = "";
   if (strpos($_SERVER['REQUEST_URI'], "view=savings_dashboard") !== false)
   {
      $id = "id=\"active_menu-nav\"";
      $breadCrumb = "Savings Dashboard";
   }
   echo "<li><a href=\"index.php?view=savings_dashboard&action=display\" class=\"mainlevel-nav\"" . $id . " >Savings Dashboard</a></li>\n";
}

if (false)
{
$id = "";
if (strpos($_SERVER['REQUEST_URI'], "view=about") !== false)
{
   $id = "id=\"active_menu-nav\"";
   $breadCrumb = "About";
}
echo "<li><a href=\"index.php?view=about&action=display\" class=\"mainlevel-nav\"" . $id . " >About Brings Savings To Me</a></li>\n";
}

if (!tep_session_is_registered('user_id')) {
   $id = "";
   if (strpos($_SERVER['REQUEST_URI'], "view=how_it_works") !== false)
   {
      $id = "id=\"active_menu-nav\"";
      $breadCrumb = "How It Works";
   }
   echo "<li><a href=\"index.php?view=how_it_works&action=display\" class=\"mainlevel-nav\"" . $id . " >How It Works Test KAD</a></li>\n";
   $id = "";
   if (strpos($_SERVER['REQUEST_URI'], "view=register") !== false)
   {
      $id = "id=\"active_menu-nav\"";
      $breadCrumb = "Create Account";
   }
   echo "<li><a href=\"index.php?view=register&action=display\" class=\"mainlevel-nav\"" . $id . " >Create Account</a></li>\n";
}




/*
$id = "";
if (strpos($_SERVER['REQUEST_URI'], "view=deals") !== false)
$id = "id=\"active_menu-nav\"";
echo "<li><a href=\"/bstm/ui/index.php?option=com_joobb&amp;view=forum&amp;forum=1&amp;Itemid=57\" class=\"mainlevel-nav\"" . $id . " >Share Deals</a></li>\n";
*/

/* took out temporarily
$id = "";
if (tep_session_is_registered('user_id')) {
if (strpos($_SERVER['REQUEST_URI'], "view=my_savings") !== false)
$id = "id=\"active_menu-nav\"";
echo "<li><a href=\"index.php?view=my_savings&action=list\" class=\"mainlevel-nav\"" . $id . " >My Savings</a></li>\n";
}
*/

$id = "";
if (tep_session_is_registered('user_id')) {
if (strpos($_SERVER['REQUEST_URI'], "view=my_coupons") !== false)
{
   $id = "id=\"active_menu-nav\"";
   $breadCrumb = "My Coupons";
}
echo "<li><a href=\"index.php?view=my_coupons&action=list\" class=\"mainlevel-nav\"" . $id . " >My Coupons</a></li>\n";
}

$id = "";
if (tep_session_is_registered('user_id')) {
if (strpos($_SERVER['REQUEST_URI'], "view=my_stores") !== false)
{
   $id = "id=\"active_menu-nav\"";
   $breadCrumb = "My Stores/Restaurants";
}
   echo "<li><a href=\"index.php?view=my_stores&action=display_my_stores\" class=\"mainlevel-nav\"" . $id . " >My Stores/Restaurants</a></li>\n";
}
$id = "";
if (strpos($_SERVER['REQUEST_URI'], "view=contact") !== false)
{
   $id = "id=\"active_menu-nav\"";
   $breadCrumb = "Contact Us";
}
echo "<li><a href=\"index.php?view=contact&action=display\" class=\"mainlevel-nav\"" . $id . " >Contact Us</a></li>\n";
/*
$id = "";
if (tep_session_is_registered('user_id')) {
if (strpos($_SERVER['REQUEST_URI'], "view=my_shopping_list") !== false)
{
   $id = "id=\"active_menu-nav\"";
   $breadCrumb = "My Shopping List";
}
echo "<li><a href=\"index.php?view=my_shopping_list&action=list\" class=\"mainlevel-nav\"" . $id . " >My Shopping List</a></li>\n";
}
*/
?>
</ul>
							</div>
							</td>
							<td class="pill_r">&nbsp;</td>
						</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div id="search">
			<form action="index.php?view=search&action=search" method="post">
	           <div class="search">
		<input name="searchword" id="mod_search_searchword" maxlength="40" alt="Search" class="inputbox" type="text" size="40" value="Enter Product Name"  onblur="if(this.value=='') this.value='Enter Product Name';" onfocus="if(this.value=='Enter Product Name') this.value='';" />	
                   </div>
</form>
		</div>

			<div id="pathway">
				<span class="breadcrumbs pathway">
Home<?php if (strlen($breadCrumb) > 0) echo " -> " . $breadCrumb;?> </span>

			</div>

			<div class="clr"></div>

			<div id="whitebox">
				<div id="whitebox_t">
					<div id="whitebox_tl">
						<div id="whitebox_tr"></div>
					</div>
				</div>

				<div id="whitebox_m">
<!-- Begin Entire White Area with rounded edges -->
					<div id="area">
<!-- End of Header -->
