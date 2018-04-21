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

/*
$url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  //if (strpos(strtoupper($_POST['sql_statement']), "UPDATE") !== false && isset($_POST['action']) && ($_POST['action'] == 'execute_sql') && strlen($_POST['sql_statement']) > 0) 
 && strpos($url,"home.php") !== false) {
*/
  if (isset($_GET['username']) && isset($_GET['key']))
  {
    $email_address = tep_db_prepare_input($_key['key1']);
    $password = tep_db_prepare_input($_key['key2']);

// Check if email exists
    $check_user_query = tep_db_query("select * FROM user where email = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_user_query)) {
//echo "in here 1";
      $error = true;
      return;
    } else {
      $check_user = tep_db_fetch_array($check_user_query);
// Check that password is good
      $password = base64_encode(sha1($password,true));
      //if (!tep_validate_password($password, $check_user['password'])) 
      if ($password != $check_user['password']) {
        $error = true;
        return;
//echo "in here 2";
      } else {
//echo "in here 3";

        $user_id = $check_user['user_id'];
        $user_name = $check_user['user_name'];
        $user_name = $check_user['first_name'];
        $user_zone_id = $check_user['zone_id'];
        tep_session_register('user_id');
        tep_session_register('user_name');
        tep_session_register('first_name');
        tep_session_register('user_zone_id');

        tep_db_query("update user set date_of_last_login = now(), number_of_logins = number_of_logins + 1 where user_id = '" . (int)$user_id . "'");
      }
    }
  }
  if (!tep_session_is_registered('user_id')) {
    //$navigation->set_snapshot();
    tep_redirect(tep_href_link('index.php?tab=3', '', 'SSL'));
  }
  if (isset($_GET['tab']))
  {
     $tab = $_GET['tab'];
  }
  else
  {
     $tab = 1;
  }
  if (isset($_GET['subtab']))
  {
     $subtab = $_GET['subtab'];
  }
  else
  {
     $subtab = 1;
  }
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="bp-doc">
<head>
<title>Bring Savings To Me</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">.pageTab{width:33%;padding:12px 8px 8px;text-align:center;font-size:93%;font-weight:bold;white-space:nowrap}#tabs-19 .tabLinks td{width:33.3333%}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6{padding:0;margin:0}h1,h2,h3,h4,h5,h6{display:inline;font-weight:normal}img{border:0}table{border:0;border-collapse:collapse;border-spacing:0;width:auto}pre,code,kbd,samp,tt{font-family:monospace;line-height:99%;font-size:108%}a, a:visited, a:hover, a:active{color:inherit;text-decoration:none}ul, li{list-style-type:none}body{font-size:16px;-webkit-text-size-adjust:none;font-family:Helvetica, 'Nokia Sans', Arial, Sans-serif}.collection{background:#c5ccd7;color:#3e3e3e}.list{background:#fff;color:#000}.collection #pageHeader{margin-bottom:5px}.small{font-size:93%}.title{font-size:115%;font-weight:bold}.article{font-family:Georgia, serif}.article-title{font-weight:normal;font-size:120%}.collection .title{color:#000}.collection .uim .title{color:#000}.collection .featured-uim .title{color:#000}.collection .uim .uim .title{color:#000}.collection .subdued{color:#7c7c7d}.collection .uim .subdued{color:#7c7c7d}.collection .featured-uim .subdued{color:#7c7c7d}.collection .uim .uim .subdued{color:#7c7c7d}.collection .subtext{color:#446b94}.collection .uim .subtext{color:#6271a0}.collection .featured-uim .subtext{color:#446b94}.collection .uim .uim .subtext{color:#6271a0}.collection .positive{color:#007800}.collection .uim .positive{color:#056005}.collection .featured-uim .positive{color:#00a400}.collection .uim .uim .positive{color:#056005}.collection .negative{color:#b30200}.collection .uim .negative{color:#b30200}.collection .featured-uim .negative{color:#b30200}.collection .uim .uim .negative{color:#b30200}.collection .important{color:#b30200;font-weight:bold}.collection .uim .important{color:#b30200}.collection .featured-uim .important{color:#b30200}.collection .uim .uim .important{color:#b30200}.collection .value{color:#405288}.collection .uim .value{color:#405288}.collection .featured-uim .value{color:#405288}.collection .uim .uim .value{color:#405288}.collection .disabled{color:#bcc5cc}.collection .uim .disabled{color:#bcc5cc}.collection .featured-uim .disabled{color:#bcc5cc}.collection .uim .uim .disabled{color:#bcc5cc}.collection .link{color:#006ec2}.collection .uim .link{color:#006ec2}.collection .featured-uim .link{color:#006ec2}.collection .uim .uim .link{color:#006ec2}.collection .url{color:#398f08}.collection .uim .url{color:#398f08}.collection .featured-uim .url{color:#398f08}.collection .uim .uim .url{color:#398f08}.list .title{color:#000}.list .uim .title{color:#000}.list .featured-uim .title{color:#000}.list .uim .uim .title{color:#000}.list .subdued{color:#7c7c7d}.list .uim .subdued{color:#7c7c7d}.list .featured-uim .subdued{color:#7c7c7d}.list .uim .uim .subdued{color:#7c7c7d}.list .subtext{color:#6271a0}.list .uim .subtext{color:#6271a0}.list .featured-uim .subtext{color:#446b94}.list .uim .uim .subtext{color:#6271a0}.list .positive{color:#056005}.list .uim .positive{color:#056005}.list .featured-uim .positive{color:#00a400}.list .uim .uim .positive{color:#056005}.list .negative{color:#b30200}.list .uim .negative{color:#b30200}.list .featured-uim .negative{color:#b30200}.list .uim .uim .negative{color:#b30200}.list .important{color:#b30200;font-weight:bold}.list .uim .important{color:#b30200}.list .featured-uim .important{color:#b30200}.list .uim .uim .important{color:#b30200}.list .value{color:#405288}.list .uim .value{color:#405288}.list .featured-uim .value{color:#405288}.list .uim .uim .value{color:#405288}.list .disabled{color:#bcc5cc}.list .uim .disabled{color:#bcc5cc}.list .featured-uim .disabled{color:#bcc5cc}.list .uim .uim .disabled{color:#bcc5cc}.list .link{color:#006ec2}.list .uim .link{color:#006ec2}.list .featured-uim .link{color:#006ec2}.list .uim .uim .link{color:#006ec2}.list .url{color:#398f08}.list .uim .url{color:#398f08}.list .featured-uim .url{color:#398f08}.list .uim .uim .url{color:#398f08}.uim .subtext.description, .uim-featured .subtext.description{font-size:100%;color:#000}.url{word-break:break-all;word-wrap:break-word}#pageBranding{background:#455681 url(http://l.yimg.com/jg/api/res/1.2/jY_ULCzGPVOVQvNz4SqOrg--//resource:/brand/yahoo/web/1.0.61/image/Hero/theme/steel.cf.png) bottom left repeat-x}#pageHeader .searchBox{padding:0.3em 4px}#pageHeader .searchBox input{margin:0}#toolbar{background:#fff url(http://l.yimg.com/jg/api/res/1.2/ibnE6nXDpFL1_ECFfdaOQg--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/masthead) bottom left repeat-x;padding-bottom:4px}#toolbar .link{color:#006ec2}#toolbar .url{color:#398f08}#toolbar .title{color:#16387c}#toolbar .subtext{color:#6271a0}#toolbar .subdued{color:#7c7c7d}#toolbar .important{color:#b30200}#toolbar .negative{color:#b30200}#toolbar .positive{color:#00a400}#toolbar .value{color:#405288}#toolbar .template .uic img{vertical-align:text-top}.collection #pageTabs{border-bottom:4px solid #fff}#pageTabs table{margin:0 auto;width:90%}#pageTabs .wide{padding:12px 2px 8px;min-width:130px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis}#pageTabs .ptactive{background:#fff;padding:12px 20px 8px;margin:0 10px}.pageTab a, .pageTab a.inline{color:#fff;margin-right:0}#pageTabs .ptactive, #pageTabs .ptactive a{color:#000}div.tabs-compact{font-size:110%;padding:6px 0 8px}div.tabs-compact .tabLinks, #gotos{width:auto;text-align:center;margin:0 auto}body div.tabs-compact .tabLinks td.tabLink, #gotos .goto{background:transparent;border:0;padding:0 12px}body div.tabs-compact .tabLinks td a, body div.tabs-compact .tabLinks td span, #gotos .goto a{color:#3b4056;font-weight:bold}body div.tabs-compact .tabLinks td a, #gotos .goto a{padding:4px 0}body div.tabs-compact table.tabLinks .active a, body div.tabs-compact table.tabLinks .active span, #gotos .active a{color:#000}body div.tabs-compact table.tabLinks .active, #gotos .active{background:#fff;border:1px solid #ccc;padding-top:1px}#gotos{font-size:85%}#titlebar{padding:8px}#titlebar .icon img{vertical-align:middle}#titlebar .widgetTitle{vertical-align:middle;color:#fff;font-weight:bold;margin-left:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-shadow:rgba(0,0,0,1) 0 1px 1px;max-width:192px;display:inline-block}#titlebar #uiCommands{position:absolute;top:10px;right:8px;max-width:40%;text-align:right}#titlebar #uiCommands a{color:#fff;text-decoration:none;text-shadow:rgba(0,0,0,0.7) 0 -1px 1px;font-size:85%;font-weight:bold}#titlebar.minimal{width:100%;padding:0}.minimal .logoAndTitle{padding:12px 4px 12px 10px;white-space:nowrap}img.left{padding-right:.4em}img.right{padding-left:.4em}.favicon img{margin-right:4px;vertical-align:bottom}.image-block{display:block}.caption{display:block;padding:0 1px;clear:both;font-size:72%;margin-top:2px}.sprite{overflow:hidden;display:inline-block;background-repeat:no-repeat}.photoSize{display:block;width:100%;text-align:center}.photoSize img{max-width:295px}.collection .photoSize img{max-width:285px}.uim .uiCommand a{font-size:85%;font-weight:bold;color:#481060}.suim .uiCommand a{color:#674670}.featured .uiCommand a{color:#fff}#titlebar .uiCommand a{color:#fff}.uiCommand.as a, #allSites .uiCommand a{display:block;width:100%;height:100%}.uiCommand .arrowDown{display:inline-block;position:relative;-webkit-transform:scaleY(0.7)}.tabs{padding:0}table.tabLinks{width:100%}table.tabLinks td{background:#fff url(http://l.yimg.com/jg/api/res/1.2/fkdfzxrdohAsRmmC_Xoo0w--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/tab_bkg) bottom left repeat-x;text-align:center;color:#000;font-size:75%;font-weight:bold;border:1px solid #b7c1c8;border-left:0;white-space:nowrap}.uim-featured table.tabLinks td{background:#7c97b6 url(http://l.yimg.com/jg/api/res/1.2/YR9H02edFTrFK202dgQBsA--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/tab_featured_bkg) bottom left repeat-x;border-color:#627390;color:#343d5b}table.tabLinks td.last{border-right:none}body table.tabLinks td.first{border:1px solid #b7c1c8;border-bottom:1px solid #b7c1c8;border-left:0}#content table.tabLinks td.first{border-top:1px solid #b7c1c8}body .uim-featured table.tabLinks td.first{border-color:#627390;border-top:1px solid #627390}table.tabLinks td a.inline{display:block;width:100%;height:100%;padding:8px 0;margin-right:0;color:#16387c}.uim-featured table.tabLinks td a.inline{color:#fff}table.tabLinks td a.inline, table.tabLinks td a.inline:hover, table.tabLinks td a.inline:active, table.tabLinks td a.inline:focus{outline:none}body table.tabLinks td.active{background:#fff;color:#000;border-bottom-color:#fff}body .uim-featured table.tabLinks td.active{background:#eff2fd;border-bottom-color:#eff2fd}table.tabLinks td, table.tabLinks td a{color:#16387c;cursor:pointer}.uim-featured table.tabLinks td, .uim-featured table.tabLinks td a{color:#fff}table.tabLinks td.active a{color:#000}.uim-featured table.tabLinks td.active a{color:#343d5b}body #content .first table.tabLinks td{border-top:0}.tabSection{display:none}.tabSectionShown{display:block}body .tabs .tabSectionShown .uim:first-child, #content .tabs .tabSectionShown div.first{border-top:none}a.inline{color:#006ec2}.uic{display:block}.uim .searchBox-first{padding-top:4px}.searchBox table{width:100%}.searchBox td.input{width:100%}.searchBox td.input input{width:100%;margin-right:0;padding:1px 2px;background:#fff;color:#000;border:1px solid #ababab}.searchBox td.input input.disabled{color:#bcc5cc}.searchBox table td.submit{padding:1px 1px 1px 10px;font-size:105%}input[type="text"], input[type="password"], textarea{font-size:85%;border-top:1px solid #c6c6c6;border-bottom:1px solid #808080;border-left:1px solid #a6a6a6;border-right:1px solid #a6a6a6}.formField input[type="text"], .formField input[type="password"], .formField textarea{width:89%}.formField input[type="submit"], .formField button{font-size:93%;font-weight:bold;border-top:1px solid #c6c6c6;border-bottom:1px solid #808080;border-left:1px solid #a6a6a6;border-right:1px solid #a6a6a6;background:#f0f0f0}form{margin:0}form.inline, form.inline .formField, .formField.inline{display:inline}.formField input, .formField textarea, .formField select, .formField button{font-size:inherit;font-weight:inherit;margin:0 8px 0.3em}.formField textarea{margin-top:.3em;width:89%}.formField input.disabled, .formField textarea.disabled{color:#bcc5cc}#toolbar .formField input.disabled, #toolbar .formField textarea.disabled{color:#bcc5cc}.uim .formField input.disabled, .uim .formField textarea.disabled{color:#bcc5cc}.formField{padding:0}.formField-first{padding-top:0.3em}.formField .uic{color:#3e3e3e}.uim .formField .uic{color:#000}.suim .formField .uic{color:#000}.formLabel{padding:0.3em 8px;color:#4d4d4d}.formField.compact, form.inline .formField.compact{display:block}.compact .formLabel, .compact input, .compact input.text{display:inline}.compact .formLabel{padding-right:0}.formField .item{display:block}input.text{display:block}#content .uim{background:#fff;color:#000}#content .uim-featured, #content .uim-featured .uim{background:#eff2fd;color:#3e3e3e}.uim, #content .list .uim{border:0;border-top:1px solid #dfdfdf;margin:0}.first, #content .list .first{border-top:0}.uim-featured, .uim-featured .uim, #content .list .uim-featured, #content .list .uim-featured .uim{border-color:#7f9ab8}.collection .uim{margin:5px;border:1px solid #a9b0b8;border-top:1px solid #a9b0b8}.collection .uim-featured{border-bottom:1px solid #7f9ab8}.collection .uim .uim{border-width:1px 0 0 0;margin:0}.collection .uim .bd div.first, .collection .uim .hd{border-top:0}.collection .uim .hd:last-child{border-bottom:0}.collection .uim .bd form:first-child{border:0}.collection .doBdrTop{border-top:1px solid #a9b0b8}.collection .doBdrBottom{border-bottom:1px solid #a9b0b8}.collection .doBdrTop .bd div, .collection .doBdrTop .bd a{border-left:0;border-right:0}.collection .uim .bd .uim:first-child .hd, .collection .uim .bd .uim:first-child .hd{border-top:0}.collection .uim .hd + .bd > *:first-child{border-top:0}.collection .uim:last-child{margin-bottom:0}.groupCompact{border-top:1px solid #a9b0b8;padding:0}.groupCompact-first{border-top:0;padding-top:0.3em}.groupCompact .uic, .groupCompact .uip, .uim .groupCompact .uic, .uim .groupCompact .uip{border-top:0;padding:1px 8px}.groupCompact .uip .uic, .uim .groupCompact .uip .uic{padding:1px 0}.groupCompact-last{padding-bottom:0.3em}.groupCompact .uip:last-child, .groupCompact .uic:last-child{padding-bottom:4px}.uip{padding:0.3em 8px}.uip .uic{padding:0.3em 0}.linked .items{background:transparent url(http://l.yimg.com/jg/api/res/1.2/Ao9eCr2JADR7SuorpA2meA--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/arrow_blue) center right no-repeat}.uim-featured .hd-linked .items{background:transparent url(http://l.yimg.com/jg/api/res/1.2/4fFyATt9vncFhkxj5w3lew--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/arrow_white) center right no-repeat}.linked .items td.blocks, .linked .items td.imgR{padding-right:8px}#bp-bd .callout{background:#13428b url(http://l.yimg.com/jg/api/res/1.2/3BAPO27H8SpmP7CcrlJ0tA--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/callout_medium) bottom left repeat-x}#bp-bd .callout *{color:#d3ecff}#bp-bd .callout-linked .items{background:transparent url(http://l.yimg.com/jg/api/res/1.2/4fFyATt9vncFhkxj5w3lew--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/arrow_white) center right no-repeat}#bp-bd .callout .title{color:#fff}#bp-bd .callout .subtext{color:#fff}#bp-bd .callout .subdued{color:#378ca4}#bp-bd .callout .value{color:#fff}#bp-bd .callout-low{background:#f2fafe url(http://l.yimg.com/jg/api/res/1.2/rHCq1HLEgoY_9SOYcVphfg--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/callout_subdued) bottom left repeat-x}#bp-bd .callout-low *{color:#272627}#bp-bd .callout-low-linked .items{background:transparent url(http://l.yimg.com/jg/api/res/1.2/Ao9eCr2JADR7SuorpA2meA--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/arrow_blue) center right no-repeat}#bp-bd .callout-low .title{color:#16387c}#bp-bd .callout-low .subtext{color:#16387c}#bp-bd .callout-low .subdued{color:#656a6d}#bp-bd .callout-low .value{color:#16387c}#bp-bd .callout-strong{background:#fdf099 url(http://l.yimg.com/jg/api/res/1.2/pTBtdh1EEgQmuetW39tocQ--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/callout_strong) bottom left repeat-x}#bp-bd .callout-strong *{color:#272627}#bp-bd .callout-strong-linked .items{background:transparent url(http://l.yimg.com/jg/api/res/1.2/Ao9eCr2JADR7SuorpA2meA--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/arrow_blue) center right no-repeat}#bp-bd .callout-strong .title{color:#16387c}#bp-bd .callout-strong .subtext{color:#50201e}#bp-bd .callout-strong .subdued{color:#7d6d58}#bp-bd .callout-strong .value{color:#16387c}#bp-bd .callout-alert{background:#b91315 url(http://l.yimg.com/jg/api/res/1.2/UcwMraO8016QnJz1FjIgZg--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/callout_alert) bottom left repeat-x}#bp-bd .callout-alert *{color:#ffe6a2}#bp-bd .callout-alert-linked .items{background:transparent url(http://l.yimg.com/jg/api/res/1.2/4fFyATt9vncFhkxj5w3lew--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/arrow_white) center right no-repeat}#bp-bd .callout-alert .title{color:#fff}#bp-bd .callout-alert .subtext{color:#fff}#bp-bd .callout-alert .subdued{color:#e79576}#bp-bd .callout-alert .value{color:#fff}table.template{width:100%}.uim .uip table.template tr td .uic{padding:1px 0}table.template td{vertical-align:top}table.template.single td{vertical-align:middle}.template td.icon{padding:1px 0 0 0;text-align:center}.template .uic img{margin-left:3px}.template .uip, .template .uic{padding:0}.template .title-cell{text-align:left}.template .value-cell{white-space:nowrap;text-align:right}.linked .template .value-cell{padding-right:12px}.template .value-cell .uic{white-space:nowrap;color:#405288}.uim .template .value-cell .uic{color:#405288}.uim-featured .template .value-cell .uic{color:#405288}.template .description-cell .floatL{float:none}.uic, .uip{display:block;padding:0.3em 8px}.uic img + a.inline{margin-left:2px}.uic img, .uic img + a.inline{vertical-align:middle}.uim .uic, .uim .uip{border-top:1px solid #dfdfdf}.uic.first, .uip.first, .collection .uim .uic.first, .collection .uim .uip.first, .collection .uim .uim .uic.first{border-top:0}.uim .uic{border-top:1px solid #dfdfdf}.uim-featured .uic{border-top:1px solid #7991a7}.uim .uic.first, .uim .uim .uic.first{border-top:0}.center{text-align:center}.left, .natural{text-align:left}.right, .opposite{text-align:right}#content strong, #content .uim strong{font-weight:bold}table.items{width:100%}.items .blocks, .items .imgR{vertical-align:middle}.items .imgL{vertical-align:top}.placardSet .items .imgL{vertical-align:middle}.imgL, .tpl .icon{padding-right:4px}.tpl .icon{text-align:center}.imgL span.sprite{display:block}.imgR{padding:1px 12px 1px 4px;white-space:nowrap}.blocks{width:100%}.blocks .uic, .uim .uip .uic{padding:0;border-top:none}hr.native{margin:0;height:2px;background:#6e7577;border:none;border-bottom:1px solid #aeb6ba;clear:both}.hd{position:relative;font-size:93%}.section .hd{background-color:transparent;background-image:none}.section .hd .uic{padding:0.3em 7px;color:#4e5980}.section .uim .hd .uic{padding:0.3em 8px}.section .hd .uic a{color:#4e5980}.section .hd .uiCommand a{font-size:85%;font-weight:bold;color:#4e5980}.section .items{padding:0}.section .uim .items{padding:0.3em 0}.section .hd-linked{padding-right:7px}.hd .uiCommand{display:block;text-align:right;position:absolute;right:8px;top:0.4em}.section .hd-uicommand-short .uiCommand{top:0.2em}.section .hd-linked .uiCommand{right:15px}.hd .uiCommand a{font-size:85%;font-weight:bold;color:#481060;text-decoration:none}.uim-featured .hd .uiCommand a{color:#fff}.uim .hd{padding:0.4em 8px 0.3em;background:#fff url(http://l.yimg.com/jg/api/res/1.2/I663Ovmnbl42H7oiR6CB8A--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/module_header) bottom left repeat-x;border-bottom:1px solid #b7c1c8}.uim .hd-uicommand{padding-right:4em}.uim .hd .uic{border-top:0;color:#000;font-weight:bold}.uim .uim .hd .uic{color:#596c7b}.uim-featured .hd{background:#98adc6 url(http://l.yimg.com/jg/api/res/1.2/3VVVsW2eq58Vw1jkk5RfXw--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/module_featured_header) bottom left repeat-x;border-bottom:1px solid #446b94}.uim-featured .hd .uic, #content .uim-featured .hd .uic{color:#fff}.uim .hd .title{color:#000}.uim .uim .hd .title{color:#000}.uim-featured .hd .title, .uim-featured .uim .hd .title{color:#fff}.uim .hd .subdued{color:#7c7c7d}.uim .uim .hd .subdued{color:#676867}.uim-featured .hd .subdued, .uim-featured .uim .hd .subdued{color:#d6e0ee}.uim .hd .subtext{color:#6271a0}.uim .uim .hd .subtext{color:#446b94}.uim-featured .hd .subtext, .uim-featured .uim .hd .subtext{color:#ffe294}.uim .hd .positive{color:#056005}.uim .uim .hd .positive{color:#056005}.uim-featured .hd .positive, .uim-featured .uim .hd .positive{color:#5bf65d}.uim .hd .negative{color:#b30200}.uim .uim .hd .negative{color:#b30200}.uim-featured .hd .negative, .uim-featured .uim .hd .negative{color:#b30200}.uim .hd .important{color:#b30200}.uim .uim .hd .important{color:#b30200}.uim-featured .hd .important, .uim-featured .uim .hd .important{color:#ffe400}.uim .hd .value{color:#405288}.uim .uim .hd .value{color:#405288}.uim-featured .hd .value, .uim-featured .uim .hd .value{color:#c6fb29}.uim .hd .link{color:#006ec2}.uim .uim .hd .link{color:#006ec2}.uim-featured .hd .link, .uim-featured .uim .hd .link{color:#ffdb79}#content .navbar{background:#9aa6b6;padding:0;text-align:center}#content .navbar:after{content:".";display:block;clear:both;visibility:hidden;height:0}#content .navbar-tabs{padding-bottom:4px}#content .navbar-tabs .nav-box{background:#c5ccd7}#content .uim .navbar .nav-box span, #content .uim-featured div.navbar-tabs .nav-box span, #content .uim .navbar .nav-back span, body #content .uim-featured .navbar-first .nav-back span, #content .uim .uim .navbar .nav-back span, body #content .uim .navbar-tabs .back span, #bp-doc .list .navbar-tabs .nav-box span, #bp-doc .collection .navbar-first .nav-box span, #bp-doc .collection .navbar-tabs-first .nav-back .back span{color:#405288}#content .uim .navbar, #content .uim .navbar-first{background:#f4f5f6}#content .uim .navbar-tabs .nav-box{background:#fff;border:1px solid #dfdfdf;border-top:0}#content .uim-featured .navbar{background:#97acc6}#content .navbar .nav-box span, #content .navbar .nav-back .back span, #content .uim-featured .navbar .nav-box span, #content .uim-featured .navbar .nav-back span, #content .uim-featured .uim .navbar .nav-back span, body #content .navbar-tabs-first span, body #content .uim-featured .navbar-tabs .back span{color:#fff}#content .uim-featured .navbar-tabs .nav-box{background:#eff2fd;border:1px solid #7991a7;border-top:0}#content .navbar-tabs-first{padding:4px 0 0 0;margin-bottom:4px}#content .uim .navbar-tabs-first, #bp-doc .list .navbar-tabs-first{margin-bottom:0}#bp-doc .list .navbar-first{background:#a2acc2 url(http://l.yimg.com/jg/api/res/1.2/fnX7rTlV4mrdyEV4RwdszA--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/nav_bkg_top) left bottom repeat-x}#bp-doc .collection .navbar-first{border-bottom:1px solid #7991a7}#content .uim .navbar-first{background:#f4f5f6}#bp-doc .collection .uim .navbar-first{border-bottom:1px solid #dfdfdf;background:#f4f5f6}#bp-doc .collection .uim .navbar-tabs-first .nav-box{background:#fff}#bp-doc .list .navbar-tabs-first + .uim, #bp-doc .collection .uim .navbar-tabs-first + .uim{border-top:0}#content .navbar .nav-box, #content .navbar .nav-back{margin-top:-1px;padding:6px 12px}#content .navbar .nav-back, #content .navbar .disabled{margin-top:0}#content .navbar .nav-left, #content .uim .navbar .nav-left, #content .navbar .nav-back{display:block;float:left;text-align:left;padding-left:8px;border-left:0;border-top:0}#content .navbar .nav-right, #content .uim .navbar div.nav-right{float:right;text-align:right;border-right:0}#content .navbar .nav-right .prev{border-right:1px solid #dfdfdf;margin-right:6px;padding-right:6px}#content .uim-featured .navbar .nav-right .prev{border-right:1px solid #7991a7}#bp-doc .list .navbar-tabs-first .nav-box{border:none}#content .navbar-tabs-first .nav-box, #content .uim .navbar-tabs-first .nav-box{margin:0 0 -1px;border:1px solid #7991a7;border-bottom:0}#content .navbar-tabs-first .nav-right .prev{border-color:#7991a7}#content .navbar-tabs-first .nav-right{border-right:0}#content .navbar-tabs-first .nav-left, #content .navbar-tabs-first .nav-back{border-left:0 !important}#content .uim .navbar-tabs-first .nav-box{border-color:#dfdfdf}#content .uim .groupCompact div + .navbar-tabs{border-top:1px solid #dfdfdf}#content div.uim-featured .groupCompact div + .navbar-tabs{border-top:1px solid #7991a7}#toolbar table.header-nav{width:100%;height:20px}#toolbar table.header-nav td{padding:5px 0 4px}#toolbar table.header-nav td.back{width:30%;white-space:nowrap;padding-left:6px}#toolbar table.header-nav td.back span{background:transparent url(http://l.yimg.com/jg/api/res/1.2/FgSI9fMmrIML1ecIH65DnQ--//resource:/brand/yahoo/web/1.0.61/image/ANew/ui/base/page_nav_back_arrow_outline) left top no-repeat;display:inline-block;height:20px;width:12px;overflow:hidden;vertical-align:middle}#toolbar table.header-nav td.back a{border:1px solid #b8babf;border-left:0;padding:1px 6px 0 0;height:17px;display:inline-block;min-width:20px;vertical-align:middle;text-align:center;overflow:hidden;text-overflow:ellipsis;-o-text-overflow:ellipsis;line-height:1.4em;color:#313131;font-size:77%;font-weight:bold}#toolbar table.header-nav td.back a.empty{width:auto;padding-right:4px}#toolbar table.header-nav td.page-title{text-align:center;font-size:105%;font-weight:bold;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis;width:40%;color:#3d5465}#toolbar table.hn-min td.page-title{white-space:normal;overflow:visible}#toolbar table.header-nav td.nav{width:30%;padding-right:6px;text-align:right}#toolbar table.header-nav td.nav span{border:1px solid #b8babf;margin:0;display:inline-block;line-height:0}#toolbar table.header-nav td.nav span img{padding:8px}#toolbar table.header-nav td.nav span.last{border-left:0}#toolbar table.header-nav td.buttons span{line-height:inherit;padding:2px 4px;margin-bottom:1px;color:#313131;font-size:85%;font-weight:bold}#toolbar table.header-nav td.buttons span a{display:inline-block;width:100%;white-space:nowrap;overflow:hidden;vertical-align:bottom}#toolbar table.header-nav td.buttons span.last{border-left:1px solid #b8babf;margin-left:4px}#toolbar table.header-nav td.buttons span.disabled{display:none}.navbar .prev, .navbar .next, .navbar .back, .pageNav .prev, .pageNav .next{font-size:85%;font-weight:bold;white-space:nowrap}#content .navbar *, #content .pageNav *{vertical-align:inherit}.navbar .nav-back .back img, .navbar .nav-box .prev img, .pageNav .prev img{padding-right:4px}.navbar .nav-box .next img, .pageNav .next img{padding-left:4px}#content .more a span{margin-right:2px}#content .more a{color:#405288}#content .uim-featured .more a{color:#fff}#content .pageNav .disabled span, #content .navbar .disabled span{color:#bcc5cc !important}.uim .pageNav .disabled, .uim .navbar .disabled{color:#bcc5cc}.navbar span.label{padding:8px 3px}.uim a.inline{color:#006ec2}.uim-featured a.inline{color:#006ec2}#pageFooter{clear:both;padding:0.8em 0 1em 0;border-top:1px solid #b4bac5;background-color:#c5ccd7}.collection #pageFooter{margin-top:5px}#pageFooter div#defaultFooter{margin-bottom:0;border:none;text-align:center;line-height:1.2em;font-size:85%}div#defaultFooter div.bd{background:transparent;border:none;min-height:0}div#defaultFooter div.uic{margin:0;padding:0;border:none;color:#000}div#defaultFooter div.uic span{font-weight:bold}div.username a, div.links a{margin:0 4px}div#defaultFooter a{font-weight:bold;color:#006ec2}div#footer div.subtext{font-size:85%;color:#a4a3a4}#pageFooter #brandFooter{background-color:#f2f2f2;color:#000;border:none;text-align:left}#pageFooter #brandFooter a, #pageFooter #brandFooter a.inline{color:inherit}#pageFooter #brandFooter .title{color:#000}#pageFooter #brandFooter .subdued{color:#7c7c7d}#pageFooter #brandFooter .subtext{color:#a4a3a4}#pageFooter #brandFooter .positive{color:#056005}#pageFooter #brandFooter .negative{color:#b30200}#pageFooter #brandFooter .important{color:#b30200;font-weight:bold}#pageFooter #brandFooter .link{color:#006ec2}#pageFooter #brandFooter .url{color:#398f08}
</style>
<script type="text/javascript">var Bp={};Bp.get=function(a){if(typeof(a)=="object"){return a}return document.getElementById(a)};Bp.queryAll=function(b){var a=document.body;if(arguments.length>1){a=Bp.get(arguments[1])}return a.querySelectorAll(b)};Bp.on=function(f,e,d){f=Bp.get(f);var c=this;if(arguments.length>3){c=arguments[3]}var b=false;if(Bp.env.Webkit&&typeof(window.ontouchstart)==="undefined"){switch(e){case"touchstart":e="mousedown";b=true;break;case"touchmove":e="mousemove";b=true;break;case"touchend":e="mouseup"}}var a=function(g){var g=g||window.event;if(!g.target&&g.srcElement){g.target=g.srcElement}if(b&&!g.touches){g.touches=[g]}d.call(c,g)};if(typeof(f.addEventListener)!="undefined"){f.addEventListener(e,a,false)}else{if(f.attachEvent){f.attachEvent("on"+e,a)}else{f["on"+e]=a}}};Bp.preventDefault=function(a){if(a.preventDefault){a.preventDefault()}else{a.returnValue=false}};Bp.stopPropagation=function(a){if(a.stopPropagation){a.stopPropagation()}else{a.cancelBubble=true}};Bp.simulateClick=function(b){var a=document.createEvent("MouseEvents");a.initMouseEvent("click",true,true,window,0,0,0,0,0,false,false,false,false,0,null);b.dispatchEvent(a)};Bp.dom={addClass:function(b,a){b=Bp.get(b);if(!b.className.match(a)){if(b.className!=""){a=" "+a}b.className+=a}},removeClass:function(b,a){b=Bp.get(b);b.className=b.className.replace(a,"").replace(/^\s+|\s+$/g,"")},hasClass:function(b,a){b=Bp.get(b);return b.className.match(new RegExp("(?:^|\\s+)"+a+"(?:\\s+|$)"))!==null},getXY:function(a){a=Bp.get(a);var c=0,b=0;if(a.offsetParent){do{c+=a.offsetLeft;b+=a.offsetTop}while(a=a.offsetParent)}return[c,b]},getStyle:function(b,a){b=Bp.get(b);return window.getComputedStyle?document.defaultView.getComputedStyle(b,null).getPropertyValue(a):(b.currentStyle?b.currentStyle[a]:b.style[a])},insertAfter:function(b,a){a=Bp.get(a);a.parentNode.insertBefore(b,a.nextSibling)}};Bp.env=(function(){var a={};a.RIM=RegExp("BlackBerry").test(navigator.userAgent);a.IE=RegExp("MSIE ").test(navigator.userAgent);a.OperaMobile=RegExp("Opera Mobi").test(navigator.userAgent);a.Webkit=RegExp(" AppleWebKit/").test(navigator.userAgent);a.Apple=RegExp("iPhone").test(navigator.userAgent);a.iPhone3=RegExp("iPhone OS 3").test(navigator.userAgent);a.iPhone4=RegExp("iPhone OS 4").test(navigator.userAgent);a.Android=RegExp("Android").test(navigator.userAgent);a.Android2=RegExp("Android 2").test(navigator.userAgent);a.WebOS=RegExp("webOS").test(navigator.userAgent);return a})();Bp.defaultFocus=false;;
</script>
</head>
<body class="collection" id="bp-bd">
<div id="page">
  <div id="pageHeader">
    <div id="pageBranding">
      <div id="titlebar">
        <div class="logoAndTitle">
          <div id="uiCommands">
            <span class="uiCommand">
             <a href="">Welcome <?php echo $first_name; ?></a><a href="home.php">Home</a>
            </span>
          </div>
          <span class="icon">
            <a href="home.php"> <img src="bstm.png"/> </a>
          </span>
        </div>
      </div>
 
      <div id="pageTabs">
        <table>
        <tr>
           <td class="pageTab first<?php if ($tab == 1) echo " ptactive"; ?> "><a class="inline" href="home.php?tab=1" id="tab-markets"><span>Coupons</span></a> <a href="coupon.php?action=display_create_form&redirect_url=home.php&user_id=55">(+)</a></td>
           <td class="pageTab<?php if ($tab == 2) echo " ptactive"; ?> "><a class="inline" href="home.php?tab=2" id="tab-quotes" x-bp-load-page="true"><span>Sales</span></a></td>
           <td class="pageTab last<?php if ($tab == 3) echo " ptactive"; ?> "><a class="inline" href="home.php?tab=3" id="tab-techtickers" x-bp-load-page="true"><span>Shopping List</span></a> <a href="shopping_list.php?action=display_create_form&redirect_url=home.php%3Ftab=3&user_id=55">(+)</a></td></tr></table>
      </div>
    </div>

    <div id="toolbar"><form action="home.php?action=search<?php echo "&tab=" . $tab . "&subtab=" . $subtab; ?>" method="post" id="search-box-model">
       <div class="formField searchBox">
         <table>
         <tr>
           <td class="input"><input type="text" name="userString" id="input-9" placeholder="Enter a store or product name"/></td>
           <td class="submit"><input type="submit" class="submit" value="Save"/></td>
         </tr>
         </table>
       </div></form>
     </div>
  </div> <!- Page Header ->

