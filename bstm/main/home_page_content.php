
<div class="componentheading">Bring Savings To Me</div>

<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e51a5651402d491"></script>
<!-- AddThis Button END -->
<table class="blog" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top">
					<div>
		
<table class="contentpaneopen">




<tr>
<td valign="top" colspan="2">
			<form action="index.php?view=search&action=search" method="post">
	           <div class="big_search">
<b><font size=4>Search for Savings!!!</font></b>
		<input name="searchword" id="mod_search_searchword" maxlength="80" alt="Search" class="inputbox" type="text" size="80" value="Enter Product Name (e.g., Pepsi or Porterhouse)"  onblur="if(this.value=='') this.value='Enter Product Name (e.g., Pepsi or Porterhouse)';" onfocus="if(this.value=='Enter Product Name (e.g., Pepsi or Porterhouse)') this.value='';" />	
                   </div>
</form>
<!--
<p>Bring Savings To Me is a web portal dedicated to helping individuals save money.  From Food, to Electronics, to Sales and Coupons, you can come to this one site and it will help you find the best savings possible.  Customers that use Bring Savings to Me save an average of $500 per year. </p>
<p>The concept is very simple.  How do you optimize the use of coupons, sale information, and web pricing when making purchasing decisions out on the street? You could go out on the Internet and research items one by one.  It would probably take you a day or so to do this.  With BSTM, it's much easier.  You just login and the software tells you the cheapest way to buy what you want.  It tells you if your product is on sale.  It tells you if there is a coupon available on the product you want. It brings the savings information to you in a useful way to save you time and ultimately money.</p>
<p>It's as easy as 123.  Create your shopping list, and let us research all the thousands of coupons and sales for you.  You can have them delivered to you at your PC, via Emails everyday, or to your Smartphone.  The choice is yours.</p></td>
-->
</tr>



</table>
<span class="article_separator">&nbsp;</span>
		</div>
		</td>
</tr>


</table>
<div class="componentheading">Sample Deals (login for more)</div>
<?php
echo sqlQuery("SELECT deal.deal_name as 'Deal Name', deal.location as 'Location' FROM deal WHERE deal_name NOT LIKE '%UTF-8%' ORDER BY deal.end_date DESC limit 0, 20");
?>
<div class="componentheading">Sample Sale Items (login for more)</div>
<?php
echo str_replace("2011","11", sqlQuery("SELECT sale.sale_name as 'Sale Name', sale_line_item.sale_line_item_name as 'Product', concat('$', format(sale_line_item.price,2)) as 'Price' FROM store, sale, sale_line_item WHERE store.store_id = sale.store_id AND sale.sale_id = sale_line_item.sale_id ORDER BY sale.end_date DESC limit 0, 50"));
?>
<div class="componentheading">Sample Coupons</div>
<?php
    $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon c " .
"LEFT JOIN store ON c.store_id = store.store_id " .
"LEFT JOIN product ON c.product_id = product.product_id " . 
"LEFT JOIN vendor ON product.vendor_id = vendor.vendor_id WHERE datediff(end_date,curdate()) < 0 AND (user_id IS NULL OR user_id = 0) ORDER BY end_date");

     $htmlbody .= "<table class=contenttoc><tr><td class=sectiontableheader align=center><b>Coupon</b></td><td class=sectiontableheader align=center><b>Vendor/Brand</b></td><td class=sectiontableheader align=center><b>Discount</b></td></tr>\n";
     $rows = 0;
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";

        $vendorName = $objects['vendor_name'];
        $productName = $objects['product_name'];
        $storeName = trim($objects['store_name']);
        if ($vendorName == "Any") $vendorName = "";
        if ($productName == "Any") $productName = "";
        
        $vendorBrand = $vendorName . " " . $productName . (strlen($storeName) > 0 && $vendorName != $storeName?" at " . $storeName:"");

        if ($objects['discount_units'] == 'Dollars')
           $totalSavings += $objects['discount'];

        $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td class=bstm_td>" . $vendorBrand . "</td><td class=bstm_td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>";
     }
     $htmlbody .= "</table>";
     echo $htmlbody;
?>
