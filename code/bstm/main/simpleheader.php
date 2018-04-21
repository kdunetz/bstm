<?php 
  $moble_browser = '0';
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
}    
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
    $mobile_browser = 0;
}
 

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
require('../common/functions2.php');

if ($_GET['view'] == 'mobile_view')
{
   $override_redirect = false;
   tep_session_unregister('override_redirect');
}
/* KAD is putting this here because function is in general.php */
if ($mobile_browser > 0 && !isset($_GET['override_redirect']) && !$override_redirect) {
   tep_redirect('http://www.bringsavingstome.com/bstm/mobile/index.php');
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
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="Coupons, Groupons, Save, Living Social, Money, Save Money, Sales, Best Price, AOL WOW" />
<meta name="description" content="Bring Savings To Me - Where the Money comes to You" />
<title>Bring Savings To Me<?php if (strlen($_GET['title']) > 0) echo " - " . $_GET['title']; ?></title>
<!--<link href="/bstm/ui/index.php?format=feed&amp;type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />-->
<!--<link href="/bstm/ui/index.php?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" /> -->
<link href="/bstm/ui/images/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
<script type="text/javascript" src="/bstm/ui/media/system/js/mootools.js"></script>
<script type="text/javascript" src="/bstm/ui/media/system/js/caption.js"></script>
<script type="text/javascript" src="/bstm/ui/media/system/js/validate.js"></script> <!-- KAD added to validate forms -->



<link rel="stylesheet" href="/bstm/ui/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/rhuk_milkyway/css/template5largefont.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/rhuk_milkyway/css/blue.css" type="text/css" />
<link rel="stylesheet" href="/bstm/ui/templates/rhuk_milkyway/css/blue_bg.css" type="text/css" />

<!-- KAD added for calendars -->
<link rel="stylesheet" type="text/css" media="all" href="/bstm/ui/includes/js/jscalendar-1.0/calendar-system.css" title="green" />
<script type="text/javascript" src="/bstm/ui/includes/js/jscalendar-1.0/calendar_stripped.js"></script>
<script type="text/javascript" src="/bstm/ui/includes/js/jscalendar-1.0/lang/calendar-en.js"></script>
<script type="text/javascript" src="/bstm/ui/includes/js/jscalendar-1.0/calendar-setup_stripped.js"></script>

<!--[if lte IE 6]>
<link href="/bstm/ui/templates/rhuk_milkyway/css/ieonly.css" rel="stylesheet" type="text/css" />
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

<div class="clr"></div> 
</div>

</div> 
				</div>
			</div>
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
