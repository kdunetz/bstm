<?php
  define('TABLE_SESSIONS', 'sessions');
  define('HTTP_SERVER', 'http://www.bringsavingstome.com');
  define('HTTPS_SERVER', 'http://www.bringsavingstome.com');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', ''); /* localhost KAD */
  define('HTTPS_COOKIE_DOMAIN', ''); /* localhost KAD */
  define('HTTP_COOKIE_PATH', '/'); //'/bstm/mobile/staging/');
  define('HTTPS_COOKIE_PATH', '/'); //'/bstm/mobile/staging/');
  define('DIR_WS_HTTP_CATALOG', '/bstm/mobile/staging/');
  define('DIR_WS_HTTPS_CATALOG', '/bstm/mobile/staging/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', '');
  define('DIR_WS_BOXES', '');
  define('DIR_WS_FUNCTIONS', '');
  define('DIR_WS_CLASSES', ''); 
  define('DIR_WS_MODULES', '');
  define('DIR_WS_LANGUAGES', '');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', '/Users/kevindunetz/Sites/coupons/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER', 'kdunetz.db.4598445.hostedresource.com');
  define('DB_SERVER_USERNAME', 'kdunetz');
  define('DB_SERVER_PASSWORD', 'Cc112233');
  define('DB_DATABASE', 'kdunetz');
  //define('DB_SERVER', 'josbstm.db.4598445.hostedresource.com');
  //define('DB_SERVER_USERNAME', 'josbstm');
  //define('DB_SERVER_PASSWORD', 'Cc112233');
  //define('DB_DATABASE', 'josbstm');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
//$mobilesite = "true";
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);
?>
