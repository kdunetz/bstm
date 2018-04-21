<?php
global $user_zone_id, $user_id, $user_name, $current_location, $first_name, $role, $zipcode, $totalSavings, $location_filter, $override_redirect;

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
        if (strpos($fieldFormat, ".") != false)
        {
           $position = strpos($fieldFormat, ".");
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
  function savingsDashboard($user_id)
  {
     global $totalSavings, $location_filter;
     $totalSavings = 0;
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product, vendor, shopping_list WHERE coupon.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND coupon.product_id = shopping_list.product_id AND product.product_name != 'Any' AND shopping_list.user_id = " . $user_id . " AND datediff(end_date,curdate()) >= 0 AND (coupon.user_id = " . $user_id . " OR coupon.user_id IS NULL OR coupon.user_id = 0) ORDER BY end_date");
     $htmlbody = "<h4>Coupons For Things I Need/Want</h4>\n";
     $htmlbody .= "<table width=\"100%\" class=contenttoc><tr><td class=sectiontableheader align=center><b>Coupon</b></td><td class=sectiontableheader align=center><b>Vendor/Brand</b></td><td class=sectiontableheader align=center><b>Discount</b></td><td class=sectiontableheader align=center><b>End Date</b></td><td class=sectiontableheader align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";

        if ($objects['discount_units'] == 'Dollars')
           $totalSavings += $objects['discount'];

        $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center><a href=index.php?view=coupon&title=" . urlencode($objects['coupon_name']) . "&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td class=bstm_td>" . $objects['vendor_name'] . " " . $objects['product_name'] . "</td><td class=bstm_td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>";
     }
     $htmlbody .= "</table>";

     $htmlbody .= "<br><br>";

     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, store, my_stores WHERE store.store_id = my_stores.store_id AND coupon.store_id = store.store_id  AND my_stores.user_id = " . $user_id . " AND datediff(end_date,curdate()) >= 0 AND (coupon.user_id = " . $user_id . " OR coupon.user_id IS NULL OR coupon.user_id = 0) ORDER BY end_date");

     $htmlbody .= "<h4>Coupons For Places I Shop/Eat/Buy</h4>\n";
     $htmlbody .= "<table width=\"100%\" class=contenttoc><tr><td class=sectiontableheader align=center><b>Coupon</b></td><td class=sectiontableheader align=center><b>Store/Restaurant/Service</b></td><td class=sectiontableheader align=center><b>Discount</b></td><td class=sectiontableheader align=center><b>End Date</b></td><td class=sectiontableheader align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";

        if ($objects['discount_units'] == 'Dollars')
           $totalSavings += $objects['discount'];

        $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center><a href=index.php?view=coupon&title=" . urlencode($objects['coupon_name']) . "&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td class=bstm_td>" . $objects['store_name'] . "</td><td class=bstm_td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>";
     }
     $htmlbody .= "</table>";
     $htmlbody .= "<br><br>";