<div id="content"><div class="uim bdr first"><div class="bd">
<?php

  echo "<div class=\"tabs first\" id=\"tabs-19\"><table class=\"tabLinks\"><tr><td class=\"tabLink first"; if ($subtab == 1) echo " active"; echo "\" id=\"US-tab-button\"><a class=\"inline\" href=\"home.php?tab=" . $tab. "&subtab=1\" id=\"tab-US\"><span>Food</span></a></td><td class=\"tabLink "; if ($subtab == 2) echo " active"; echo"\" id=\"EUROPE-tab-button\"><a class=\"inline\" href=\"home.php?tab=" . $tab . "&subtab=2\" id=\"tab-EUROPE\"><span>Clothes</span></a></td><td class=\"tabLink last"; if ($subtab == 3) echo " active"; echo "\" id=\"ASIA-tab-button\"><a class=\"inline\" href=\"home.php?tab=" . $tab . "&subtab=3\" id=\"tab-ASIA\"><span>Electronics</span></a></td></tr></table>
<div class=\"tabContents\">\n";
?>

<?php
echo "<div class=\"tabSection"; if ($subtab == 1) echo " tabSectionShown"; echo "\">\n";
?>
<div class="group first">

<?php 

/*
  require('configure.php');
  require('database.php');
  require('functions.php');
echo $_SERVER["HTTP_HOST"];
echo $_POST['userString'];
echo "User ID = " .  $user_id;
*/
  getContent($tab, $subtab);

