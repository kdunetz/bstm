<?php
global $totalSavings, $user_id;
if ($_GET['action'] == 'cash_out')
{
   echo "<div class=\"componentheading\">Cash Out</div>\n";
   echo "Push this button to send an email to close out these savings";
   echo "<a class=\"button\" href=index.php?view=savings_dashboard&action=send_email><span>Send Email</span></a><br>\n";
   return;
}
if ($_GET['action'] == 'send_email')
{
   $htmlBody = sqlQuery("SELECT date_format(my_savings.creation_date,'%m/%Y') as 'Date', coupon.coupon_name as 'Coupon', SUM(savings) as 'Savings' FROM coupon, my_savings WHERE my_savings.coupon_id = coupon.coupon_id AND my_savings.user_id = " . $user_id . " GROUP BY date_format(my_savings.creation_date,'%m/%Y')");
   sendEmail("admin@bringsavingstome.com", "kevindunetz@gmail.com", "Cash Out Time!!", "Please pay out for the following coupons",  $htmlBody);
   echo "<div class=\"componentheading\">Email Sent</div>\n";
   echo "Your email has been sent and the redeemed coupons have been closed out";
   return;
}
echo "<div class=\"componentheading\">Savings Dashboard\n";
echo " (Savings = $" . $totalSavings . ")\n";
echo "</div>\n";
     echo "<h4>My Redeemed Savings</h4>";
     //echo sqlQuery("SELECT date_format(my_savings.creation_date,'%m/%d/%Y') as 'Date', coupon_name as 'Coupon', concat('$', savings) as 'Savings' FROM coupon, my_savings WHERE my_savings.coupon_id = coupon.coupon_id AND my_savings.user_id = " . $user_id);
     echo "<a class=\"button\" href=index.php?view=savings_dashboard&action=cash_out><span>Cash Out</span></a><br>\n";
     echo sqlQuery("SELECT date_format(my_savings.creation_date,'%m/%Y') as 'Date', coupon.coupon_name as 'Coupon', SUM(savings) as 'Savings' FROM coupon, my_savings WHERE my_savings.coupon_id = coupon.coupon_id AND my_savings.user_id = " . $user_id . " GROUP BY date_format(my_savings.creation_date,'%m/%Y')");

     $htmlbody = savingsDashboard($user_id);
     echo $htmlbody;
?>
