<div class="componentheading">Savings Dashboard</div>
<?php
     echo sqlQuery("SELECT coupon_name, amount FROM coupon, my_savings WHERE my_savings.coupon_id = coupon.coupon_id AND user_id = " . $user_id);
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 ORDER BY end_date");
     $htmlbody = "<B>Coupons Expiring Soon</B><p>\n";

     $htmlbody .= "<table width=100%>\n";
     $htmlbody .= "<tr><td align=right><a href=index.php?view=coupon&action=display_create_form>Add Coupon</a></td></tr>\n";
     $htmlbody .= "<tr>\n";
     $htmlbody .= "<td>\n";
     $htmlbody .= "<table width=100% border=1><tr><td align=center><b>Coupon</b></td><td align=center><b>Discount</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";

        $htmlbody .= "<tr" . $bgcolor ."><td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td><td align=center>". sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=4 align=center>NO RESULTS</td></tr>";
     }
     $htmlbody .= "</table>";
     $htmlbody .= "</td>";
     $htmlbody .= "</tr>";
     $htmlbody .= "</table>";

     $htmlbody .= "<br><br>";

     $rows = 0;
     $htmlbody .= "<B>Sales Ending Soon</B>";
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from sale WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) > 0 ORDER BY end_date");
     $htmlbody .= "<table width=100% border=1><tr><td align=center><b>Sale</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";

        $htmlbody .= "<tr" . $bgcolor . "><td align=center><a href=index.php?view=sale&action=display&sale_id=" . $objects['sale_id'] . ">" . $objects['sale_name'] . "</a></td><td align=center>" . sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=4 align=center>NO RESULTS</td></tr>\n";
     }
     $htmlbody .= "</table>\n";

     $htmlbody .= "<br><br>";
     $rows = 0;
     $htmlbody .= "<B>Deals Ending Soon</B>";
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from deal WHERE NOW() <= end_date AND begin_date <= NOW() ORDER BY end_date");
     $htmlbody .= "<table width=100%>\n";
     $htmlbody .= "<tr><td align=right><a href=index.php?view=deal&action=display_create_form>Add Deal</a></td></tr>\n";
     $htmlbody .= "<tr>\n";
     $htmlbody .= "<td>\n";
     $htmlbody .= "<table width=100% border=1><tr><td align=center><b>Deal</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $bgcolor = "";
        if ($objects['days_left'] <= 3)
           $bgcolor = " bgcolor=red";

        $htmlbody .= "<tr" . $bgcolor . "><td align=center><a href=index.php?view=deal&action=display&deal_id=" . $objects['deal_id'] . ">" . $objects['deal_name'] . "</a></td><td align=center>" . sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=3 align=center>NO RESULTS</td></tr>\n";
     }
     $htmlbody .= "</table>\n";
     $htmlbody .= "</td>\n";
     $htmlbody .= "</tr>\n";
     $htmlbody .= "</table>\n";
     $htmlbody .= "\n";

     echo $htmlbody;
?>

