<div class="componentheading">Sale Line Item</div>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM sale_line_item WHERE sale_line_item_id = " . $_GET['sale_line_item_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE sale_line_item SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE sale_line_item_id = " . $_GET['sale_line_item_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['sale_line_item_name'])) {
   $messageStack->add('Sale Line Item Name is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['price'])) {
   $messageStack->add('Price is required');
}
if (empty($_POST['price_units'])) {
   $messageStack->add('Price Units is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

/*
     $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => tep_encrypt_password($password));

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
*/
$sql_data_array = array('modification_date' => 'now()',
'modified_by' => $user_id,
'sale_line_item_name' => $_POST['sale_line_item_name'],
'product_id' => $_POST['product_id'],
'discount' => $_POST['discount'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'savings_amount' => $_POST['savings_amount'],
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'special_promotion' => $_POST['special_promotion'],
'_limit' => $_POST['_limit'],
'quantity' => $_POST['quantity'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view' && $key != 'tool')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('sale_line_item', $sql_data_array, 'update', "sale_line_item_id = " . $_POST['sale_line_item_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      $_GET['action'] = 'display';
      $_GET['sale_line_item_id'] = $_POST['sale_line_item_id'];
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['sale_line_item_name'])) {
   $messageStack->add('Sale Line Item Name is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['price'])) {
   $messageStack->add('Price is required');
}
if (empty($_POST['price_units'])) {
   $messageStack->add('Price Units is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from sale_line_item WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'sale_line_item_name' => $_POST['sale_line_item_name'],
'product_id' => $_POST['product_id'],
'discount' => $_POST['discount'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'savings_amount' => $_POST['savings_amount'],
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'special_promotion' => $_POST['special_promotion'],
'_limit' => $_POST['_limit'],
'quantity' => $_POST['quantity'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view' && $key != 'tool')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('sale_line_item', $sql_data_array, 'insert', "sale_line_item_id = " . $_POST['sale_line_item_id']);
$_GET['action'] = 'display';
$_GET['sale_line_item_id'] = tep_db_insert_id();

      }
      else
      {
         $messageStack->add('This record has already been loaded'); 
         if ($messageStack->size > 0) { echo $messageStack->output(); return; }
      }
      //tep_redirect(tep_href_link('login.php', '', 'SSL'));
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=sale_line_item.php?action=delete_confirm&sale_line_item_id=" . $_GET['sale_line_item_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=sale_line_item.php>No</a>";
     }
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
     printAddThisButton();
/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT sale_line_item.*, sale.end_date, store.store_name, product.product_name FROM sale, store, sale_line_item, product WHERE sale_line_item.sale_id = sale.sale_id AND sale.store_id = store.store_id AND sale_line_item.product_id = product.product_id AND sale_line_item.sale_line_item_id = " . $_GET['sale_line_item_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by'] = $user['user_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by'] = $user['user_name'];
     }
     echo "<div id=\"content\">";
     if (tep_session_is_registered('user_id'))
     {
        if ($role == 'admin' || $objects['user_id'] == $user_id)
        {
echo "<div id=buttonspacer></div>\n";
           echo "<a class=button href=index.php?view=admin&tool=sale_line_item&action=display_edit_form&sale_line_item_id=" . $objects['sale_line_item_id'] . "><span>Edit</span></a>\n";
           echo "<a class=button href=index.php?view=admin&tool=sale&action=display&sale_id=" . $objects['sale_id'] . "><span>Goto Sale</span></a>\n";
           echo "<a class=button href=index.php?view=admin&tool=sale_line_item&action=display_create_form&sale_id=" . $objects['sale_id'] . "><span>Create Another Line Item</span></a>\n";
        }
     }
echo "<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Store Name</td>
  <td class=bstm_td>" . $objects['store_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Sale End Date</td>
  <td class=bstm_td>" . sqlToUserDate($objects['end_date'])  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Sale Line Item Name</td>
  <td class=bstm_td>" . $objects['sale_line_item_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Product Name</td>
  <td class=bstm_td><a href=index.php?action=display&view=product&product_id=" . $objects['product_id'] . ">" . $objects['product_name']  . "</a></td>
</tr>
<tr>
  <td class=sectiontableheader>Price</td>
  <td class=bstm_td>" .  displayField($objects['price'],"NUMBER","$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price Units</td>
  <td class=bstm_td>" .  $objects['price_units']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Savings Amount</td>
  <td class=bstm_td>" . displayField($objects['savings_amount'],"NUMBER","$###,###.00")  ."</td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit</td>
  <td class=bstm_td>" .  displayField($objects['cost_per_unit'],"NUMBER","$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>CPU Units</td>
  <td class=bstm_td>" .  $objects['cost_per_unit_units'] . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Special Promotion</td>
  <td class=bstm_td>" .  $objects['special_promotion']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Limit</td>
  <td class=bstm_td>" .  $objects['_limit']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Quantity</td>
  <td class=bstm_td>" .  $objects['quantity']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments</td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>
</tr>\n";
if (false)
{
echo "<tr>
  <td>Created By</td><td>" .  $objects['created_by'] . "</td></tr>
<tr>
  <td>Creation Date</td><td>" .  sqlToUserDate($objects['creation_date']) . "</td></tr>
<tr>
  <td>Modified By</td><td>" .  $objects['modified_by'] . "</td></tr>
<tr>
  <td>Modification Date</td><td>" .  sqlToUserDate($objects['modification_date']) . "</td></tr>\n";
}
echo "</table>

     </div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"index.php?view=admin&tool=sale_line_item\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "
<table class=contenttoc width=100%>
<tr>
  <td class=sectiontableheader>Sale Line Item Name: *</td>
  <td class=bstm_td><input name=sale_line_item_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Product Name: *</td>
  <td class=bstm_td>\n";
     createProductSelect($objects['product_id']);
/*
<select name=product_id>
  <option>";
$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;

   if (strpos($select['value'], "Any ") !== false) * KAD added to take off the any to make it easier to search *
   {
      $select['value'] = substr($select['value'], 4);
   }

   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
*/
echo "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price: *</td>
  <td class=bstm_td><input name=price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Price Units: *</td>
  <td class=bstm_td>
<select name=price_units>
  <option>";
echo "
  <option value=\"Pound\""; if ($objects['price_units'] == 'Pound') echo " SELECTED";echo ">Pound
  <option value=\"Each\""; if ($objects['price_units'] == 'Each') echo " SELECTED";echo ">Each
";
echo "</select>
</td>
</tr>
<tr>  
  <td class=sectiontableheader>Savings Amount:</td>
  <td class=bstm_td><input name=savings_amount value=\"" . '' . "\"></td></tr>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit:</td>
  <td class=bstm_td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>CPU Units:</td>
  <td class=bstm_td><input name=cost_per_unit_units value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Special Promotion:</td>
  <td class=bstm_td>
<textarea name=special_promotion>" . $objects['special_promotion'] . "</textarea></td>
</tr>
<tr>
  <td class=sectiontableheader>Limit:</td>
  <td class=bstm_td>
<select name=_limit>
  <option>";
echo "
  <option value=\"1\""; if ($objects['_limit'] == '1') echo " SELECTED";echo ">1
  <option value=\"2\""; if ($objects['_limit'] == '2') echo " SELECTED";echo ">2
  <option value=\"3\""; if ($objects['_limit'] == '3') echo " SELECTED";echo ">3
  <option value=\"4\""; if ($objects['_limit'] == '4') echo " SELECTED";echo ">4
  <option value=\"5\""; if ($objects['_limit'] == '5') echo " SELECTED";echo ">5
  <option value=\"6\""; if ($objects['_limit'] == '6') echo " SELECTED";echo ">6
  <option value=\"7\""; if ($objects['_limit'] == '7') echo " SELECTED";echo ">7
  <option value=\"8\""; if ($objects['_limit'] == '8') echo " SELECTED";echo ">8
  <option value=\"9\""; if ($objects['_limit'] == '9') echo " SELECTED";echo ">9
  <option value=\"10\""; if ($objects['_limit'] == '10') echo " SELECTED";echo ">10
  <option value=\"20\""; if ($objects['_limit'] == '20') echo " SELECTED";echo ">10
";
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Quantity:</td>
  <td class=bstm_td>
<select name=quantity>
  <option>";
echo "
  <option value=\"1\""; if ($objects['quantity'] == '1') echo " SELECTED";echo ">1
  <option value=\"2\""; if ($objects['quantity'] == '2') echo " SELECTED";echo ">2
  <option value=\"3\""; if ($objects['quantity'] == '3') echo " SELECTED";echo ">3
  <option value=\"4\""; if ($objects['quantity'] == '4') echo " SELECTED";echo ">4
  <option value=\"5\""; if ($objects['quantity'] == '5') echo " SELECTED";echo ">5
  <option value=\"6\""; if ($objects['quantity'] == '6') echo " SELECTED";echo ">6
  <option value=\"7\""; if ($objects['quantity'] == '7') echo " SELECTED";echo ">7
  <option value=\"8\""; if ($objects['quantity'] == '8') echo " SELECTED";echo ">8
  <option value=\"9\""; if ($objects['quantity'] == '9') echo " SELECTED";echo ">9
  <option value=\"10\""; if ($objects['quantity'] == '10') echo " SELECTED";echo ">10
  <option value=\"20\""; if ($objects['quantity'] == '20') echo " SELECTED";echo ">20
";
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>
<textarea name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from sale_line_item WHERE sale_line_item_id = " . $_GET['sale_line_item_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=sale_line_item\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view' && $key != 'redirect_url')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "
<table class=contenttoc width=100%>
<tr>
  <td class=sectiontableheader>Sale Line Item Name: *</td>
  <td class=bstm_td><input name=sale_line_item_name value=\"" . $objects['sale_line_item_name'] . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Product Name: *</td>
  <td class=bstm_td>\n";
     createProductSelect($objects['product_id']);
/*
<select name=product_id>
  <option>";
$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
*/
echo "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price: *</td>
  <td class=bstm_td><input name=price value=\"" . $objects['price'] . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Price Units: *</td>
  <td class=bstm_td>
<select name=price_units>
  <option>";
echo "
  <option value=\"Pound\""; if ($objects['price_units'] == 'Pound') echo " SELECTED";echo ">Pound
  <option value=\"Each\""; if ($objects['price_units'] == 'Each') echo " SELECTED";echo ">Each
";
echo "</select>
</td>
</tr>
<tr>  
  <td class=sectiontableheader>Savings Amount:</td>
  <td class=bstm_td><input name=savings_amount value=\"" . $objects['savings_amount'] . "\"></td></tr>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit:</td>
  <td class=bstm_td><input name=cost_per_unit value=\"" . $objects['cost_per_unit'] . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>CPU Units:</td>
  <td class=bstm_td><input name=cost_per_unit_units value=\"" . $objects['cost_per_unit_units'] . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Special Promotion:</td>
  <td class=bstm_td>
<textarea name=special_promotion>" . $objects['special_promotion'] . "</textarea></td>
</tr>
<tr>
  <td class=sectiontableheader>Limit:</td>
  <td class=bstm_td>
<select name=_limit>
  <option>";
echo "
  <option value=\"1\""; if ($objects['_limit'] == '1') echo " SELECTED";echo ">1
  <option value=\"2\""; if ($objects['_limit'] == '2') echo " SELECTED";echo ">2
  <option value=\"3\""; if ($objects['_limit'] == '3') echo " SELECTED";echo ">3
  <option value=\"4\""; if ($objects['_limit'] == '4') echo " SELECTED";echo ">4
  <option value=\"5\""; if ($objects['_limit'] == '5') echo " SELECTED";echo ">5
  <option value=\"6\""; if ($objects['_limit'] == '6') echo " SELECTED";echo ">6
  <option value=\"7\""; if ($objects['_limit'] == '7') echo " SELECTED";echo ">7
  <option value=\"8\""; if ($objects['_limit'] == '8') echo " SELECTED";echo ">8
  <option value=\"9\""; if ($objects['_limit'] == '9') echo " SELECTED";echo ">9
  <option value=\"10\""; if ($objects['_limit'] == '10') echo " SELECTED";echo ">10
  <option value=\"20\""; if ($objects['_limit'] == '20') echo " SELECTED";echo ">20
";
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Quantity:</td>
  <td class=bstm_td>
<select name=quantity>
  <option>";
echo "
  <option value=\"1\""; if ($objects['quantity'] == '1') echo " SELECTED";echo ">1
  <option value=\"2\""; if ($objects['quantity'] == '2') echo " SELECTED";echo ">2
  <option value=\"3\""; if ($objects['quantity'] == '3') echo " SELECTED";echo ">3
  <option value=\"4\""; if ($objects['quantity'] == '4') echo " SELECTED";echo ">4
  <option value=\"5\""; if ($objects['quantity'] == '5') echo " SELECTED";echo ">5
  <option value=\"6\""; if ($objects['quantity'] == '6') echo " SELECTED";echo ">6
  <option value=\"7\""; if ($objects['quantity'] == '7') echo " SELECTED";echo ">7
  <option value=\"8\""; if ($objects['quantity'] == '8') echo " SELECTED";echo ">8
  <option value=\"9\""; if ($objects['quantity'] == '9') echo " SELECTED";echo ">9
  <option value=\"10\""; if ($objects['quantity'] == '10') echo " SELECTED";echo ">10
  <option value=\"20\""; if ($objects['quantity'] == '20') echo " SELECTED";echo ">20
";
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>
<textarea name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }

  $rows = 0;
  echo "<a href=sale_line_item.php?action=display_create_form>Add Sale Line Item</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Product Name</b></td><td align=center><b>Price</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT sale_line_item_id as id, product.product_name, sale_line_item.* FROM sale_line_item, product WHERE product.product_id = sale_line_item.product_id");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['sale_line_item_id'] . "\"></a><td><a href=sale_line_item.php?action=delete&sale_line_item_id=" . $objects['sale_line_item_id'] . ">Delete</a><br><a href=sale_line_item.php?action=display_edit_form&sale_line_item_id=" . $objects['sale_line_item_id'] . ">Edit</a>";
echo "</td>  <td><a href=sale_line_item.php?action=display&sale_line_item_id=" . $objects['sale_line_item_id'] . ">" . displayField($objects['sale_line_item_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td align=right>" . displayField($objects['price'],'NUMBER','$###,###.00') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}

?>
