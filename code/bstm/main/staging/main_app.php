<div class="componentheading">Savings Dashboard
<?php
global $totalSavings;
$htmlbody = savingsDashboard($user_id);
echo " (Savings = $" . $totalSavings . ")\n";
echo "</div>\n";
     echo $htmlbody;
?>
