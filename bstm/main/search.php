<div class="componentheading">Search Results</div>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'search')) 
  {
     if (!isset($_POST['searchword']) & !isset($_GET['searchword'])) 
     {
        echo "ERROR: Must specify a search word"; 
        return;
     }
     if (strlen($_POST['searchword']) < 3 && strlen($_GET['searchword']) < 3) 
     {
        echo "ERROR: Must enter at least 3 characters to search on"; 
        return;
     }
     if (strpos($_POST['searchword'],'%')  !== false && strpos($_GET['searchword'],'%')  !== false)
     {
        echo "ERROR: Wild cards are not supported"; 
        return;
     }
?>
			<form action="index.php?view=search&action=search" method="post">
	           <div class="big_search">
<b><font size=4>Search for Savings!!!</font></b>
		<input name="searchword" id="mod_search_searchword" maxlength="80" alt="Search" class="inputbox" type="text" size="80" value="Enter Product Name (e.g., Pepsi or Porterhouse)"  onblur="if(this.value=='') this.value='Enter Product Name (e.g., Pepsi or Porterhouse)';" onfocus="if(this.value=='Enter Product Name (e.g., Pepsi or Porterhouse)') this.value='';" />	
                   </div>
</form>
<?php
     if (!tep_session_is_registered('user_id')) 
     {
        echo "Please login to get additional details about these coupons, sales, or deals.<p>";
     }
   
     if (isset($_GET['searchword'])) 
        $_POST['searchword'] = $_GET['searchword'];

     if (isset($_POST['searchword'])) 
     {
        $filter = " AND (coupon_name LIKE '%" . $_POST['searchword'] . "%' OR product_name LIKE '%" . $_POST['searchword'] . "%' OR upc_code LIKE '%" . $_POST['searchword'] . "%')";
        $saleFilter = " AND (UPPER(sale_line_item_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR UPPER(product_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR upc_code LIKE '%" . $_POST['searchword'] . "%')";
        $productFilter = " AND (UPPER(product_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR UPPER(vendor_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR upc_code LIKE '%" . $_POST['searchword'] . "%')";
        $dealFilter = " WHERE (UPPER(deal_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR UPPER(deal_name) LIKE UPPER('%" . $_POST['searchword'] . "%'))";
        $productBestPriceFilter = " AND (UPPER(product_best_price_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR UPPER(product_name) LIKE UPPER('%" . $_POST['searchword'] . "%') OR upc_code LIKE '%" . $_POST['searchword'] . "%')";
/* echo $filter; */
     }
     $id = $_GET['id'];

     //$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product WHERE coupon.product_id = product.product_id"  . $filter . " AND end_date >= now() ORDER BY end_date"); 
     $sqlCommand = "select 'Coupon' as result_type, coupon_id as _id, coupon.begin_date, coupon.end_date, coupon.coupon_name as name, coupon.discount as value, coupon.discount_units as value_units, product.product_name, datediff(end_date,curdate()) days_left, '' as special_promotion, '' as store_name FROM coupon, product WHERE coupon.product_id = product.product_id"  . $filter; 
     $sqlCommand .= " UNION select 'Sale Line Item' as result_type, sale_line_item.sale_line_item_id as _id, sale.begin_date, sale.end_date, sale_line_item.sale_line_item_name as name, sale_line_item.price as value, sale_line_item.price_units as value_units, product.product_name, datediff(end_date,curdate()) days_left, sale_line_item.special_promotion, store_name FROM store, sale, sale_line_item, product WHERE store.store_id = sale.store_id AND sale.sale_id = sale_line_item.sale_id AND sale_line_item.product_id = product.product_id"  . $saleFilter . ""; 
     $sqlCommand .= " UNION select 'Product Best Price' as result_type, product_best_price.product_best_price_id as _id, '' as begin_date, product_best_price.price_date as end_date, product_best_price.product_best_price_name as name, product_best_price.price as value, product_best_price.price_units as value_units, product.product_name, '' as days_left, '' as special_promotion, store_name FROM store, product_best_price, product WHERE store.store_id = product_best_price.store_id AND product_best_price.product_id = product.product_id"  . $productBestPriceFilter . ""; 
     $sqlCommand .= " UNION select 'Product' as result_type, product_id as _id, '' as begin_date, '' as end_date, concat(vendor_name, ' ', product_name) as name, '' as value, '' as value_units, product.product_name, '' as days_left, '' as special_promotion, '' as store_name FROM product, vendor WHERE product.vendor_id = vendor.vendor_id "  . $productFilter . ""; 
     $sqlCommand .= " UNION select 'Deal' as result_type, deal_id as _id, begin_date, end_date, deal_name as name, price as value, '' as value_units, '' as product_name, '' as days_left, '' as special_promotion, '' as store_name FROM deal "  . $dealFilter . " ORDER BY result_type, end_date DESC"; 
     $objects_query = tep_db_query($sqlCommand);
     $rows = 0;
     $htmlbody .= "<table width=100% class=contenttoc><tr><td class=sectiontableheader align=center><b>Entity</b></td><td class=sectiontableheader align=center><b>Coupon/Sale/Product</b></td><td class=sectiontableheader align=center><b>Discount/Price</b></td><td class=sectiontableheader align=center><b>End Date</b></td><td class=sectiontableheader align=center><b>Days Left</b></td></tr>\n";
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
              $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center>" . $objects['result_type'] . "</td><td class=bstm_td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['_id'] . ">" . $objects['name'] . "</a></td><td class=bstm_td align=right>" . ($objects['value_units'] == 'Dollars'?"$":"") . displayField($objects['value'],"NUMBER","###,###.00") . ($objects['value_units'] == 'Percent'?"%":"") . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
            else if ($objects['result_type'] == 'Sale Line Item')
            {
              $value = "";
              if ($objects['value'] == 0)
              {
                  $value = $objects['special_promotion'];
              }
              else
              {
                  $value = displayField($objects['value'],"NUMBER","$###,###.00") . "/" . $objects['value_units'];
              } 
    
              $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center>" . $objects['result_type'] . "</td><td class=bstm_td align=center><a href=index.php?view=sale_line_item&action=display&sale_line_item_id=" . $objects['_id'] . ">" . $objects['name'] . (strlen($objects['store_name']) > 0?" at " . $objects['store_name']:"") . "</a></td><td class=bstm_td align=right>" .  $value . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
            }
            else if ($objects['result_type'] == 'Product Best Price')
              $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center>" . $objects['result_type'] . "</td><td class=bstm_td align=center><a href=index.php?view=product_best_price&action=display&product_best_price_id=" . $objects['_id'] . ">" . $objects['name'] . (strlen($objects['store_name']) > 0 ?" at " . $objects['store_name']:"") . "</a></td><td class=bstm_td align=right>" . displayField($objects['value'],"NUMBER","$###,###.00") . "/" . $objects['value_units'] . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
            else if ($objects['result_type'] == 'Deal')
              $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center>" . $objects['result_type'] . "</td><td class=bstm_td align=center><a href=index.php?view=deal&action=display&deal_id=" . $objects['_id'] . ">" . $objects['name'] . "</a></td><td class=bstm_td align=right>" . displayField($objects['value'],"NUMBER","$###,###.00") . "/" . $objects['value_units'] . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
             else
              $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center>" . $objects['result_type'] . "</td><td class=bstm_td align=center><a href=index.php?view=product&action=display&product_id=" . $objects['_id'] . ">" . $objects['name'] . "</a></td><td class=bstm_td align=right>" . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td><td class=bstm_td align=center>" . $objects['days_left'] . "</td></tr>\n";
         }
      }

      if ($rows == 0)
      {
         //echo "</div>";
         if ($mobile)
            echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>";
         else
            $htmlbody .= "<tr><td class=bstm_td align=center colspan=5>No Results</td></tr>\n";
 
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
