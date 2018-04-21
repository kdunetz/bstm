<?php
  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

$users_query = tep_db_query("select * from user where email ='kevindunetz@gmail.com'");
global $user_id;
while ($users = tep_db_fetch_array($users_query)) 
{
      $user_id = $users['user_id'];

        $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product, vendor, shopping_list WHERE coupon.product_id = product.product_id AND product.vendor_id = vendor.vendor_id AND coupon.product_id = shopping_list.product_id AND product.product_name != 'Any' AND shopping_list.user_id = " . $user_id . " AND datediff(end_date,curdate()) >= 0 AND (coupon.user_id = " . $user_id . " OR coupon.user_id IS NULL OR coupon.user_id = 0) ORDER BY end_date");

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
