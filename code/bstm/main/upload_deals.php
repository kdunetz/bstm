<?php
    require('configure.php');
    require('database.php');
    tep_db_connect();
    require('functions.php');
   $data = $_POST['upload_data'];
   $dataArray = explode("\n", $data);
   for ($i=0;$i<sizeof($dataArray);$i++)
   {
      $lineArray = explode("~", $dataArray[$i]);

      if (strlen(trim($lineArray[2])) < 5) continue; /* deal name is too short */
      if (strlen(trim($lineArray[1])) == 0) continue; /* location is empty */
      if (strpos(trim($lineArray[2]), " ") === false) continue; /* there is no space in the Deal Name...has to be at least 2 words or something like that */
      if (strpos(trim($lineArray[2]), "UTF-8") !== false) continue; 
      if (strpos(trim($lineArray[2]), "Purchase Confirmed") !== false) continue;  /* I got an email from Groupon confirming my purchase */

      print_r($lineArray);

      if ($lineArray[0] == 'Groupon') $source_id = 15;
      if ($lineArray[0] == 'Living Social') $source_id = 18;
      if ($lineArray[0] == 'AOL Wow') $source_id = 16;
      if ($lineArray[0] == 'Deal On') $source_id = 17;
      if ($lineArray[0] == 'Buy With Me') $source_id = 20;
      if ($lineArray[0] == 'TravelZoo') $source_id = 23;

      if ($lineArray[0] == 'Groupon')
      {
         $savingsAmount = calculateGrouponSavings($lineArray[5]);
      }
      
      if ($lineArray[0] == 'AOL Wow')
      {
          $savingsAmount = calculateAOLWowSavings($lineArray[5]);
      }
//"TravelZoo~" . $cityName . "~" . $title . "~" . $date . "~" . $datePlusOne . "~" . extractComment($content) . "~" . extractPercentSavings($content) . "~" . extractPrice($content) . "~" . extractOriginalPrice($content) . "~" . extractURL($content) . "\n";

if ($lineArray[0] == 'Buy With Me')
{
    $savingsAmount = calculateLivingSocialSavings($lineArray[6], $lineArray[7]);
}
if ($lineArray[0] == 'TravelZoo' || $lineArray[0] == 'Living Social')
{
    $savingsAmount = $lineArray[8] - $lineArray[7];
}

$originalAmount = 0;
if (sizeof($lineArray) > 8)
   $originalAmount = $lineArray[8];

$url = "";
if (sizeof($lineArray) > 9)
   $url = $lineArray[9];
//'deal_name' => (strlen($lineArray[3]) > 0?$lineArray[3]:$lineArray[1]),
      $sql_data_array = array('creation_date' => 'now()',
'created_by' => 1,
'modification_date' => 'now()',
'modified_by' => 1,
'deal_name' => $lineArray[2],
'begin_date' => $lineArray[3],
'end_date' => $lineArray[4],
'price' => $lineArray[7],
'savings_amount' => $savingsAmount,
'original_amount' => $originalAmount,
'source_id' => $source_id,
'cost_per_unit' => $cost_per_unit,
'location' => $lineArray[1], 
'comments' => $lineArray[5],
'url' => $url 
);

     $objects_query = tep_db_query("SELECT * FROM deal WHERE (deal_name = '" . $lineArray[2] . "'" . (strlen($lineArray[5]) > 0?" OR deal_name = '" . $lineArray[5] . "'":"") . ")");
      if (mysql_num_rows($objects_query) == 0)
      {
         tep_db_perform('deal', $sql_data_array, 'insert', "deal_id = " . $_POST['deal_id']);
      }
      else
      {
         if ($lineArray[0] == 'TravelZoo')
         {
            $objects = tep_db_fetch_array($objects_query);
            $sql_data_array = array('modification_date' => 'now()',
                                    'end_date' => 'now()',
                                    'modified_by' => 1);
            tep_db_perform('deal', $sql_data_array, 'update', "deal_id = " . $objects['deal_id']);
         }
      }
      
   }
   //print_r($dataArray);

function calculateGrouponSavings($string)
{
   if (strpos($string,"$") !== false)
   { 
      $discountedAmount = substr($string, strpos($string,"$") + 1); 
      if (strpos($string, "($") !== false)
      {
         $fullAmount = substr($discountedAmount, strpos($discountedAmount,"($") + 2); 
      }
      else
      {
         $fullAmount = substr($discountedAmount, strpos($discountedAmount," for $") + 6); 
      }
      $discountedAmount = substr($discountedAmount, 0, strpos($discountedAmount," "));
      $fullAmount = substr($fullAmount, 0, strpos($fullAmount," "));
/* only calculate the savings if I get two good amounts */
      if ($fullAmount > 0 && $discountedAmount > 0) 
         $savings = $fullAmount - $discountedAmount;
      else
         $savings = 0;

      return $savings;
   }
}
function calculateAOLWowSavings($string)
{
   return calculateGrouponSavings($string);
}
function calculateLivingSocialSavings($discount, $price)
{
   if (strpos($discount,"%") !== false)
   {
      $discount = substr($discount,0, strlen($discount) - 1);   
   }
   if ($discount > 0)
      return ($price * 100 / $discount) - $price;
   else
      return 0;
}
?>
