<?php
global $user_zone_id, $user_id, $user_name, $current_location, $first_name, $hfPrefix, $zipcode, $location_filter, $email;

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

  function getContent($tab, $subtab)
  {
     global $user_id;
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

        echo "<P><center><h3><FONT color=blue>Savings Dashboard</font></h3></center><p>\n";

        echo "<h4><FONT color=red>Coupons Expiring Soon<font></h4>\n";
        /* $objects_query = tep_db_query("select * from coupon, product WHERE coupon.product_id = product.product_id AND product_type = 'Food'"  . $filter); */
         //$objects_query = tep_db_query("select * from coupon, product WHERE coupon.product_id = product.product_id AND end_date >= now()"  . $filter . " ORDER BY end_date"); 
         $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product, vendor WHERE coupon.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 AND (user_id = " . $user_id . " OR user_id IS NULL OR user_id = 0) ORDER BY end_date");
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
           if ($objects['vendor_name'] == 'Any' && $objects['product_name'] == 'Any')
           {
              $objects['vendor_name'] = '';
              $objects['product_name'] = '';
           }

           displayResultRow("coupon", $objects['coupon_id'], $rows, $rows == 1, $row == sizeof($objects), $objects['coupon_name'] . " " . $objects['vendor_name'] . " ". $objects['product_name'], $variable,  "Save $" . $objects['discount'], "Expires " . sqlToUserDate($objects['end_date']));  
           if ($id == $objects['coupon_id']) print_coupon_details($objects);
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>\n";
         //return;
        }
        if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           //return;
        }

        echo "<p>\n";
        echo "<h4><font color=red>Sales Ending Soon</font></h4>\n";
        //$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from sale, sale_line_item, shopping_list, product, vendor WHERE sale_line_item.product_id = shopping_list.product_id AND sale_line_item.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND sale.sale_id = sale_line_item.sale_id AND datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 ORDER BY end_date"); KAD before Feb 10, 2011
        $objects_query = tep_db_query("select store.store_name, sale.*, sale_line_item.*, product.product_name, datediff(end_date,curdate()) days_left from store, sale, sale_line_item, shopping_list, product, vendor, my_stores WHERE store.store_id = sale.store_id AND my_stores.store_id = sale.store_id AND my_stores.user_id = " . $user_id . " AND shopping_list.user_id = " . $user_id . " AND sale_line_item.product_id = shopping_list.product_id AND sale_line_item.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND sale.sale_id = sale_line_item.sale_id AND datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 ORDER BY end_date");
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

           displayResultRow("sale_line_item", $objects['sale_line_item_id'], $rows, $rows == 1, $row == sizeof($objects), $objects['sale_line_item_name'] . " at " . $objects['store_name'] . " for " . displayField($objects['price'],"NUMBER","$###,###.00") . "/" . $objects['price_units'] , $variable,  "Starts " . sqlToUserDate($objects['begin_date']), "Ends " . sqlToUserDate($objects['end_date']));  
           //if ($id == $objects['coupon_id']) print_coupon_details($objects);
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>\n";
         //return;
        }

if (false) /* KAD moved to blog section of screen */
{
        echo "<p>";
        echo "<h4><font color=green>Deals Expiring Soon</font></h4>";
        $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from deal WHERE NOW() <= end_date AND begin_date <= NOW() ORDER BY end_date");
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

           displayResultRow("deal", $objects['deal_id'], $rows, $rows == 1, $row == sizeof($objects), $objects['deal_name'], $variable,  "Starts " . sqlToUserDate($objects['begin_date']), "Ends " . sqlToUserDate($objects['end_date']));  
           //if ($id == $objects['coupon_id']) print_coupon_details($objects);
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>\n";
         //return;
        }
}
     }
     if ($tab == 2)  
     {
if (false)
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
      <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>Starts " . sqlToUserDate($objects['begin_date']) . "</strong></span><br/> <span class=\"positive\">Ends " . sqltoUserDate($objects['end_date']) . "</span> </div></td></tr></table></td></tr></table></div>\n";
        }
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>\n";
         //return;
        }
        if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
        {
           //return;
        }
}
$originalAction = $_GET['action'];
$_GET['action'] = 'display_list';
include "../../common/my_coupons.php";
$_GET['action'] = $originalAction;
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
        $_GET['product_type'] = 'Food';
        $filter = "";
        if (isset($_GET['product_type']))
           $filter = " AND product.product_type = '" . $_GET['product_type'] . "' ";
