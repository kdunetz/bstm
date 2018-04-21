<?php
require('configure.php');
require('database.php');
tep_db_connect();
require('functions.php');

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<rss version=\"2.0\">\n";
echo "<channel>\n";
echo "<title>Daily Sales/Coupons/Deals</title>\n";
echo "<description>RSS Feed</description>\n";
echo "<link>http://www.bringsavingstome.com</link>\n";
echo "<pubDate>";
echo date("D, d M Y G:i:s T",time());
echo "</pubDate>\n";
$saleFilter = " AND datediff(sale_line_item.creation_date, curdate()) = 0";
$endSaleFilter = " AND datediff(sale.end_date, curdate()) = 0";
//$couponFilter = " AND datediff(coupon.creation_date,curdate()) = 0 AND coupon.product_id != 95";
$couponFilter = " AND datediff(coupon.creation_date,curdate()) = 0";
$dealFilter = " WHERE datediff(deal.creation_date,curdate()) = 0"; 
$bestPriceFilter = " AND datediff(product_best_price.creation_date,curdate()) = 0"; 

     $sqlCommand = "select 'Coupon' as result_type, '' as store_name, coupon.creation_date as creation_date, coupon_id as _id, coupon.begin_date, coupon.end_date, coupon.coupon_name as name, coupon.discount as value, coupon.discount_units as value_units, product.product_name, datediff(end_date,curdate()) days_left, '' as location, '' as special_promotion FROM coupon, product, source WHERE coupon.source_id = source.source_id AND coupon.product_id = product.product_id"  . $couponFilter; 
     $sqlCommand .= " UNION select 'Sale Line Item' as result_type, store_name, sale_line_item.creation_date as creation_date, sale_line_item.sale_line_item_id as _id, sale.begin_date, sale.end_date, sale_line_item.sale_line_item_name as name, sale_line_item.price as value, sale_line_item.price_units as value_units, product.product_name, datediff(end_date,curdate()) days_left, '' as location, sale_line_item.special_promotion FROM store, sale, sale_line_item, product WHERE store.store_id = sale.store_id AND sale.sale_id = sale_line_item.sale_id AND sale_line_item.product_id = product.product_id"  . $saleFilter . ""; 
     $sqlCommand .= " UNION select 'Deal' as result_type, '' as store_name, deal.creation_date as creation_date, deal.deal_id as _id, deal.begin_date, deal.end_date, deal.deal_name as name, deal.savings_amount as value, '' as value_units, '' as product_name, datediff(end_date,curdate()) days_left, deal.location as location, '' as special_promotion FROM deal "  . $dealFilter . ""; 
     $sqlCommand .= " UNION select 'End of Sale' as result_type, store.store_name as store_name, sale.creation_date as creation_date, sale.sale_id as _id, sale.begin_date, sale.end_date, sale.sale_name as name, '' as value, '' as value_units, '' as product_name, datediff(end_date,curdate()) days_left, '' as location, '' as special_promotion FROM sale, store WHERE sale.store_id = store.store_id "  . $endSaleFilter . ""; 
     $sqlCommand .= " UNION select 'Best Price' as result_type, store.store_name as store_name, product_best_price.creation_date as creation_date, product_best_price.product_best_price_id as _id,  price_date as begin_date, '' as end_date, product_best_price_name as name, price as value, price_units as value_units, product_name, '' as days_left, location, '' as special_promotion FROM product_best_price, product, store WHERE product_best_price.product_id = product.product_id AND product_best_price.store_id = store.store_id "  . $bestPriceFilter . ""; 
     $sqlCommand .= " UNION select 'Website' as result_type, website_name as store_name, '' as creation_date, website_id as _id,  '' as begin_date, '' as end_date, '' as name, '' as value, '' as value_units, '' as product_name, '' as days_left, '' as location, '' as special_promotion FROM website"; 
     //$sqlCommand .= " UNION select 'Product' as result_type, product_id as _id, '' as begin_date, '' as end_date, concat(vendor_name, ' ', product_name) as name, '' as value, '' as value_units, product.product_name, '' as days_left FROM product, vendor WHERE product.vendor_id = vendor.vendor_id "  . $productFilter . " ORDER BY end_date"; 
    $objects_query = tep_db_query($sqlCommand);
    while ($objects = tep_db_fetch_array($objects_query)) 
    {
       $rows++;
       echo "<item>\n";
       $objects['name'] = str_replace("&","&amp;", $objects['name']);
       if ($objects['result_type'] == 'Sale Line Item')
       {
          echo "<title>" . $objects['name'] . " on sale at " . $objects['store_name'] . "</title>\n";
          echo "<description>" . ($objects['value'] == 0?$objects['special_promotion']:"$" . displayField($objects['value'],"NUMBER","###,###.00") . "/" . $objects['value_units']) . " until " . sqlToUserDate($objects['end_date']) . ". Compare prices at BSTM.</description>\n";
          $search_word = $objects['product_name'];
          $search_word = str_replace("&", "&amp;", $search_word);
          $search_word = str_replace(" ", "+", $search_word);
          echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=search&amp;action=search&amp;searchword=" . $search_word . "&amp;id=" . $objects['_id'] . "</link>\n";
          $objects['_id'] = $objects['_id'] + 1000000;
       }
       if ($objects['result_type'] == 'Deal')
       {
          echo "<title>" . $objects['name'] . " in " . $objects['location'] . "</title>\n";
          echo "<description>Sign up today.</description>\n";
          if (false)
          {
             $search_word = $objects['name'];
             $search_word = str_replace(" ", "+", $search_word);
             echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=search&amp;action=search&amp;searchword=" . $search_word . "&amp;id=" . $objects['_id'] . "</link>\n";
          }
          else
          {
             echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=deal&amp;action=display&amp;deal_id=" . $objects['_id'] . "</link>\n";
          }
          $objects['_id'] = $objects['_id'] + 10000000;
       }
       if ($objects['result_type'] == 'Coupon')
       {
          echo "<title>" . $objects['name'] . "</title>\n";
          if (strlen(sqlToUserDate($objects['end_date'])) > 0)
             echo "<description>Until " . sqlToUserDate($objects['end_date']) . ". Add this coupon to your BSTM Shopping List?</description>\n";
          else
             echo "<description>Add this coupon to your BSTM Shopping List?</description>\n";
          if (false)
          {
             echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=search&amp;action=search&amp;searchword=" . str_replace(" ", "+", $objects['name']) . "&amp;id=" . $objects['_id'] . "</link>\n";
          }
          else
          {
             echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=coupon&amp;action=display&amp;coupon_id=" . $objects['_id'] . "</link>\n";
          }
          $objects['_id'] = $objects['_id'] + 100000000;
       }
       if ($objects['result_type'] == 'End of Sale')
       {
          echo "<title>Sale at " . str_replace("&","&amp;", $objects['store_name']) . " ends today</title>\n";
          echo "<description>Pull down all the sale items and coupons</description>\n";
          echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=sale&amp;action=display&amp;sale_id=" . $objects['_id'] . "</link>\n";
          $objects['_id'] = $objects['_id'] + 1000000000;
       }
       if ($objects['result_type'] == 'Best Price')
       {
          echo "<title>Great Deal for " . $objects['name'] . " found at " . $objects['store_name'] . " in " .  $objects['location'] . "</title>\n";
          echo "<description>" . ($objects['value'] == 0?$objects['special_promotion']:"$" . displayField($objects['value'],"NUMBER","###,###.00") . "/" . $objects['value_units']) . ". Find other great deals at Bring Savings To Me</description>\n";
          if (false)
          {
             $search_word = $objects['product_name'];
             $search_word = str_replace("&", "&amp;", $search_word);
             $search_word = str_replace(" ", "+", $search_word);
             echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=search&amp;action=search&amp;searchword=" . str_replace(" ", "+", $objects['name']) . "&amp;id=" . $objects['_id'] . "</link>\n";
          }
          else
          {
              echo "<link>http://www.bringsavingstome.com/bstm/main/index.php?view=best_price&amp;action=display&amp;product_best_price_id=" . $objects['_id'] . "</link>\n";
          }
          $objects['_id'] = $objects['_id'] + 10000000000;
       }
       if ($objects['result_type'] == 'Website')
       {
          echo "<title>Coupon Website to Try: " . str_replace("&","&amp;", $objects['store_name']) . "</title>\n";
          echo "<description>Pull down more sale items and coupons</description>\n";
          $link = "http://www.bringsavingstome.com/bstm/main/index.php?view=list_of_coupon_sites&website_id=" . $objects['_id'];
          $link = str_replace("&","&amp;", $link);
          echo "<link>" . $link . "</link>\n";
          $objects['_id'] = $objects['_id'] + 299000000;
       }
       echo "<pubDate>";
       echo date("D, d M Y G:i:s T",time());
       echo "</pubDate>\n";
       echo "<GUID>";
       echo $objects['_id'];
       echo "</GUID>\n";
       echo "</item>\n";
     }
echo "</channel>\n";
echo "</rss>\n";
?>
