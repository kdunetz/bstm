<?php
  if ($_GET['tool'] == 'sql')
  {
     include "sql.php";
     return;
  }
  if ($_GET['tool'] == 'sale')
  {
     if (!isset($_GET['sale_id']) && $_GET['action'] != 'display_create_form')
        $_GET['action'] = "list";
     include "sale.php";
     return;
  }
  if ($_GET['tool'] == 'sale_line_item')
  {
     if (!isset($_GET['sale_line_item_id']) && $_GET['action'] != 'display_create_form')
        $_GET['action'] = "list";
     include "sale_line_item.php";
     return;
  }
// initialize the message stack for output messages

  echo "<div id=\"content\">";
  echo "<div class=\"componentheading\">Admin</div>\n";
  //ec ho "<a href=index.php?action=display&view=admin&tool=sql>1) SQL Tool</a><br>\n";
  echo "<font size=3>\n";
  echo "<a href=http://www.bringsavingstome.com/bstm/main/index.php?view=request_catalog_update&category=product> Request New Product</a><p><p>\n";

  $objects_query = tep_db_query("SELECT subcategory, value FROM reference WHERE category = 'Object' ORDER BY subcategory");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     //if ($objects['value'] != 'Sale Line Item' && $objects['value'] != 'Property' && $objects['value'] != 'Report' && $objects['value'] != 'Receipt Line Item' && $objects['value'] != 'Customer')
     if ($objects['value'] == 'Sale')
     {
        $rows = 0;
        echo "<a href=index.php?action=display&view=admin&tool=" . str_replace(' ', '_', strtolower($objects['value'])) . ">Add/Edit/Delete " . $objects['value']  . "s</a>\n";
        echo "<br>";
     }
  }
  echo "</div> <!- content ->";

?>
