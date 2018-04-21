<?php
  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon WHERE datediff(end_date,curdate()) < 10 AND datediff(end_date,curdate()) > 0 ORDER BY end_date");
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
     echo $rows;

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
     $htmlbody .= "</html>\n";
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
     $htmlbody .= "</html>\n";
     echo $rows;
     echo $htmlbody;

$semi_rand = md5(time());
$mime_boundary = "==MULTIPART_BOUNDARY_$semi_rand";
$mime_boundary_header = chr(34) . $mime_boundary . chr(34);

$body = "hello there

--$mime_boundary
Content-Type: text/plain; charset=us-ascii
Content-Transfer-Encoding: 7bit

$textbody

--$mime_boundary
Content-Type: text/html; charset=us-ascii
Content-Transfer-Encoding: 7bit

$htmlbody

--$mime_boundary--";

     $to = "kevindunetz@gmail.com";
     $subject = "Coupons/sales are expiring/ending soon";
     $headers = "MIME-Version: 1.0" . "\r\n"; 
  //   $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
     $headers .= "Content-type: multipart/alternative; boundary=" . $mime_boundary_header . "\r\n";
     $headers .= 'From: admin@bringsavingstome.com' . "\r\n";

   
     if (mail($to, $subject, $body, $headers)) {
        echo("<p>Message successfully sent!</p>");
      } 
      else {
        echo("<p>Message delivery failed...</p>");
     }
?>
