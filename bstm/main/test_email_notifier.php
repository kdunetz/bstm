<?php
  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

$users_query = tep_db_query("select * from user");
global $user_id;
//while ($users = tep_db_fetch_array($users_query)) 
{
$users['user_id'] = 1;
$users['email'] = 'kevindunetz@gmail.com';
//$users['user_id'] = 42;
//$users['email'] = 'bryant.dunetz@side-out.org';
//$users['email2'] = 'kevindunetz@gmail.com';

      $user_id = $users['user_id'];

        $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product, vendor, shopping_list WHERE coupon.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND coupon.product_id = shopping_list.product_id AND product.product_name != 'Any' AND shopping_list.user_id = " . $user_id . " AND datediff(end_date,curdate()) >= 0 AND (coupon.user_id = " . $user_id . " OR coupon.user_id IS NULL OR coupon.user_id = 0) ORDER BY end_date");
        $htmlbody = "<html><table border=1><tr><td><b>Coupon Name</b></td><td><b>Discount</b></td><td><b>End Date</b></td><td><b>Days Left</b></td></tr>\n";
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
   
        $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon WHERE NOW() <= end_date AND begin_date <= NOW() ORDER BY end_date");
        $htmlbody = "<html><table border=1><tr><td><b>Coupon Name</b></td><td><b>Discount</b></td><td><b>End Date</b></td><td><b>Days Left</b></td></tr>\n";
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
        $htmlbody .= "</html>\n";

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
        $htmlbody .= "</html>\n";

$htmlbody = savingsDashboard($user_id);

   $semi_rand = md5(time());
   $mime_boundary = "==MULTIPART_BOUNDARY_$semi_rand";
   $mime_boundary_header = chr(34) . $mime_boundary . chr(34);
   
$body = "not sure why this is here

--$mime_boundary
Content-Type: text/plain; charset=us-ascii
Content-Transfer-Encoding: 7bit

$textbody

--$mime_boundary
Content-Type: text/html; charset=us-ascii
Content-Transfer-Encoding: 7bit

$htmlbody

--$mime_boundary--";

     $to = $users['email'];
     if (isset($users['email2'])) $to .= "," . $users['email2'];
     $subject = "Coupons/sales are expiring/ending soon";
     $headers = "MIME-Version: 1.0" . "\r\n"; 
  //   $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
     $headers .= "Content-type: multipart/alternative; boundary=" . $mime_boundary_header . "\r\n";
     $headers .= 'From: admin@bringsavingstome.com' . "\r\n";

   
     if (mail($to, $subject, $body, $headers)) {
        echo("<p>Message successfully sent to "  . $to . "</p>");
      } 
      else {
        echo("<p>Message delivery failed..." . $to . "</p>");
     }
}
?>
