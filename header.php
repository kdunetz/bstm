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
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
    $mobile_browser = 0;
}
 

/*
require('configure.php');
require('database.php');
tep_db_connect();
require('functions.php');
*/

require('sessions.php');
require('general.php');
/*
require('html_output.php');
require('boxes.php');
require('table_block.php');
// require('sessions.php');

require('initialize.php');
*/

if ($_GET['view'] == 'mobile_view')
{
   $override_redirect = false;
   tep_session_unregister('override_redirect');
}
/* KAD is putting this here because function is in general.php */
if ($mobile_browser > 0 && !isset($_GET['override_redirect']) && !$override_redirect) {
   tep_redirect('http://bstm.trybats.com/mobile/index.php');
}
else
{
   tep_redirect('http://bstm.trybats.com/bstm/main/index.php');
}
