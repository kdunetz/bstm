<div class="componentheading">Search Results</div>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'search')) 
  {
     if (!isset($_POST['searchword'])) 
     {
        echo "ERROR: Must specify a search word"; 
        return;
     }
     if (strlen($_POST['searchword']) < 3) 
     {
        echo "ERROR: Must enter at least 3 characters to search on"; 
        return;
     }
     if (strpos($_POST['searchword'],'%')  !== false)
     {
        echo "ERROR: Wild cards are not supported"; 
        return;
     }
     if (!tep_session_is_registered('user_id')) 
     {
        echo "Please login to get additional details about these coupons, sales, or deals.<p>";
     }
     if (isset($_POST['searchword'])) 
     {
        $filter = " AND (coupon_name LIKE '%" . $_POST['searchword'] . "%' OR product_name LIKE '%" . $_POST['searchword'] . "%')";
        $saleFilter = " AND (UPPER(sale_line_item_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR UPPER(product_name) LIKE UPPER('%" . $_POST['searchword'] . "%'))";
/* echo $filter; */
     }
     $id = $_GET['id'];

     //$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product WHERE coupon.product_id = product.product_id"  . $filter . " AND end_date >= now() ORDER BY end_date"); 
     $sqlCommand = "select 'Coupon' as result_type, coupon_id as _id, coupon.begin_date, coupon.end_date, coupon.coupon_name as name, coupon.discount as value, coupon.discount_units as value_units, product.product_name, datediff(end_date,curdate()) days_left FROM coupon, product WHERE coupon.product_id = product.product_id"  . $filter; 
     $sqlCommand .= " UNION select 'Sale_line_item' as result_type, sale_line_item.sale_line_item_id as _id, sale.begin_date, sale.end_date, sale_line_item.sale_line_item_name as name, sale_line_item.price as value, sale_line_item.price_units as value_units, product.product_name, datediff(end_date,curdate()) days_left FROM sale, sale_line_item, product WHERE sale.sale_id = sale_line_item.sale_id AND sale_line_item.product_id = product.product_id"  . $saleFilter . " ORDER BY end_date"; 
     $objects_query = tep_db_query($sqlCommand);
     $rows = 0;
     $htmlbody .= "<table border=1><tr><td align=center><b>Coupon/Sale</b></td><td align=center><b>Discount</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $packaging_size = $objects['packaging_size'];
        $packaging_size = str_replace(".0000", "", $packaging_size);
        $variable = $objects['packaging_quantity'] . " ". $packaging_size . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  

        if ($objects['packaging_quantity'] != "" && $objects['packaging_quantity'] != 1) $variable .= "s";

        /* clean up bad data before it is displayed */
        if (str_replace(" ", "", $variable) == "00s") $variable = "";
   
        if ($mobile)
        {
           echo "<div class=\"uip"; if ($rows == 1) echo " first"; if ($rows == sizeof($objects)) echo " last"; echo "\"><table class=\"template single two-column\" onclick=\"location.href='index.php?action=detail&id=" . $objects['coupon_id'] . "'\"><tr><td class=\"icon\" width=\"24\">" . $rows . ")</td><td class=\"right\">
        
           <table class=\"template\"><tr><td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $objects['product_name'] . "</span><br/> 
           <span class=\"small\">" . $variable;  echo "</span> </div></td>
           <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>Save $" . $objects['discount'] . "</strong></span><br/> <span class=\"positive\">Expires " . sqltoUserDate($objects['end_date']) . "</span> </div></td></tr></table></td></tr></table></div>";
           if ($id == $objects['coupon_id']) print_coupon_details($objects);
         }
         else
         {
           if ($objects['result_type'] == 'Coupon')
              $htmlbody .= "<tr" . $bgcolor ."><td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['_id'] . ">" . $objects['name'] . "</a></td><td align=right>" . ($objects['value_units'] == 'Dollars'?"$":"") . displayField($objects['value'],"NUMBER","###,###.00") . ($objects['value_units'] == 'Percent'?"%":"") . "</td><td align=center>". sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
            else
              $htmlbody .= "<tr" . $bgcolor ."><td align=center><a href=index.php?view=sale_line_item&action=display&sale_line_item_id=" . $objects['_id'] . ">" . $objects['name'] . "</a></td><td align=right>" . displayField($objects['value'],"NUMBER","$###,###.00") . "/" . $objects['value_units'] . "</td><td align=center>". sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
         }
      }

      if ($rows == 0)
      {
         //echo "</div>";
         if ($mobile)
            echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>";
         else
            $htmlbody .= "<tr><td align=center colspan=4>No Results</td></tr>\n";
 
       //return;
      }
      if (!$mobile)
         $htmlbody .= "</table>\n";
      if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
      {
         //return;
      }
      if (!$mobile)
         echo $htmlbody;
  }
?>