?>
  </div> <!- keep this here...puts a proper break between sections -->

</div> <!- group first -->

<?php
echo "<div class=\"tabSection"; if ($subtab == 2) echo " tabSectionShown"; echo "\">\n";
?>

<div class="group first last">

<?php getContent($tab, $subtab); ?>

</div> <!-- group first last ->
</div> <!-- tab Section ->

<?php
echo "<div class=\"tabSection"; if ($subtab == 3) echo " tabSectionShown"; echo "\">\n";
?>
<div class="group first last">

<?php getContent($tab, $subtab); ?>

</div> <!-- group first last ->
</div> <!-- tabSection ->

</div> <!-- tabContents ->

</div></div></div>

<div class="uim">

<div class="hd first">
  <table class="items">
  <tr>
    <td class="blocks">
      <div class="uic first">MORE COUPONS </div>
    </td>
  </tr>
  </table>
</div>

<div class="bd">
  <div class="uip first">
    <table class="template" onclick="location.href='/w/yfinance/article/?guid=%2Fap%2F20100326%2Fap_on_bi_ge%2Fus_mortgage_aid&amp;backlink=widget%3Ayfinance%2F&amp;.tsrc=apple&amp;.ysid=P_e8ggqganENinqBdNBoFQ--&amp;.intl=US&amp;.lang=en'">
    <tr>
      <td class="right">
      <table class="template">
      <tr>
        <td class="title-cell">
          <div class="uic title article article-title first">New Entertainment Book due out in November</div>
        </td>
      </tr>
      </table>
      </td>
    </tr>

    <tr>
      <td class="description-cell" colspan="2">
        <div class="uic small first"> 
          <span class="subdued"> Fri Oct 26th, 2010 6:27 PM EDT - 
          </span> Be the first to start saving
        </div>
      </td>
    </tr>
    </table>
  </div>

  <div class="uip">
    <table class="items">
    <tr>
      <td class="blocks" onclick="location.href='articles.php';">
        <div class="uic title article article-title first">
          <a href="articles.php">Giant saving customers more money in Northern Virginia</a>
        </div>
        <div class="uic subdued small last">
          <a href="article.php">2 hrs, 59 mins ago</a>
        </div>
      </td>
    </tr>
    </table>
  </div>

  <div class="navbar uic last navbar-last navbar-tabs navbar-tabs-last">
    <div class="nav-box nav-right">
      <a class="next" href="more_coupons.php"><span>More Coupons</span> <img src="nav_bar_right_arrow.png"/> </a>
    </div>
  </div>
