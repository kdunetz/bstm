<?php
require('configure.php');
require('database.php');
tep_db_connect();
require('functions.php');
require('../common/functions2.php');

print_r($_POST);

         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $POST['created_by'], 
'modification_date' => 'now()',
'modified_by' => $_POST['created_by'],
'product_best_price_name' => $_POST['product_best_price_name'],
'product_id' => $_POST['product_id'],
'store_id' => $_POST['store_id'],
'other_store_name' => $_POST['other_store_name'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'price_date' => 'now()',
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'location' => $_POST['location'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product_best_price', $sql_data_array, 'insert', "product_best_price_id = " . $_POST['product_best_price_id']);
$id = tep_db_insert_id();
echo "Record created for id = " . $id . "<br>";

$target_path = "../common/attachments/product_best_price/" . $id . "/";

mkdir (getcwd() . "/" . $target_path);

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{
    echo "The file ".  basename( $_FILES['uploadedfile']['name']) . " has been uploaded";
} 
else 
{
    echo "There was an error uploading the file, please try again!";
}

?>
