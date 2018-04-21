<div class="moduletable"> <h3>Products</h3><div>

<?php

    $objects_query = tep_db_query("SELECT product_id as id, product.*, vendor.* FROM product, vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
    //echo "<b><a href=what_is_price_for_pepsi.html>Pepsi</a></b><p>\n";
    while ($objects = tep_db_fetch_array($objects_query)) 
    {
       $rows++;
        
        if ($objects['vendor_name'] == 'Any')
        {
           echo "<b><a href=what_is_price_for_" . str_replace(" ","_", $objects['product_name']) . ".html>Coupons for " . $objects['product_name'] . "</a></b><p>\n";
           echo "<b><a href=how_much_is_" . str_replace(" ","_", $objects['product_name']) . ".html>Sales for " . $objects['product_name'] . "</a></b><p>\n";
           //echo "http://www.bringsavingstome.com/bstm/main/what_is_price_for_" . str_replace(" ","_", strtolower($objects['product_name'])) . ".html\n";
           //echo "http://www.bringsavingstome.com/bstm/main/how_much_is__" . str_replace(" ","_", strtolower($objects['product_name'])) . ".html\n";
        }
        else 
        {
           echo "<b><a href=what_is_price_for_" . str_replace(" ","_", $objects['vendor_name']) . "_" .  str_replace(" " , "_",$objects['product_nameXXX']) . ".html>Coupons for " . $objects['vendor_name'] . " " , $objects['product_name'] . "</a></b><p>\n";
           echo "<b><a href=how_much_is_" . str_replace(" ","_", $objects['vendor_name']) . "_" .  str_replace(" " , "_",$objects['product_nameXXX']) . ".html>Sales for " . $objects['vendor_name'] . " " , $objects['product_name'] . "</a></b><p>\n";
           //echo "http://www.bringsavingstome.com/bstm/main/what_is_price_for_" . str_replace(" ","_", strtolower($objects['vendor_name'])) . ".html\n";
           //echo "http://www.bringsavingstome.com/bstm/main/how_much_is_" . str_replace(" ","_", strtolower($objects['vendor_name'])) . ".html\n";
        }
     }
?>
