<?php
    require('configure.php');
    require('database.php');
    tep_db_connect();
    require('functions.php');

    $select_query = tep_db_query("SELECT sale.*, datediff(sale.end_date,sale.begin_date) as day_diff, store.store_name FROM sale, store WHERE sale.store_id = store.store_id AND datediff(sale.end_date,curdate()) = 0"); /* -1 is yesterday, -2 is 2 days ago */
    while ($select = tep_db_fetch_array($select_query))
    {
       //echo print_r($select);
       $rows++;
       if ($select['day_diff'] == 6) /* 6 is really a week */
       {
          $begin_date = add_date($select['begin_date'], 7);
          $end_date = add_date($select['end_date'], 7);
          $sale_name = $select['store_name'] . " Sale " . sqlToUserDate($begin_date) . " - " . sqlToUserDate($end_date);
          $sql_data_array = array('creation_date' => 'now()',
                                  'created_by' => 1,
                                  'modification_date' => 'now()',
                                  'modified_by' => 1,
                                  'sale_name' => $sale_name,
                                  'store_id' => $select['store_id'],
                                  'begin_date' => $begin_date,
                                  'end_date' => $end_date,
                                  'comments' => $_POST['comments']);
          echo print_r($sql_data_array);
          tep_db_perform('sale', $sql_data_array, 'insert', "sale_id = " . $_POST['sale_id']);
       }

    }
?>
