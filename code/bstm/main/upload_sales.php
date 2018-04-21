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
$cost_per_unit = $lineArray[4];
      $sql_data_array = array('creation_date' => 'now()',
'created_by' => 1,
'modification_date' => 'now()',
'modified_by' => 1,
'sale_line_item_name' => $lineArray[2],
'store_id' => 1,
'product_id' => 2,
'cost_per_unit' => $cost_per_unit,
'comments' => $lineArray[5]
);

     $objects_query = tep_db_query("SELECT * FROM sale_line_item WHERE (sale_line_item_name = '" . $lineArray[2] . "'" . (strlen($lineArray[5]) > 0?" OR sale_line_item_name = '" . $lineArray[5] . "'":"") . ")");
      if (mysql_num_rows($objects_query) == 0)
      {
         tep_db_perform('sale_line_item', $sql_data_array, 'insert', "sale_line_item_id = " . $_POST['sale_line_item_id']);
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

?>