$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon c " .
"LEFT JOIN store ON c.store_id = store.store_id " .
"LEFT JOIN product ON c.product_id = product.product_id " . 
"LEFT JOIN vendor ON product.vendor_id = vendor.vendor_id WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 AND (user_id = " . $user_id . " OR user_id IS NULL OR user_id = 0) ORDER BY end_date");

     $htmlbody .= "<h4>Coupons Expiring Soon</h4>\n";
     $htmlbody .= "<table width=\"100%\" class=contenttoc><tr><td class=sectiontableheader align=center><b>Coupon</b></td><td class=sectiontableheader align=center><b>Vendor/Brand</b></td><td class=sectiontableheader align=center><b>Discount</b></td><td class=sectiontableheader align=center><b>End Date</b></td><td class=sectiontableheader align=center><b>Days Left</b></td></tr>\n";
     $rows = 0;
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";

        $vendorName = $objects['vendor_name'];
        $productName = $objects['product_name'];
        $storeName = $objects['store_name'];
        if ($vendorName == "Any") $vendorName = "";
        if ($productName == "Any") $productName = "";
        
        $vendorBrand = $vendorName . " " . $productName . (strlen($storeName) > 0?" at " . $storeName:"");

        if ($objects['discount_units'] == 'Dollars')
           $totalSavings += $objects['discount'];

        $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center><a href=index.php?view=coupon&title=" . urlencode($objects['coupon_name']) . "&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td class=bstm_td>" . $vendorBrand . "</td><td class=bstm_td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>";
     }
     $htmlbody .= "</table>";

     $htmlbody .= "<p><p>";

     $rows = 0;
     $htmlbody .= "<p><h4>Sales Ending Soon</h4></p>";
     $objects_query = tep_db_query("select sale.*, sale_line_item.*, product.product_name, datediff(end_date,curdate()) days_left from sale, sale_line_item, shopping_list, product, vendor, my_stores WHERE my_stores.store_id = sale.store_id AND my_stores.user_id = " . $user_id . " AND shopping_list.user_id = " . $user_id . " AND sale_line_item.product_id = shopping_list.product_id AND sale_line_item.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND sale.sale_id = sale_line_item.sale_id AND datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 ORDER BY end_date");
     $htmlbody .= "<table width=\"100%\" class=contenttoc><tr><td class=sectiontableheader align=center><b>Sale</b></td><td class=sectiontableheader align=center><b>Product</b></td><td class=sectiontableheader align=center><b>Price</b></td><td class=sectiontableheader align=center><b>End Date</b></td><td class=sectiontableheader align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";
        
        $htmlbody .= "<tr" . $bgcolor . "><td class=bstm_td align=center><a href=index.php?view=sale&action=display&sale_id=" . $objects['sale_id'] . ">" . $objects['sale_name'] . "</a></td><td class=bstm_td align=center>" . $objects['vendor_name'] . " " . $objects['product_name'] . "</td><td class=bstm_td align=right>" . ($objects['discount_units'] == 'Dollars' || $objects['price'] != 0?"$":"") . displayField($objects['price'],"NUMBER","###,###.00") . "/" . $objects['price_units'] . "</td><td class=bstm_td align=center>" . sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>\n";
     }
     $htmlbody .= "</table>\n";

     $htmlbody .= "<br><br>";
     $rows = 0;
     $htmlbody .= "<h4>Deals Ending Soon</h4>";

     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from deal, source WHERE deal.source_id = source.source_id AND datediff(end_date,curdate()) < 100 AND datediff(end_date,curdate()) >= 0 ORDER BY end_date");
     $htmlbody .= "<table width=\"100%\" class=contenttoc><tr><td class=sectiontableheader align=center><b>Source</b></td><td class=sectiontableheader align=center><b>Deal</b></td><td class=sectiontableheader align=center><b>Savings</b></td><td class=sectiontableheader align=center><b>End Date</b></td><td class=sectiontableheader align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {

        $bgcolor = "";
/*
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";
*/

        $location = $objects['location'];

        if ($objects['discount_units'] == 'Dollars')
           $totalSavings += $objects['savings'];

        if (strlen($location) > 0 && strpos($location_filter, $location) !== false)
        {
           $htmlbody .= "<tr" . $bgcolor . "><td class=bstm_td>" . $objects['source_name'] . "</td><td class=bstm_td align=center><a href=index.php?view=deal&title=" . urlencode($objects['deal_name']) . "&action=display&deal_id=" . $objects['deal_id'] . ">" . $objects['deal_name'] . "</a></td><td class=bstm_td align=right>$" . $objects['savings_amount'] . "</td><td class=bstm_td align=center>" . sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
           $rows++;
        }
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>\n";
     }
     $htmlbody .= "</table>\n";
     $htmlbody .= "\n";

    return $htmlbody;
  }
function insertFaceBookLike($url)
{
   if (strlen($url) == 0)
      $url = selfURL();
   echo "<div class=\"module\">
   <script src=\"http://connect.facebook.net/en_US/all.js#xfbml=1\"></script><fb:like href=\"" . $url . "\" layout=\"button_count\" show_faces=\"false\" width=\"200\"></fb:like>
   </div>\n";
}
function selfURL() {
	$s = empty($_SERVER["HTTPS"]) ? ''
		: ($_SERVER["HTTPS"] == "on") ? "s"
		: "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
		: (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
}

?>