echo $user_id;
echo $filter;
        $objects_query = tep_db_query("SELECT shopping_list_id as id, shopping_list.*, user.*, product.* FROM shopping_list, user, product WHERE shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.user_id = '" . $user_id . "'" . $filter . "ORDER BY status DESC, product_name");
        $objects_query = tep_db_query("select * from shopping_list, product, vendor WHERE product.vendor_id = vendor.vendor_id AND shopping_list.product_id = product.product_id AND shopping_list.user_id = " . $user_id . $filter . " ORDER BY status DESC");
        $rows = 0;
        while ($objects = tep_db_fetch_array($objects_query)) 
        {
           $rows++;
      
           $variable = $objects['packaging_quantity'] ." ". $objects['packaging_size'] . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  
      
           echo "<div class=\"uip"; if ($rows == 1) echo " first"; if ($rows == sizeof($objects)) echo " last"; echo "\">\n";
           echo "
           <table class=\"template single two-column\" onclick=\"location.href=''\">
           <tr>
             <td class=\"icon\" width=\"24\"><span class=\"title\">"; echo $rows; echo ")</span></td>
             <td class=\"right\">
             <table class=\"template\">
             <tr>
               <td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $objects['vendor_name'] . " " . $objects['product_name'] .  (strlen($objects['other_product_name']) > 0?" (" . $objects['other_product_name'] . ")":"" ) . "</span></div></td>
               <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>"; 

           if (!isset($objects['status']))  
              $objects['status'] = "Got"; 

           if ($objects['status'] == 'Need')
           {
              echo "<a href=index.php?action=update_field&tab=" . $tab . "&subtab=" . $subtab . "&field=status&value=Got&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">";
           }
           else
           {
              echo "<a href=index.php?action=update_field&tab=" . $tab . "&subtab=" . $subtab . "&field=status&value=Need&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">";
           }
           echo $objects['status']; 
           echo "</a></strong></span></div></td>
             </tr>
             </table>
             </td>
           </tr>
           </table></div> <!-- uip -->\n";
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>\n";
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

  function displayResultRow($objectName, $id, $row, $firstRow, $lastRow, $leftTop, $leftBottom, $rightTop, $rightBottom)
  {
           echo "<div class=\"uip"; if ($firstRow) echo " first"; if ($lastRow) echo " last"; echo "\">
        <table class=\"template single two-column\" onclick=\"location.href='index.php?view=" . $objectName . "&action=display&". $objectName . "_id=" . $id . "'\">
        <tr>
           <td class=\"icon\" width=\"24\"><span class=\"title\">" . $row . ")</span></td>
           <td class=\"right\">
      
           <table class=\"template\">
           <tr>
              <td align=left colspan=2><div class=\"uic small first\"> <span class=\"title\">" . $leftTop . "</span></div></td>
           </tr>
           <tr>
              <td align=left><div class=\"uic small first\"><font color=blue>" . $rightTop . "</div></td><td align=left><div class=\"uic small first\"><font color=blue>" . $rightBottom  . "</div></td>
           </tr>
           </table>
          
           </td>
         </tr>
         </table>
       </div>\n";
/* Original format before 2/1/2011
<span class=\"small\">" . $leftBottom . "</span> </div></td>
           <table class=\"template\">
           <tr>
              <td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $leftTop . "</span><br/> 
      <span class=\"small\">" . $leftBottom . "</span> </div></td>
              <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>" . $rightTop . "</strong></span><br/> <span class=\"positive\">" . $rightBottom  . "</span> </div></td>
           </tr>
           </table>
*/
  }
function displayBlogResultRow($objectName, $id, $rowNum, $firstRow, $lastRow, $title, $body, $datetime)
{
  echo "<div class=\"uip\">\n";// " . ($firstRow?"first":"") . "\">\n"; KAD took this out Feb 3rd, 2011 because the divider line wasn't showing when I wanted it to
  echo "  <table class=\"template\" onclick=\"location.href='index.php?view=" . $objectName . "&action=display&" . $objectName . "_id=" . $id . "'\">\n";
  echo "  <tr>\n";
  echo "    <td class=\"right\">\n";
  echo "    <table class=\"template\">\n";
  echo "    <tr>\n";
  echo "      <td class=\"title-cell\">\n";
  echo "        <div class=\"uic title article article-title first\">" . $title . "</div>\n";
  echo "      </td>\n";
  echo "    </tr>\n";
  echo "    </table>\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td class=\"description-cell\" colspan=\"2\">\n";
  echo "      <div class=\"uic small first\"> \n";
  echo "        <span class=\"subdued\">" . $datetime . "\n";
  echo "        </span>" . $body . "\n";
  echo "      </div>\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  </table>\n";
  echo "</div>\n";
}
function listRecentDeals()
{
   global $location_filter;
   $stopQuery = "";
   if (strlen($location_filter) == 0) $stopQuery = " AND 1 = 2";
   echo "<div class=\"bd\">\n";
        $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from deal WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0" . $stopQuery . " ORDER BY end_date");
        $rows = 0;
        while ($objects = tep_db_fetch_array($objects_query)) 
        {
      
           $packaging_size = $objects['packaging_size'];
           $packaging_size = str_replace(".0000", "", $packaging_size);
           $variable = $objects['packaging_quantity'] . " ". $packaging_size . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  
      
           if ($objects['packaging_quantity'] != "" && $objects['packaging_quantity'] != 1) $variable .= "s";
      
           /* clean up bad data before it is displayed */
           if (str_replace(" ", "", $variable) == "00s") $variable = "";

           $location = $objects['location'];
           if (strlen($location_filter) == 0 && isset($_COOKIE['current_location']))
               $location_filter = $_COOKIE['current_location'];

           if (strlen($location_filter) == 0 || strpos($location_filter, $location) !== false)
           {
              displayBlogResultRow("deal", $objects['deal_id'], $rows, $rows == 1, $row == sizeof($objects), $objects['deal_name'], $objects['comments'], $objects['creation_date']);
              $rows++;
           }
           //displayResultRow("deal", $objects['deal_id'], $rows, $rows == 1, $row == sizeof($objects), $objects['deal_name'], $variable,  "Starts " . sqlToUserDate($objects['begin_date']), "Ends " . sqlToUserDate($objects['end_date']));  
        }
      
        if ($rows == 0)
        {
           //echo "</div>";
           echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>\n";
         //return;
        }
if (false)
{
  echo "<div class=\"navbar uic last navbar-last navbar-tabs navbar-tabs-last\">\n";
  echo "  <div class=\"nav-box nav-right\">\n";
  echo "    <a class=\"next\" href=\"index.php?view=more_deals&action=display\"><span>More Deals</span> <img src=\"nav_bar_right_arrow.png\"/> </a>\n";
  echo "  </div>\n";
  echo "</div>\n";
}
echo "</div>\n";
}
function sqlQuery($query)
{
     $select_query = tep_db_query($query);
     $html = "<table border=1 class=\"contenttoc\" width=\"100%\">\n";
     while ($select = tep_db_fetch_array($select_query))
     {
        $row++;
        $data = $select;
        if ($row == 1)
        {
           $html .= "<tr>";
           while(list($key,$value) = each($data)) 
           {
               $html .= "<td class=\"sectiontableheader\" align=\"center\">" . $key . "</td>";
           }
           $html .= "</tr>\n";
        }
        $data = $select;
        $html .= "<tr>";
        while(list($key,$value) = each($data)) 
        {
           $html .= "<td class=\"bstm_td\">" . $value . "</td>";
        }
        $html .= "</tr>\n";
     }
     $html .= "</table>\n";
     return $html;
}

?>
