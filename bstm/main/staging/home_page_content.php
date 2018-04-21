
<div class="componentheading">Bring Savings To Me</div>
<table class="blog" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top">
					<div>
		
<table class="contentpaneopen">




<tr>
<td valign="top" colspan="2">
<p>Bring Savings To Me is the first portal for all things saving money.  From Food, to Electronics, to Sales and Coupons, you can come to this one site and it will help you find the best savings possible.  Customers that use Bring Savings to Me save an average of $500 per year. </p>
<p>The concept is very simple.  How do you optimize the use of coupons, sale information, and web pricing when making purchasing decisions out on the street? You could go out on the Internet and research items one by one.  It would probably take you a day or so to do this.  With BSTM, it's much easier.  You just login and the software tells you the cheapest way to buy what you want.  It tells you if your product is on sale.  It tells you if there is a coupon available on the product you want. It brings the savings information to you in a useful way to save you time and ultimately money.</p>
<p>It's as easy as 123.  Create your shopping list, and let us research all the thousands of coupons and sales for you.  You can have them delivered to you at your PC, via Emails everyday, or to your Smartphone.  The choice is yours.</p></td>
</tr>



</table>
<span class="article_separator">&nbsp;</span>
		</div>
		</td>
</tr>


</table>
<div class="componentheading">Sample Savings</div>
<?php
    $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon c " .
"LEFT JOIN store ON c.store_id = store.store_id " .
"LEFT JOIN product ON c.product_id = product.product_id " . 
"LEFT JOIN vendor ON product.vendor_id = vendor.vendor_id WHERE datediff(end_date,curdate()) < 0 AND (user_id IS NULL OR user_id = 0) ORDER BY end_date");

     $htmlbody .= "<table class=contenttoc><tr><td class=sectiontableheader align=center><b>Coupon</b></td><td class=sectiontableheader align=center><b>Vendor/Brand</b></td><td class=sectiontableheader align=center><b>Discount</b></td><td class=sectiontableheader align=center><b>End Date</b></td></tr>\n";
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

        $htmlbody .= "<tr" . $bgcolor ."><td class=bstm_td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td class=bstm_td>" . $vendorBrand . "</td><td class=bstm_td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td><td class=bstm_td align=center>". sqlToUserDate($objects['end_date']) . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>";
     }
     $htmlbody .= "</table>";
     echo $htmlbody;
?>
