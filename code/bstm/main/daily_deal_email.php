<?php
  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

$users_query = tep_db_query("select * from user where email = 'kevindunetz@gmail.com'");
global $user_id, $totalSavings;
while ($users = tep_db_fetch_array($users_query)) 
{
      $user_id = $users['user_id'];
      registerUserGlobalParameters($users['email']);

$htmlbody = dailyDeals($user_id);

   $semi_rand = md5(time());
   $mime_boundary = "==MULTIPART_BOUNDARY_$semi_rand";
   $mime_boundary_header = chr(34) . $mime_boundary . chr(34);
   
$body = "test

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
     $subject = "Daily Deals For Today - Save Up To $" . displayField($totalSavings, "NUMBER", "###,###.00");
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