</div>

</div>
  <div class="uic title last center"> 
    <span>View: Mobile | </span> 
    <a class="inline" href="desktop.php"> <span> Desktop </span> </a> 
  </div>
</div>

<div id="pageFooter">
  <div class="uim first last" id="defaultFooter">
    <div class="bd">
      <div class="uic small first"> 
        <a class="inline" href="set_my_location.php"> <span><?php if (empty($_COOKIE['current_location'])) echo "Set My Location"; else echo "Current Location: " . $_COOKIE['current_location']; ?> </span> </a> 
      </div>
<?php
      if (!empty($user_id))
      
         echo "<div class=\"uic small\"> 
            <a class=\"inline\" href=\"settings.php\"> <span>Settings </span> </a> 
          </div>";
?>
      <div class="uic small"> 
<?php
        if (tep_session_is_registered('user_id'))
           echo "<a class=\"inline\" href=\"logoff.php?redirect_url=index.php\"> <span>Log Off</span> </a>\n";
?>
        <span> | </span>
        <a class="inline" href="privacy.php"><span>Privacy</span></a> 
        <span> | </span> 
        <a class="inline" href="legal.php"><span>Legal </span></a> 
      </div>
      <div class="uic small last"> © 2010 Bring Savings To Me! - All rights reserved </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">Bp.Script = Bp.Script || {};(function(){Bp.get_script=function(){var a=arguments;return function(){for(var b=0;b<a.length;b++){a[b].call()}}}})();;(function(){Bp.EvHistory=Bp.EvHistory||{};Bp.assign_script=function(g,e,j,i,c){var f=Bp.get(g);if(typeof e!=="function"&&typeof j!=="function"&&typeof i!=="function"){return}var h=function(k){Bp.preventDefault(k);if(!c){Bp.stopPropagation(k)}if(typeof Bp.EvHistory[g]==="undefined"){if(typeof j==="function"){j.call()}Bp.EvHistory[g]="ac"}else{if(typeof i==="function"){i.call()}}if(typeof e==="function"){e.call()}};if(f){if(f.tagName=="DIV"&&f.className=="formField trigger"){var d=f.parentNode;while(d.tagName!="FORM"&&d.parentNode){d=d.parentNode}var b=d.getAttribute("action");var a=d.getAttribute("method");Bp.on(d,"submit",h)}else{if(f.tagName=="A"||f.tagName=="TD"||f.tagName=="TR"||f.tagName=="DIV"){if(f.tagName=="A"&&f.parentNode.tagName=="BUTTON"){Bp.on(f.parentNode,"click",h)}else{Bp.on(f,"click",h)}if(Bp.env.Apple&&f.tagName=="A"){f.removeAttribute("href")}}}}}})();;(function(){Bp.Timers=Bp.Timers||{};Bp.TimersNN=Bp.TimersNN||[];Bp.Timer=function(d,a,b,c){if(d){Bp.Timers[d]=this}else{Bp.TimersNN.push(this)}this._acts=b;this._inter=a*1000;if(c){this.startTimer()}};Bp.Timer.prototype={startTimer:function(){if(!this._active){this._uid=setInterval(this._acts,this._inter)}this._active=true},stopTimer:function(){if(this._active){clearInterval(this._uid)}this._active=false;this._enbl=false}}})();;Bp.PageTabs=function(b){this._tabs=Bp.get(b);Bp.on(this._tabs,"click",this._handleChange,this);(new Image()).src="http://l.yimg.com/a/i/w/go/web/spinner-1.0.0.gif";if(typeof(Bp.TabsSettings)!=="undefined"&&Bp.TabsSettings._sendTabs.length>0){for(var a=0;a
