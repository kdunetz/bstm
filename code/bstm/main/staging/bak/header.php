<?php

  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

  require('general.php');
  require('html_output.php');
  require('boxes.php');
  require('table_block.php');
 // require('sessions.php');
  require('initialize.php');

// initialize the message stack for output messages
  require('message_stack.php');
  $messageStack = new messageStack;

  $error = false;
  if ($_GET['view'] == 'login' && isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $password = tep_db_prepare_input($_POST['password']);

// Check if email exists
    $check_user_query = tep_db_query("select * FROM user where email = '" . tep_db_input($email_address) . "'");
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
        tep_session_register('user_id');
        tep_session_register('user_name');
        tep_session_register('first_name');
        tep_session_register('zipcode');
        tep_session_register('role');

        tep_db_query("update user set date_of_last_login = now(), number_of_logins = number_of_logins + 1 where user_id = '" . (int)$user_id . "'");

        tep_redirect(tep_href_link('index.php'));
      }
    }
  }
  $view = $_GET['view'];
  if (!tep_session_is_registered('user_id') && ($view == 'shopping_list' || $view == 'my_savings')) 
  {
     $_GET['view'] = "";
     $_GET['action'] = "";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="Coupons, Groupons, Save, Living Social, Money, Save Money, Sales, Best Price" />
  <meta name="description" content="Bring Savings To Me - Where the money comes to you" />
  <meta name="generator" content="Joomla! 1.5 - Open Source Content Management" />
  <title>Bring Savings To Me</title>
  <link href="/bstm_joomla/index.php?format=feed&amp;type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
  <link href="/bstm_joomla/index.php?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" />
  <link href="/bstm_joomla/templates/rhuk_milkyway/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <script type="text/javascript" src="/bstm_joomla/media/system/js/mootools.js"></script>
  <script type="text/javascript" src="/bstm_joomla/media/system/js/caption.js"></script>
  <script type="text/javascript" src="/bstm_joomla/media/system/js/validate.js"></script> <!-- KAD added to validate forms -->
 


<link rel="stylesheet" href="/bstm_joomla/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="/bstm_joomla/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="/bstm_joomla/templates/rhuk_milkyway/css/template.css" type="text/css" />
<link rel="stylesheet" href="/bstm_joomla/templates/rhuk_milkyway/css/blue.css" type="text/css" />
<link rel="stylesheet" href="/bstm_joomla/templates/rhuk_milkyway/css/blue_bg.css" type="text/css" />
<!--[if lte IE 6]>
<link href="/bstm_joomla/templates/rhuk_milkyway/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->

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
/* Bring Savings To Me */
google_ad_slot = "7610772855";
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
     if (strpos($_SERVER['REQUEST_URI'], "view=home") !== false || strpos($_SERVER['REQUEST_URI'],'view') == false)
        $id = "id=\"active_menu-nav\"";
echo "<li><a href=\"index.php?view=home&action=display\" class=\"mainlevel-nav\"" . $id . " >Home</a></li>\n";

  $id = "";
     if (strpos($_SERVER['REQUEST_URI'], "view=about") !== false)
        $id = "id=\"active_menu-nav\"";
echo "<li><a href=\"index.php?view=about&action=display\" class=\"mainlevel-nav\"" . $id . " >About Brings Savings To Me</a></li>\n";

  $id = "";
     if (strpos($_SERVER['REQUEST_URI'], "view=contact") !== false)
        $id = "id=\"active_menu-nav\"";
echo "<li><a href=\"index.php?view=contact&action=display\" class=\"mainlevel-nav\"" . $id . " >Contact Us</a></li>\n";

/*
  $id = "";
     if (strpos($_SERVER['REQUEST_URI'], "view=deals") !== false)
        $id = "id=\"active_menu-nav\"";
echo "<li><a href=\"/bstm_joomla/index.php?option=com_joobb&amp;view=forum&amp;forum=1&amp;Itemid=57\" class=\"mainlevel-nav\"" . $id . " >Share Deals</a></li>\n";
*/

  $id = "";
  if (tep_session_is_registered('user_id')) {
     if (strpos($_SERVER['REQUEST_URI'], "view=my_savings") !== false)
        $id = "id=\"active_menu-nav\"";
echo "<li><a href=\"index.php?view=my_savings&action=list\" class=\"mainlevel-nav\"" . $id . " >My Savings</a></li>\n";
  }

  $id = "";
  if (tep_session_is_registered('user_id')) {
     if (strpos($_SERVER['REQUEST_URI'], "view=shopping_list") !== false)
        $id = "id=\"active_menu-nav\"";
echo "<li><a href=\"index.php?view=shopping_list&action=list\" class=\"mainlevel-nav\"" . $id . " >Shopping List</a></li>\n";
  }
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
		<input name="searchword" id="mod_search_searchword" maxlength="20" alt="Search" class="inputbox" type="text" size="20" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />	</div>
</form>
			</div>

			<div id="pathway">
				<span class="breadcrumbs pathway">
Home</span>

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
