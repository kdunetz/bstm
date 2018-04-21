<div class="componentheading">Shopping List</div>
<?php

/*
  if (!tep_session_is_registered('user_id')) {
    //$navigation->set_snapshot();
    tep_redirect(tep_href_link('index.php?tab=3', '', 'SSL'));
  }
*/

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM shopping_list WHERE shopping_list_id = " . $_GET['shopping_list_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE shopping_list SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE shopping_list_id = " . $_GET['shopping_list_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

$display = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
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
'product_id' => $_POST['product_id'],
'other_product_name' => $_POST['other_product_name'],
'status' => $_POST['status'],
'purchase_frequency' => $_POST['purchase_frequency'],
'purchase_frequency_units' => $_POST['purchase_frequency_units'],
'desired_price' => $_POST['desired_price'],
'price_units' => $_POST['price_units'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('shopping_list', $sql_data_array, 'update', "shopping_list_id = " . $_POST['shopping_list_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      // KAD tep_redirect(tep_href_link('index.php?view=shopping_list&action=display&shopping_list_id=' . $_POST['shopping_list_id'],'','SSL'));
      $display= "true";
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from shopping_list WHERE product_id = " . $_POST['product_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'product_id' => $_POST['product_id'],
'other_product_name' => $_POST['other_product_name'],
'status' => $_POST['status'],
'purchase_frequency' => $_POST['purchase_frequency'],
'purchase_frequency_units' => $_POST['purchase_frequency_units'],
'desired_price' => $_POST['desired_price'],
'price_units' => $_POST['price_units'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('shopping_list', $sql_data_array, 'insert', "shopping_list_id = " . $_POST['shopping_list_id']);

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
     echo "Please confirm you would like to delete this Shopping List Item<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=index.php?view=shopping_list&action=delete_confirm&shopping_list_id=" . $_GET['shopping_list_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=index.php&view=shopping_list>No</a>";
     }
     return;
  }
  if ((isset($_GET['action']) && ($_GET['action'] == 'display')) || $display == "true") 
  {
/* KAD leave off the ending quotes because it is an equation on the end */
if (!isset($_GET['shopping_list_id']) && isset($_POST['shopping_list_id']))
   $_GET['shopping_list_id'] = $_POST['shopping_list_id'];
     $objects_query = tep_db_query("SELECT shopping_list.*,user.user_name,product.product_name FROM shopping_list,user,product WHERE shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.shopping_list_id = " . $_GET['shopping_list_id']);
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
     echo "<div id=\"content\">
<a href=index.php?view=shopping_list&action=list>Back to Shopping List</a> |
<a href=index.php?view=shopping_list&action=display_edit_form&shopping_list_id=" . $objects['shopping_list_id'] . ">Edit</a><table width=100% border=1>
<tr>
  <td>Product Name: *</td>
  <td>" .  $objects['product_name']  . "</td>
</tr>
<tr>
  <td>Other Product Name:</td>
  <td>" .  $objects['other_product_name']  . "</td>
</tr>
<tr>
  <td>Status:</td>
  <td>" .  $objects['status']  . "</td>
</tr>
<tr>
  <td>Frequency:</td>
  <td>" .  $objects['purchase_frequency']  . "</td>
</tr>
<tr>
  <td>Frequency Units:</td>
  <td>" .  $objects['purchase_frequency_units']  . "</td>
</tr>
<tr>
  <td>Desired Price:</td>
  <td>" .  $objects['desired_price']  . "</td>
</tr>
<tr>
  <td>Price Units:</td>
  <td>" .  $objects['price_units']  . "</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>" .  $objects['comments']  . "</td>
</tr>
<tr>
  <td>Created By</td><td>" .  $objects['created_by'] . "</td></tr>
<tr>
  <td>Creation Date</td><td>" .  sqlToUserDate($objects['creation_date']) . "</td></tr>
<tr>
  <td>Modified By</td><td>" .  $objects['modified_by'] . "</td></tr>
<tr>
  <td>Modification Date</td><td>" .  sqlToUserDate($objects['modification_date']) . "</td></tr>
</table>

     </div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"index.php?view=shopping_list&action=create\" method=\"post\">
    <input type=\"hidden\" name=\"view\" value=\"shopping_list\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "
<table width=100% border=1>
<tr>
  <td>Product Name: *</td>
  <td>
<select name=product_id>
  <option>";
$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Other Product Name:</td>
  <td><input name=other_product_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Status:</td>
  <td>
<select name=status>\n";
echo "
  <option value=\"Got\""; if ($objects['status'] == 'Got') echo " SELECTED";echo ">Got
  <option value=\"Need\" SELECTED>Need
  <option value=\"Want\""; if ($objects['status'] == 'Want') echo " SELECTED";echo ">Want
";
echo "</select>
</td>
</tr>
<tr>
  <td>Frequency:</td>
  <td><input name=purchase_frequency value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Frequency Units:</td>
  <td>
<select name=purchase_frequency_units>
  <option>";
echo "
  <option value=\"Day\""; if ($objects['purchase_frequency_units'] == 'Day') echo " SELECTED";echo ">Day
  <option value=\"Week\""; if ($objects['purchase_frequency_units'] == 'Week') echo " SELECTED";echo ">Week
  <option value=\"Month\""; if ($objects['purchase_frequency_units'] == 'Month') echo " SELECTED";echo ">Month
  <option value=\"Year\""; if ($objects['purchase_frequency_units'] == 'Year') echo " SELECTED";echo ">Year
";
echo "</select>
</td>
</tr>
<tr>
  <td>Desired Price:</td>
  <td><input name=desired_price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Price Units:</td>
  <td>
<select name=price_units>
  <option>";
echo "
  <option value=\"Pound\""; if ($objects['price_units'] == 'Pound') echo " SELECTED";echo ">Pound
  <option value=\"Fixed Cost\""; if ($objects['price_units'] == 'Fixed Cost') echo " SELECTED";echo ">Fixed Cost
";
echo "</select>
</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from shopping_list WHERE shopping_list_id = " . $_GET['shopping_list_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=shopping_list&action=edit\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "
<table width=100% border=1>
<tr>
  <td>Product Name: *</td>
  <td>
<select name=product_id>
  <option>";
$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Other Product Name:</td>
  <td><input name=other_product_name value=\"" . $objects['other_product_name'] . "\"></td>
</tr>
<tr>
  <td>Status:</td>
  <td>
<select name=status>";
echo "
  <option value=\"Got\""; if ($objects['status'] == 'Got') echo " SELECTED";echo ">Got
  <option value=\"Need\""; if ($objects['status'] == 'Need') echo " SELECTED";echo ">Need
  <option value=\"Want\""; if ($objects['status'] == 'Want') echo " SELECTED";echo ">Want
";
echo "</select>
</td>
</tr>
<tr>
  <td>Frequency:</td>
  <td><input name=purchase_frequency value=\"" . $objects['purchase_frequency'] . "\"></td>
</tr>
<tr>
  <td>Frequency Units:</td>
  <td>
<select name=purchase_frequency_units>
  <option>";
echo "
  <option value=\"Day\""; if ($objects['purchase_frequency_units'] == 'Day') echo " SELECTED";echo ">Day
  <option value=\"Week\""; if ($objects['purchase_frequency_units'] == 'Week') echo " SELECTED";echo ">Week
  <option value=\"Month\""; if ($objects['purchase_frequency_units'] == 'Month') echo " SELECTED";echo ">Month
  <option value=\"Year\""; if ($objects['purchase_frequency_units'] == 'Year') echo " SELECTED";echo ">Year
";
echo "</select>
</td>
</tr>
<tr>
  <td>Desired Price:</td>
  <td><input name=desired_price value=\"" . $objects['desired_price'] . "\"></td>
</tr>
<tr>
  <td>Price Units:</td>
  <td>
<select name=price_units>
  <option>";
echo "
  <option value=\"Pound\""; if ($objects['price_units'] == 'Pound') echo " SELECTED";echo ">Pound
  <option value=\"Fixed Cost\""; if ($objects['price_units'] == 'Fixed Cost') echo " SELECTED";echo ">Fixed Cost
";
echo "</select>
</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }

  $rows = 0;
  $product_type = $_GET['product_type'];
  if ($product_type == '') $product_type = 'Food';
  echo "<a href=index.php?view=shopping_list&action=display_create_form>Add Shopping List Item</a><select name=product_type onChange=\"window.open('index.php?view=shopping_list&product_type=' + this.options[this.selectedIndex].value,'_self');\">\n";

$objects['product_type'] = '';
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Product Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>";

/*
  echo "<option" . ($product_type == 'Food'?" SELECTED":"") . ">Food\n";
  echo "<option" . ($product_type == 'Electronics'?" SELECTED":"") . ">Electronics\n";
  echo "<option" . ($product_type == 'Lawn Care'?" SELECTED":"") . ">Lawn Care\n";
  echo "</select>\n";
*/
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Product</b></td><td align=center><b>Status</b></td></tr>\n";

  $filter = "";
  if (isset($_GET['product_type']))
     $filter = " AND product.product_type = '" . $_GET['product_type'] . "' ";

  $rows = 0;
  $objects_query = tep_db_query("SELECT shopping_list_id as id, shopping_list.*, user.*, product.* FROM shopping_list, user, product WHERE shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.user_id = '" . $user_id . "'" . $filter . "ORDER BY status DESC, product_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['shopping_list_id'] . "\"></a><td><a href=index.php?view=shopping_list&action=delete&shopping_list_id=" . $objects['shopping_list_id'] . ">Delete</a><br><a href=index.php?view=shopping_list&action=display_edit_form&shopping_list_id=" . $objects['shopping_list_id'] . ">Edit</a>";
if ($objects['status'] == 'Need')
{
   echo "<br><a href=index.php?view=shopping_list&action=update_field&field=status&value=Got&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">Got it</a>";
}
else
{
   echo "<br><a href=index.php?view=shopping_list&action=update_field&field=status&value=Need&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">Need</a>";
}
echo "</td>  <td><a href=index.php?view=shopping_list&action=display&shopping_list_id=" . $objects['shopping_list_id'] . ">" . displayField($objects['product_name'],'STRING','') . (strlen($objects['other_product_name']) > 0?" (" . $objects['other_product_name'] . ")":"" ) . "</a></td>  <td>" . displayField($objects['status'],'STRING','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan= align=center>No Results</td></tr>";
  }
  echo "</table>";
  echo "<hr>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}

?>