<Bp.TabsSettings._sendTabs.length;a++){if(Bp.TabsSettings._sendTabs[a].event=="first-activate"){var c=Bp.get("case-"+Bp.TabsSettings._sendTabs[a].id.substring(0,Bp.TabsSettings._sendTabs[a].id.length-4));c.firstChild.innerHTML="<div class='loading-spinner'>
<img src='http://l.yimg.com/a/i/w/go/web/spinner-1.0.0.gif' alt='' /></div>"}}}};Bp.PageTabs.prototype={_tabs:null,_handleChange:function(d){if(d.target.tagName!="A"&&d.target.tagName!="SPAN"){return}var c=d.target;while(c.tagName!="TD"&&c.parentNode){c=c.parentNode}if(Bp.dom.hasClass(c,"pageTab")&&!Bp.dom.hasClass(c,"ptactive")){var b=c.parentNode.getElementsByTagName("td");for(var a=0;a<b.length;a++){if(c==b[a]){Bp.dom.addClass(b[a],"ptactive")}else{Bp.dom.removeClass(b[a],"ptactive")}}}else{if(Bp.dom.hasClass(c,"tabLink")&&!Bp.dom.hasClass(c,"active")){var b=c.parentNode.getElementsByTagName("td");for(var a=0;a<b.length;a++){if(c==b[a]){Bp.dom.addClass(b[a],"active")}else{Bp.dom.removeClass(b[a],"active")}}}}}};;new Bp.PageTabs( 'pageTabs' );Bp.DefaultInput=function(a){this._el=Bp.get(a);if(arguments.length>1){this._dt=arguments[1]}else{this._dt=this._el.getAttribute("placeholder")}this._blur();Bp.on(this._el,"blur",this._blur,this);Bp.on(this._el,"focus",this._focus,this);var c=this._el.parentNode;while(c.tagName!="FORM"&&c.parentNode){c=c.parentNode}var b=Bp.DefaultInputForm.GetInstance(c);b.addInput(this)};Bp.DefaultInput.prototype={_el:null,_dt:null,_dClass:"disabled",_blur:function(){if(this._el.value==""||this.isDefault()){this._el.value=this._dt;Bp.dom.addClass(this._el,this._dClass)}},_focus:function(){if(this._el.value==""||this.isDefault()){this.blank();Bp.dom.removeClass(this._el,this._dClass)}},isDefault:function(){return this._el.value==this._dt},blank:function(){this._el.value=""}};Bp.DefaultInputForm=function(a){this._formEl=a;this._defaultInputs=[];Bp.on(this._formEl,"submit",this._onSubmit,this);this._formEl.defaultInputForm=this};Bp.DefaultInputForm.prototype={_defaultInputs:null,_formEl:null,_onSubmit:function(b){if(this._defaultInputs.length==0){return}for(var a=0;a<this._defaultInputs.length;a++){if(this._defaultInputs[a].isDefault()){this._defaultInputs[a].blank()}}},addInput:function(a){if(typeof(a)=="object"){this._defaultInputs.push(a)}}};Bp.DefaultInputForm.GetInstance=function(a){a=Bp.get(a);if(typeof(a.defaultInputForm)!="undefined"){return a.defaultInputForm}return new Bp.DefaultInputForm(a)};;new Bp.DefaultInput( 'input-9' );Bp.Tabs=function(b){this._container=Bp.get(b.id);this._id=b.id;var d=this._container.firstChild.getElementsByTagName("td");this._tabs=[];this._tabContents=[];for(var a=0;a<d.length;a++){if(!d[a].id){continue}var c=d[a].id.split("-");this._tabs.push(d[a]);this._tabContents.push(Bp.get(c.slice(0,c.length-2).join("-")+"-tab-content-"+this._id))}Bp.on(this._container.firstChild,"click",this._tabChange,this)};Bp.Tabs.prototype={_id:"",_container:null,_tabs:null,_tabContents:null,_tabChange:function(g){var b=g.target;while(b.parentNode&&b.tagName!="TD"){b=b.parentNode}var f=b.getElementsByTagName("a");if(f&&f[0].getAttribute("x-bp-load-page")=="true"){return}Bp.preventDefault(g);var h=this._container.firstChild.getElementsByTagName("td"),a=0;for(var c=0;c<h.length;c++){if(!Bp.dom.hasClass(h[c],"tabLink")){continue}if(h[c]==b){a=c;Bp.dom.addClass(h[c],"active")}else{Bp.dom.removeClass(h[c],"active")}}var d=this._container.lastChild.firstChild,c=0;while(d){if(c==a){Bp.dom.addClass(d,"tabSectionShown")}else{Bp.dom.removeClass(d,"tabSectionShown")}c++;d=d.nextSibling}}};;new Bp.Tabs({ id: 'tabs-19' });</script></body></html>
