<?php
global $user_zone_id, $user_id, $user_name, $current_location, $first_name, $role, $zipcode;

  function cs($var, $default) {
    if (is_null($var))
       return $default;
    else
       return trim($var);
  }

  function sqlToUserDate($date) {
     if (strlen($date) == 0) return "";

     $var = substr($date,5,2) . "/" . substr($date,8,2) . "/" . substr($date,0,4);

     if ($var == '00/00/0000') $var = '';

     if (strlen($var) > 3)
        return $var;

     return "";
  }

/* 10/24/1967 */
  function usertoSQLDate($date) {

     if (stripos($date, "/") == false) return "";

     $month = strtok($date, "/");
     $day = strtok("/");
     $year = strtok("/");
     
     return $year . "-" . $month . "-" . $day;
  }

  function displayField($str,$fieldType,$fieldFormat) {
     if ($fieldType == 'DATETIME') return sqlToUserDate($str);
     if (isset($fieldFormat)) 
     {
        if (stripos($fieldFormat, ".") != false)
        {
           $position = stripos($fieldFormat, ".");
           echo substr($str,$position + 1);
           $str = number_format($str,2);
        }

        if (substr($fieldFormat,0,1) == '$')
          $str = "$" . $str;
     }
     return $str;
  }

  function print_coupon_details($coupon) {
     echo sqlToUserDate($coupon['end_date']);
  }

  function getContent($tab, $subtab, $user_id)
  {
     //global $user_id;
     if ($tab == 1 || $tab == 3)
     {
        if ($subtab == 1) 
        {
           $filter = " AND (product_type = 'Food' OR product_type is null)";
        }
        if ($subtab == 2) 
        {
           $filter = " AND product_type = 'Clothes'";
        }
        if ($subtab == 3) 
        {
           $filter = " AND product_type = 'Electronics'";
        }
     }
     if ($tab == 1)  
     {
        if (isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           if (isset($_POST['userString'])) 
           {
              $filter .= " AND (coupon_name LIKE '%" . $_POST['userString'] . "%' OR product_name LIKE '%" . $_POST['userString'] . "%')";
      /* echo $filter; */
           }
        }
        $id = $_GET['id'];
      
        tep_db_connect();
        /* $objects_query = tep_db_query("select * from coupon, product WHERE coupon.product_id = product.product_id AND product_type = 'Food'"  . $filter); */
         $objects_query = tep_db_query("select * from coupon, product WHERE coupon.product_id = product.product_id AND end_date >= now()"  . $filter . " ORDER BY end_date"); 
        $rows = 0;
        while ($objects = tep_db_fetch_array($objects_query)) 
        {
           $rows++;
      
           $packaging_size = $objects['packaging_size'];
           $packaging_size = str_replace(".0000", "", $packaging_size);
           $variable = $objects['packaging_quantity'] . " ". $packaging_size . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  
      
           if ($objects['packaging_quantity'] != "" && $objects['packaging_quantity'] != 1) $variable .= "s";
      
           /* clean up bad data before it is displayed */
           if (str_replace(" ", "", $variable) == "00s") $variable = "";
      
           echo "<div class=\"uip"; if ($rows == 1) echo " first"; if ($rows == sizeof($objects)) echo " last"; echo "\"><table class=\"template single two-column\" onclick=\"location.href='home.php?action=detail&id=" . $objects['coupon_id'] . "'\"><tr><td class=\"icon\" width=\"24\"><span class=\"title\">" . $rows . ")</span></td><td class=\"right\">
           
           <table class=\"template\"><tr><td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $objects['product_name'] . "</span><br/> 
           <span class=\"small\">" . $variable;  echo "</span> </div></td>
           <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>Save $" . $objects['discount'] . "</strong></span><br/> <span class=\"positive\">Expires " . sqltoUserDate($objects['end_date']) . "</span> </div></td></tr></table></td></tr></table></div>";
           if ($id == $objects['coupon_id']) print_coupon_details($objects);
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>";
         //return;
        }
        if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           //return;
        }
     }
     if ($tab == 2)  
     {
        if (isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           if (isset($_POST['userString'])) 
           {
              $filter .= " AND (sale_name LIKE '%" . $_POST['userString'] . "%' OR store_name LIKE '%" . $_POST['userString'] . "%')";
      /* echo $filter; */
           }
        }
        $filter .= " AND (store.zone_id = " . $user_zone_id . " OR store.zone_id = 54)";
      
        $objects_query = tep_db_query("select sale.*, store.store_name from sale, store WHERE sale.store_id = store.store_id AND end_date >= now()" . $filter . " ORDER BY end_date");
        $rows = 0;
        while ($objects = tep_db_fetch_array($objects_query)) 
        {
           $rows++;
      
           if ($objects['packaging_quantity'] != "" && $objects['packaging_quantity'] != 1) echo "s"; 
      
           echo "<div class=\"uip"; if ($rows == 1) echo " first"; if ($rows == sizeof($objects)) echo " last"; echo "\"><table class=\"template single two-column\" onclick=\"location.href=''\"><tr><td class=\"icon\" width=\"24\"><span class=\"title\">" . $rows . ")</span></td><td class=\"right\">
      
           <table class=\"template\"><tr><td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $objects['sale_name'] . "</span><br/> 
      <span class=\"small\">" . $objects['packaging_quantity'] ." ". $objects['packaging_size'] . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  if ($objects['packaging_quantity'] != "" && $objects['packaging_quantity'] != 1) echo "s";  echo "</span> </div></td>
      <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>Starts " . sqlToUserDate($objects['begin_date']) . "</strong></span><br/> <span class=\"positive\">Ends " . sqltoUserDate($objects['end_date']) . "</span> </div></td></tr></table></td></tr></table></div>";
        }
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>";
         //return;
        }
        if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           //return;
        }
     }
     if ($tab == 3)  
     {
        if (isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           if (isset($_POST['userString'])) 
           {
              $filter .= " AND (product_name LIKE '%" . $_POST['userString'] . "%' OR status LIKE '%" . $_POST['userString'] . "%')";
      /* echo $filter; */
           }
        }
        if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
        {
            tep_db_query("UPDATE shopping_list SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE shopping_list_id = " . $_GET['shopping_list_id']);
            if (isset($_POST['redirect_url']))
            {
                tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
            }
        }
#$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
        $objects_query = tep_db_query("select * from shopping_list, product, vendor WHERE product.vendor_id = vendor.vendor_id AND shopping_list.product_id = product.product_id AND shopping_list.user_id = " . $user_id . $filter . " ORDER BY status DESC");
        $rows = 0;
        while ($objects = tep_db_fetch_array($objects_query)) 
        {
           $rows++;
      
           $variable = $objects['packaging_quantity'] ." ". $objects['packaging_size'] . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  
      
           echo "<div class=\"uip"; if ($rows == 1) echo " first"; if ($rows == sizeof($objects)) echo " last"; echo "\">";
           echo "
           <table class=\"template single two-column\" onclick=\"location.href=''\">
           <tr>
             <td class=\"icon\" width=\"24\"><span class=\"title\">"; echo $rows; echo ")</span></td>
             <td class=\"right\">
             <table class=\"template\">
             <tr>
               <td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $objects['vendor_name'] . " " . $objects['product_name'] . "</span></div></td>
               <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>"; 

           if (!isset($objects['status']))  
              $objects['status'] = "Got"; 

           if ($objects['status'] == 'Need')
           {
              echo "<a href=shopping_list.php?action=update_field&tab=" . $tab . "&subtab=" . $subtab . "&field=status&value=Got&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">";
           }
           else
           {
              echo "<a href=shopping_list.php?action=update_field&tab=" . $tab . "&subtab=" . $subtab . "&field=status&value=Need&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">";
           }
           echo $objects['status']; 
           echo "</a></strong></span></div></td>
             </tr>
             </table>
             </td>
           </tr>
           </table></div> <!- uip ->";
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>";
         //return;
        }
        if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           //return;
        }
     }
  }

  function tableInserts($table,$userid,$zoneid,$zipcode) {
     $dropStatement = "DROP TABLE IF EXISTS " . $table . "\n";
     $createStatement = "CREATE VIRTUAL TABLE " . $table . " USING fts3 (";

     $sqlCommand = "SELECT * FROM " . $table;
     if (!empty($userid))
        $sqlCommand .= " WHERE user_id = " . $userid;
     if (!empty($zoneid))
        $sqlCommand .= " AND zone_id = " . $zoneid;
     if (!empty($zipcode))
        $sqlCommand .= " AND zipcode = " . $zipcode;
//     $sqlCommand .= " limit 0, 10";

     $objects_query = tep_db_query($sqlCommand);
     $rows = 0;
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;
     $keys = "";
     $values = "";
     $insertStatement = "INSERT INTO " . $table . "(";
     foreach($objects as $key=>$value) {
         //echo "$key: $value<br>";
         if ($key == 'limit') $key = "_limit";
         $keys .= strtoupper($key) . ",";
         $values .= "'" . str_replace("'","''",$value) . "',";
     }
     $insertStatement .= substr($keys,0,strlen($keys)-1) . ") VALUES (" . substr($values,0,strlen($values) - 1);
     $insertStatement .= ")\n"; 
     $createStatement .= substr($keys,0,strlen($keys)-1) . ")\n";
     if ($rows == 1)
     {
         echo $dropStatement;
         echo $createStatement;
     }
     echo $insertStatement;
   }
  }

?>
