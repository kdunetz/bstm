<div class="componentheading">Savings Dashboard</div>
<?php

     //$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon ORDER BY end_date");
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) >= 0 ORDER BY end_date");
     //$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon WHERE NOW() <= end_date AND begin_date <= NOW() ORDER BY end_date");
     $htmlbody = "<B>Coupons Expiring Soon</B>\n";
     $htmlbody .= "<a href=index.php?view=coupon&action=display_create_form>Add Coupon</a>";
     $htmlbody .= "<table border=1><tr><td align=center><b>Coupon</b></td><td align=center><b>Discount</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     $textbody = "Coupon\t\tDiscount\t\tEnd Date\t\tDays Left\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $htmlbody .= "<tr><td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td align=center>" . $objects['discount'] . "</td><td align=center>". sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
        $textbody .= $objects['coupon_name'] . "\t\t" . $objects['discount'] . "\t\t". sqlToUserDate($objects['end_date']) . "\t\t" . $objects['days_left'] . "\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=4 align=center>NO RESULTS</td></tr>";
         $textbody .= "NO RESULTS";
     }
     $htmlbody .= "</table>";

     $htmlbody .= "<br><br>";
     $textbody .= "\n\n";

/*
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon WHERE NOW() <= end_date AND begin_date <= NOW() ORDER BY end_date");
     $htmlbody .= "<table border=1><tr><td><b>Coupon Name</b></td><td><b>Discount</b></td><td><b>End Date</b></td><td><b>Days Left</b></td></tr>\n";
     $textbody = "Coupon Name\t\tDiscount\t\tEnd Date\t\tDays Left\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $htmlbody .= "<tr><td>" . $objects['coupon_name'] . "</td><td>" . $objects['discount'] . "</td><td>". sqlToUserDate($objects['end_date']) . "</td><td>" . $objects['days_left'] . "</td></tr>\n";
        $textbody .= $objects['coupon_name'] . "\t\t" . $objects['discount'] . "\t\t". sqlToUserDate($objects['end_date']) . "\t\t" . $objects['days_left'] . "\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=4 align=center>NO RESULTS</td></tr>";
         $textbody .= "NO RESULTS";
     }
     $htmlbody .= "</table>";
     $htmlbody .= "<br><br>";
     $textbody .= "\n\n";
*/

     $rows = 0;
     $htmlbody .= "<B>Sales Ending Soon</B>";
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from sale WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) > 0 ORDER BY end_date");
     $htmlbody .= "<table border=1><tr><td align=center><b>Sale</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     $textbody .= "Sale\t\tEnd Date\t\tDays Left\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $htmlbody .= "<tr><td align=center><a href=index.php?view=sale&action=display&sale_id=" . $objects['sale_id'] . ">" . $objects['sale_name'] . "</a></td><td align=center>" . sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
        $textbody .= $objects['sale_name'] . "\t\t" . sqlToUserDate($objects['end_date']) . "\t" . $objects['days_left'] . "\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=3 align=center>NO RESULTS</td></tr>\n";
         $textbody .= "NO RESULTS>\n";
     }
     $htmlbody .= "</table>\n";

     $htmlbody .= "<br><br>";
     $textbody .= "\n\n";
     $rows = 0;
     $htmlbody .= "<B>Deals Ending Soon</B>";
     $htmlbody .= "<a href=index.php?view=deal&action=display_create_form>Add Deal</a>";
     //$objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from deal WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) > 0 ORDER BY end_date");
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from deal WHERE NOW() <= end_date AND begin_date <= NOW() ORDER BY end_date");
     $htmlbody .= "<table border=1><tr><td align=center><b>Deal</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     $textbody .= "Deal\t\tEnd Date\t\tDays Left\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $htmlbody .= "<tr><td align=center><a href=index.php?view=deal&action=display&deal_id=" . $objects['deal_id'] . ">" . $objects['deal_name'] . "</a></td><td align=center>" . sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
        $textbody .= $objects['deal_name'] . "\t\t" . sqlToUserDate($objects['end_date']) . "\t" . $objects['days_left'] . "\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=3 align=center>NO RESULTS</td></tr>\n";
         $textbody .= "NO RESULTS>\n";
     }
     $htmlbody .= "</table>\n";
     $htmlbody .= "\n";
/*
     echo $rows;
     $rows = 0;
     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from sale WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) > 0 ORDER BY end_date");
     $htmlbody .= "<table border=1><tr><td><b>Sale</b></td><td><b>End Date</b></td><td><b>Days Left</b></td></tr>\n";
     $textbody .= "Sale\t\tEnd Date\t\tDays Left\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $htmlbody .= "<tr><td>" . $objects['sale_name'] . "</td><td>" . sqlToUserDate($objects['end_date']) . "</td><td>" . $objects['days_left'] . "</td></tr>\n";
        $textbody .= $objects['sale_name'] . "\t\t" . sqlToUserDate($objects['end_date']) . "\t" . $objects['days_left'] . "\n";
     }
     if ($rows == 0)
     {
         $htmlbody .= "<tr><td colspan=3 align=center>NO RESULTS</td></tr>\n";
         $textbody .= "NO RESULTS>\n";
     }
     $htmlbody .= "</table>\n";
*/
     echo $htmlbody;
?>

