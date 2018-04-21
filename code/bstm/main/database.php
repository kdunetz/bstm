<?php
/*
  $Id: database.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;
    global $mysqli;

$server = "bstmDatabase.db.4598445.hostedresource.com";
$username = "bstmDatabase";
$password = "Cc112233!";
$database = "bstmDatabase";
$mysqli = new mysqli($server . ":3306", $username, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;
/*
    if (USE_PCONNECT == 'true') {
      $$link = @mysql_pconnect($server . ":3306", $username, $password) or tep_db_fatal_error($query, $errno, $error);
    } else {
      $$link = @mysql_connect($server . ":3306", $username, $password) or tep_db_fatal_error($query, $errno, $error);
    }

    if ($$link) mysql_select_db($database);

    return $$link;
*/
  }

  function tep_db_close($link = 'db_link') {
    global $$link;
    global $mysqli;

    return mysql_close($$link);
  }

  function tep_db_error($query, $errno, $error) { 
    $errorMessage = file_get_contents("regularDatabaseError.html");
    if ($user_id != 1 && $user_id != 0)
       die($errorMessage);
    else
       die('<center><font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000"></font></small><br><br></b></font>');
  }

  function tep_db_fatal_error($query, $errno, $error) { 
    $errorMessage = file_get_contents("databaseError.html");
    if ($user_id != 1 && $user_id != 0)
       die($errorMessage);
    else
      die('<center><font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000"></font></small><br><br></b></font>');
  }

  function tep_db_query($query, $link = 'db_link') {
    global $mysqli;
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = $mysqli->query($query);
    //$result = mysql_query($query, $$link) or tep_db_error($query, mysql_errno(), mysql_error());

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       $result_error = mysql_error();
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
  }

  function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') {
    reset($data);
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }
//echo $query;
    return tep_db_query($query, $link);
  }

  function tep_db_fetch_array($db_query) {
    //return mysql_fetch_array($db_query, MYSQL_ASSOC);
    return $db_query->fetch_assoc();
  }

  function tep_db_num_rows($db_query) {
    //return mysql_num_rows($db_query);
    return $db_query->num_rows;
  }

  function tep_db_data_seek($db_query, $row_number) {
    return mysql_data_seek($db_query, $row_number);
  }

  function tep_db_insert_id($link = 'db_link') {
    global $$link;
    global $mysqli;

    return $mysqli->insert_id;
    //return mysql_insert_id($$link);
  }

  function tep_db_free_result($db_query) {
    return mysql_free_result($db_query);
  }

  function tep_db_fetch_fields($db_query) {
    return mysql_fetch_field($db_query);
  }

  function tep_db_output($string) {
    return htmlspecialchars($string);
  }

  function tep_db_input($string, $link = 'db_link') {
    global $$link;
    return $string; /* KAD put this in there because the / was being put into the string */

    if (function_exists('mysql_real_escape_string')) {
      return mysql_real_escape_string($string, $$link);
    } elseif (function_exists('mysql_escape_string')) {
      return mysql_escape_string($string);
    }

    return addslashes($string);
  }

  function tep_db_prepare_input($string) {
    if (is_string($string)) {
      return trim(tep_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = tep_db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }
?>
