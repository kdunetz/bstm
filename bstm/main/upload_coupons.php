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
      print_r($lineArray);
if ($lineArray[0] == 'Coupon Mountain') 
{
   $source_id = 26;
   $delivery_mechanism = 10;
}

if ($lineArray[0] == 'Smart Source') 
{
   $source_id = 8;
   $delivery_mechanism = 6;
}

if ($lineArray[0] == 'Coupons Com') 
{
   $source_id = 12;
   $delivery_mechanism = 6;
}

if (!isset($lineArray[2])) continue;

$storeName = trim($lineArray[6]);
$url = trim($lineArray[7]);
$discAmt = trim($lineArray[8]);
$discUnits = trim($lineArray[9]);
$discType = trim($lineArray[10]);

$store_id =  "";
$objects_query = tep_db_query("SELECT * FROM store WHERE store_name = '" . $storeName . "'");
if (mysql_num_rows($objects_query) > 0)
{
   $objects = tep_db_fetch_array($objects_query);
   $store_id = $objects['store_id'];
   $url = $objects['website'];
}
else
{
   $objects_query = tep_db_query("SELECT * FROM vendor WHERE vendor_name = '" . $storeName . "'");
   $objects = tep_db_fetch_array($objects_query);
   if (mysql_num_rows($objects_query) > 0)
   {
      $vendor_id = $objects['vendor_id'];
      $url = $objects['website'];
   }
}

$originalAmount = 0;
//'deal_name' => (strlen($lineArray[3]) > 0?$lineArray[3]:$lineArray[1]),
      $sql_data_array = array('creation_date' => 'now()',
'created_by' => 1,
'modification_date' => 'now()',
'date_received' => 'now()',
'modified_by' => 1,
'coupon_name' => $lineArray[2],
'begin_date' => $lineArray[3],
'end_date' => $lineArray[4],
'source_id' => $source_id,
'delivery_mechanism_id' => $delivery_mechanism,
'product_id' => 95, 
'comments' => $lineArray[5],
'store_id' => $store_id,
'discount' => $discAmt,
'discount_units' => $discUnits,
'discount_type' => $discType,
'url' => $url 
);

      $sqlCommand = "SELECT * FROM coupon WHERE (coupon_name = '" . $lineArray[2] . "'" . (strlen($lineArray[5]) > 0?" OR coupon_name = '" . $lineArray[5] . "'":"") . ")";
//echo $sqlCommand;
      $objects_query = tep_db_query($sqlCommand);
      if (mysql_num_rows($objects_query) == 0)
      {
         tep_db_perform('coupon', $sql_data_array, 'insert', "coupon_id = " . $_POST['coupon_id']);
      }
      else
      {
         if ($lineArray[0] == 'TravelZoo')
         {
            $objects = tep_db_fetch_array($objects_query);
            $sql_data_array = array('modification_date' => 'now()',
                                    'end_date' => 'now()',
                                    'modified_by' => 1);
            tep_db_perform('coupon', $sql_data_array, 'update', "coupon_id = " . $objects['coupon_id']);
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
