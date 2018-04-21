<?php
  function sendMail($from, $to, $subject, $body)
  {
     $headers = "MIME-Version: 1.0" . "\r\n"; 
     $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
     //$headers .= "Content-type: multipart/alternative; boundary=" . $mime_boundary_header . "\r\n";
     $headers .= "From: " . $from . "\r\n";
   
     if (mail($to, $subject, $body, $headers)) 
     {
         return true;
     } 
     else 
     {
         return false;
     }
  }

function createShoppingList()
{
  global $user_id;
  $html = "<table class=contenttoc width=\"100%\">";
  $html = "<table border=2 width=\"100%\">";
  $html .= "<tr>";
  if ($_GET['action'] != "simple_list")
     $html .= "<td class=sectiontableheader align=center><b>Action</b></td>";
  $html .= "<td class=sectiontableheader align=center><b>Product</b></td><td class=sectiontableheader align=center><b>Sales/Coupons</b></td><td class=sectiontableheader align=center ><b>Best Price</b></td><td class=sectiontableheader align=center><b>Status</b></td></tr>\n";

  $filter = "";
  if (isset($_GET['product_type']) && $_GET['product_type'] != 'All')
     $filter = " AND product.product_type = '" . $_GET['product_type'] . "' ";

  $rows = 0;
  $objects_query = tep_db_query("SELECT shopping_list_id as id, shopping_list.*, user.*, product.*, concat(vendor_name, ' ', product_name) as product_name2 FROM shopping_list, user, product, vendor WHERE product.vendor_id = vendor.vendor_id AND shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.user_id = '" . $user_id . "'" . $filter . "ORDER BY status DESC, product_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;
     $sales_query = tep_db_query("SELECT * FROM sale, store, sale_line_item, my_stores WHERE my_stores.store_id = sale.store_id AND sale.store_id = store.store_id AND sale_line_item.sale_id = sale.sale_id AND sale_line_item.product_id = " . $objects['product_id'] . " AND sale.end_date >= now() AND my_stores.user_id = " . $user_id . " UNION SELECT * FROM sale, store, sale_line_item, my_stores WHERE my_stores.store_id = sale.store_id AND sale.store_id = store.store_id AND sale_line_item.sale_id = sale.sale_id AND sale_line_item.sale_line_item_name LIKE '%" . $objects['product_name'] . "%' AND sale.end_date >= now() AND my_stores.user_id = " . $user_id . "");
     $onSale = false;
     $salesString = "";
     if (tep_db_num_rows($sales_query) > 0)
     {
        $onSale = true;
        $counter = 0;
        while ($sales = tep_db_fetch_array($sales_query)) 
        {
           $counter++;
           $salesString .= $counter . ") <a href=http://www.bringsavingstome.com/bstm/main/index.php?view=sale_line_item&action=display&sale_line_item_id=" . $sales['sale_line_item_id'] . ">Sale " . $sales['store_name'] . " (" . sqlToUserDate($sales['end_date']) . ") ("; 
           if ($sales['price'] > 0)
              $salesString .= displayField($sales['price'],"NUMBER","$###,###.00")  . "/" . $sales['price_units'];
           else
              $salesString .= $sales['special_promotion'];
           $salesString .= ")</a><br>";
        }
     }
     $coupon_query = tep_db_query("SELECT * FROM coupon, product WHERE coupon.product_id = product.product_id AND (coupon.product_id = " . $objects['product_id'] . " OR product.product_name = '" . $objects['product_name'] . "') AND coupon.end_date >= now()");
     $couponAlert = false;
     $coupons = tep_db_fetch_array($coupon_query);
     if (tep_db_num_rows($coupon_query) > 0)
     {
        $couponAlert = true;
     }
global $location_filter;
     //$best_price_query = tep_db_query("SELECT * FROM product_best_price WHERE product_best_price.product_id = " . $objects['product_id'] . " AND '" . $location_filter . "' LIKE concat('%', location, '%') ORDER BY price");
     $best_price_query = tep_db_query("SELECT 'Best Price' as price_source, product_best_price.product_best_price_id, store.store_name, product_best_price.price, price_units, price_date as date, product_best_price.cost_per_unit, product_best_price.cost_per_unit_units FROM product_best_price, product, store WHERE product_best_price.product_id = product.product_id AND product_best_price.store_id = store.store_id AND product_best_price.product_id = " . $objects['product_id'] . " AND '" . $location_filter . "' LIKE concat('%',location,'%') AND product_best_price.price > 0 UNION SELECT 'Sale' as price_source, sale_line_item_id as product_best_price_id, store.store_name, sale_line_item.price, price_units, end_date AS date, sale_line_item.cost_per_unit, sale_line_item.cost_per_unit_units FROM sale, sale_line_item, store WHERE sale.sale_id = sale_line_item.sale_id AND sale.store_id = store.store_id AND sale_line_item.product_id = " . $objects['product_id'] . " AND sale_line_item.price > 0 UNION SELECT 'Best Price' as price_source, product_best_price.product_best_price_id, store.store_name, product_best_price.price, price_units, price_date as date, product_best_price.cost_per_unit, product_best_price.cost_per_unit_units FROM product_best_price, product, store WHERE product_best_price.store_id = store.store_id AND product_best_price_name LIKE '%" . $objects['product_name'] . "%' AND product_best_price.price > 0 ORDER BY price");
     $bestPriceAlert = false;
     $best_price = tep_db_fetch_array($best_price_query);
     if (tep_db_num_rows($best_price_query) > 0)
     {
        $bestPriceAlert = true;
     }

    $html .= "<tr>";
    if ($_GET['action'] != "simple_list")
    {
        $html .= "<a name=\"" . $objects['shopping_list_id'] . "\"></a>";
        $html .= "<td class=bstm_td><a class=\"button\" href=index.php?view=my_shopping_list&action=delete&shopping_list_id=" . $objects['shopping_list_id'] . "><span>Delete</span></a><br><a class=\"button\" href=index.php?view=my_shopping_list&action=display_edit_form&shopping_list_id=" . $objects['shopping_list_id'] . "><span>Edit</span></a>";
        if ($objects['status'] == 'Need')
        {
           $html .= "<br><a class=\"button\" href=index.php?view=my_shopping_list&action=update_field&field=status&value=Got&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . "><span>Got it</span></a>";
        }
        else
        {
           $html .= "<br><a class=\"button\" href=index.php?view=my_shopping_list&action=update_field&field=status&value=Need&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . "><span>Need</span></a>";
        }
        $html .= "</td>";
   }
   if (strpos($objects['product_name2'], "Any ") !== false) /* KAD added to take off the any to make it easier to search */
   {
      $objects['product_name2'] = substr($objects['product_name2'], 4);
   }
$bestPriceLink = "";
if (strlen($best_price['price']) > 0)
{
   if ($best_price['price_source'] == 'Best Price')
      $bestPriceLink = "<a href=http://www.bringsavingstome.com/bstm/main/index.php?view=best_price&action=display&product_best_price_id=";
   else
      $bestPriceLink = "<a href=http://www.bringsavingstome.com/bstm/main/index.php?view=sale_line_item&action=display&sale_line_item_id=";
   $bestPriceLink .= $best_price['product_best_price_id'] . " TITLE='" . $best_price['store_name'] . " on " .  sqlToUserDate($best_price['date']) . "'>" . displayField($best_price['price'],"NUMBER","$###,###.00") . "/" . $best_price['price_units'] . (strlen($best_price['cost_per_unit_units']) > 0 && $best_price['cost_per_unit_units'] != "Pound"?" - " . $best_price['cost_per_unit'] . "/" . $best_price['cost_per_unit_units']:"") . "</a>";
}
$imageLink = "";
if (strlen($objects['image_name']) > 0)
{
   $imageLink = "<img src=../common/images/" . $objects['image_name'] . " width=40 height=40>";
}

$html .= "<td class=bstm_td><a href=http://www.bringsavingstome.com/bstm/main/index.php?view=my_shopping_list&action=display&shopping_list_id=" . $objects['shopping_list_id'] . ">" . displayField($objects['product_name2'],'STRING','') . (strlen($objects['other_product_name']) > 0?" (" . $objects['other_product_name'] . ")":"" ) . "</a>" . $imageLink . "</td><td class=bstm_td>" . $salesString . ($couponAlert?" <a href=http://www.bringsavingstome.com/bstm/main/index.php?view=coupon&action=display&coupon_id=" . $coupons['coupon_id'] . ">Coupon (" . sqlToUserDate($coupons['end_date']) . ") (" . displayField($coupons['discount'],"NUMBER","$###,###.00") . ($coupons['discount_type'] == "D"?" off":" each") . ")</a>":"") . "</td><td class=bstm_td>" . $bestPriceLink . "</td><td class=bstm_td>" . displayField($objects['status'],'STRING','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     $html .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>\n";
  }
  $html .= "</table>\n";
  return $html;
}
?>
