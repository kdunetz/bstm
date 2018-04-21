<p>
<center><h3><font color=blue>Coupon</font></h3></center>
<p>
<?php
  require('configure.php');
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "coupon.php?";
     $urlPrefixShort = "coupon.php";
  }
  else
  {
     $urlPrefix = "index.php?view=coupon&";
     $urlPrefixShort = "index.php?view=coupon";
  }

  if ($mobilesite == "true")
  {
    require('database.php');
    tep_db_connect();
    require('functions.php');

    require('general.php');
    require('html_output.php');
    require('boxes.php');
    require('table_block.php');
   // require('sessions.php');
    require('initialize.php');

  // initialize the message stack for output messages
    require('message_stack.php');
    $messageStack = new messageStack;

echo "session = " . print_r($_SESSION);
echo "session = " . print_r($_COOKIE);
    if (!tep_session_is_registered('user_id')) {
      //$navigation->set_snapshot();
echo "values = ";
echo $user_id;
echo $first_name;
 //     tep_redirect(tep_href_link('login.php', '', 'SSL'));
    }
  }

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM coupon WHERE coupon_id = " . $_GET['coupon_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE coupon SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE coupon_id = " . $_GET['coupon_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['coupon_name'])) {
   $messageStack->add('Coupon Name is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['source_id'])) {
   $messageStack->add('Source is required');
}
if (empty($_POST['delivery_mechanism_id'])) {
   $messageStack->add('Delivery Mechanism is required');
}
if (empty($_POST['discount'])) {
   $messageStack->add('Disc/Price Amt is required');
}
if (empty($_POST['discount_type'])) {
   $messageStack->add('Disc/Price Type is required');
}
if (empty($_POST['discount_units'])) {
   $messageStack->add('Discount Units is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   //include($hfPrefix . "footer.php");
   return;
}

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
'coupon_name' => $_POST['coupon_name'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'product_id' => $_POST['product_id'],
'store_id' => $_POST['store_id'],
'source_id' => $_POST['source_id'],
'delivery_mechanism_id' => $_POST['delivery_mechanism_id'],
'date_received' => userToSQLDate($_POST['date_received']),
'url' => $_POST['url'],
'discount' => $_POST['discount'],
'discount_type' => $_POST['discount_type'],
'discount_units' => $_POST['discount_units'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('coupon', $sql_data_array, 'update', "coupon_id = " . $_POST['coupon_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      if ($mobilesite == 'true')
         tep_redirect(tep_href_link($urlPrefix . 'action=display&deal_id=' . $_POST['deal_id'],'','SSL'));
      else
         $_GET['action'] = 'display';

  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['coupon_name'])) {
   $messageStack->add('Coupon Name is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['source_id'])) {
   $messageStack->add('Source is required');
}
if (empty($_POST['delivery_mechanism_id'])) {
   $messageStack->add('Delivery Mechanism is required');
}
if (empty($_POST['discount'])) {
   $messageStack->add('Disc/Price Amt is required');
}
if (empty($_POST['discount_type'])) {
   $messageStack->add('Disc/Price Type is required');
}
if (empty($_POST['discount_units'])) {
   $messageStack->add('Discount Units is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   //include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from coupon WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'coupon_name' => $_POST['coupon_name'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'product_id' => $_POST['product_id'],
'store_id' => $_POST['store_id'],
'source_id' => $_POST['source_id'],
'delivery_mechanism_id' => $_POST['delivery_mechanism_id'],
'date_received' => userToSQLDate($_POST['date_received']),
'url' => $_POST['url'],
'discount' => $_POST['discount'],
'discount_type' => $_POST['discount_type'],
'discount_units' => $_POST['discount_units'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('coupon', $sql_data_array, 'insert', "coupon_id = " . $_POST['coupon_id']);

      }
      else
      {
         $messageStack->add('This record has already been loaded'); 
         if ($messageStack->size > 0) 
         { 
            echo $messageStack->output(); 
            //include($hfPrefix . "footer.php");
            return; 
         }
      }
      //tep_redirect(tep_href_link('login.php', '', 'SSL'));
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }
?>

<?php 

  if ($mobilesite == 'true') 
  {     
     $showSearch = false;
     include($hfPrefix . "header.php");
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm you would like to delete this coupon<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&coupon_id=" . $_GET['coupon_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=" . $urlPrefixShort . ">No</a>";
     }
     //include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
    if (!isset($_GET['coupon_id']) && isset($_POST['coupon_id']))
        $_GET['coupon_id'] = $_POST['coupon_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT coupon.*,product.product_name,delivery_mechanism.delivery_mechanism_name,source.source_name, store.store_name, vendor.vendor_name FROM coupon LEFT JOIN store on coupon.store_id = store.store_id INNER JOIN source on source.source_id = coupon.source_id INNER JOIN delivery_mechanism on coupon.delivery_mechanism_id = delivery_mechanism.delivery_mechanism_id INNER JOIN product on coupon.product_id = product.product_id INNER JOIN vendor on product.vendor_id = vendor.vendor_id WHERE coupon.coupon_id = " . $_GET['coupon_id']);
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
if (($role == 'admin' || $objects['user_id'] == $user_id) && tep_session_is_registered('user_id'))
     echo "<a class=\"button\" href=" . $urlPrefix . "action=display_edit_form&coupon_id=" . $objects['coupon_id'] . "><span>Edit</span></a><br>\n";
echo "<center><table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Coupon Name</td>
  <td class=bstm_td>" .  $objects['coupon_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Begin Date</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['begin_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>End Date</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['end_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Vendor Name</td>
  <td class=bstm_td>" .  $objects['vendor_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Product Name</td>
  <td class=bstm_td>" .  $objects['product_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Store Name</td>
  <td class=bstm_td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Source</td>
  <td class=bstm_td>" .  $objects['source_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Delivery Mechanism</td>
  <td class=bstm_td>" .  $objects['delivery_mechanism_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Date Received</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['date_received'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Coupon URL</td>
  <td class=bstm_td><a href=" . (strpos($objects['url'], "http://") !== false?"":"http://") .  $objects['url'] . " TARGET=_new>" . $objects['url'] . "</a></td>
</tr>
<tr>
  <td class=sectiontableheader>Disc/Price Amt</td>
  <td class=bstm_td>$" .  $objects['discount']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Discount Units</td>
  <td class=bstm_td>" .  $objects['discount_units']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Disc/Price Type</td>
  <td class=bstm_td>" .  ($objects['discount_type']=="P"?"Price":"Discount")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments</td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>\n";
if (false)
{
echo "</tr>
<tr>
  <td>Created By</td><td>" .  $objects['created_by'] . "</td></tr>
<tr>
  <td>Creation Date</td><td>" .  sqlToUserDate($objects['creation_date']) . "</td></tr>
<tr>
  <td>Modified By</td><td>" .  $objects['modified_by'] . "</td></tr>
<tr>
  <td>Modification Date</td><td>" .  sqlToUserDate($objects['modification_date']) . "</td></tr>\n";
}
echo "</table>\n";

     //include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<form action=\"" . $urlPrefixShort . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "<table width=100% border=1>
<tr>
  <td>Coupon Name *</td>
  <td><input name=coupon_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Begin Date</td>
  <td>
<input name=begin_date value=" . sqlToUserDate($objects['begin_date']) . "></td>
</tr>
<tr>
  <td>End Date *</td>
  <td>
<input name=end_date value=" . sqlToUserDate($objects['end_date']) . "></td>
</tr>
<tr>
  <td>Product Name *</td>
  <td>
<select name=product_id>
  <option>";
$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY concat(vendor_name, ' ', product_name)");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Store Name</td>
  <td>
<select name=store_id>
  <option>";
$objects['store_id'] = '';$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY store_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Source *</td>
  <td>
<select name=source_id>
  <option>";
$objects['source_id'] = '';$select_query = tep_db_query("SELECT source_id as _key, source_name as value FROM source ORDER BY source_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['source_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Delivery Mechanism *</td>
  <td>
<select name=delivery_mechanism_id>
  <option>";
$objects['delivery_mechanism_id'] = '';$select_query = tep_db_query("SELECT delivery_mechanism_id as _key, delivery_mechanism_name as value FROM delivery_mechanism ORDER BY delivery_mechanism_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['delivery_mechanism_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Date Received</td>
  <td>
<input name=date_received value=" . sqlToUserDate($objects['date_received']) . "></td>
</tr>
<tr>
  <td>Disc/Price Amt *</td>
  <td><input name=discount value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Disc/Price Type *</td>
  <td>
<select name=discount_type>
  <option>";
echo "
  <option value=\"P\""; if ($objects['discount_type'] == 'P') echo " SELECTED";echo ">Price
  <option value=\"D\""; if ($objects['discount_type'] == 'D') echo " SELECTED";echo ">Discount
";
echo "</select>
</td>
</tr>
<tr>
  <td>Discount Units *</td>
  <td>
<select name=discount_units>
  <option>";
echo "
  <option value=\"Dollars\""; if ($objects['discount_units'] == 'Dollars') echo " SELECTED";echo ">Dollars
  <option value=\"Percent\""; if ($objects['discount_units'] == 'Percent') echo " SELECTED";echo ">Percent
  <option value=\"Cost\""; if ($objects['discount_units'] == 'Cost') echo " SELECTED";echo ">Cost
";
echo "</select>
</td>
</tr>
<tr>
  <td>Comments</td>
  <td>
<textarea rows=6 cols=25 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
<tr>
   <td align=center colspan=2><input type=\"submit\"></td>
</tr>
</table>

    </form>\n";
    //include($hfPrefix . "footer.php");
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from coupon WHERE coupon_id = " . $_GET['coupon_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<form action=\"" . $urlPrefixShort . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "<table width=100% border=1>
<tr>
  <td>Coupon Name *</td>
  <td><input name=coupon_name value=\"" . $objects['coupon_name'] . "\"></td>
</tr>
<tr>
  <td>Begin Date</td>
  <td>
<input name=begin_date value=" . sqlToUserDate($objects['begin_date']) . "></td>
</tr>
<tr>
  <td>End Date *</td>
  <td>
<input name=end_date value=" . sqlToUserDate($objects['end_date']) . "></td>
</tr>
<tr>
  <td>Product Name *</td>
  <td>
<select name=product_id>
  <option>";
$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY concat(vendor_name, ' ', product_name)");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Store Name</td>
  <td>
<select name=store_id>
  <option>";
$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY store_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Source *</td>
  <td>
<select name=source_id>
  <option>";
$select_query = tep_db_query("SELECT source_id as _key, source_name as value FROM source ORDER BY source_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['source_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Delivery Mechanism *</td>
  <td>
<select name=delivery_mechanism_id>
  <option>";
$select_query = tep_db_query("SELECT delivery_mechanism_id as _key, delivery_mechanism_name as value FROM delivery_mechanism ORDER BY delivery_mechanism_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['delivery_mechanism_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Date Received</td>
  <td>
<input name=date_received value=" . sqlToUserDate($objects['date_received']) . "></td>
</tr>
<tr>
  <td>Disc/Price Amt *</td>
  <td><input name=discount value=\"" . $objects['discount'] . "\"></td>
</tr>
<tr>
  <td>Disc/Price Type *</td>
  <td>
<select name=discount_type>
  <option>";
echo "
  <option value=\"P\""; if ($objects['discount_type'] == 'P') echo " SELECTED";echo ">Price
  <option value=\"D\""; if ($objects['discount_type'] == 'D') echo " SELECTED";echo ">Discount
";
echo "</select>
</td>
</tr>
<tr>
  <td>Discount Units *</td>
  <td>
<select name=discount_units>
  <option>";
echo "
  <option value=\"Dollars\""; if ($objects['discount_units'] == 'Dollars') echo " SELECTED";echo ">Dollars
  <option value=\"Percent\""; if ($objects['discount_units'] == 'Percent') echo " SELECTED";echo ">Percent
  <option value=\"Cost\""; if ($objects['discount_units'] == 'Cost') echo " SELECTED";echo ">Cost
";
echo "</select>
</td>
</tr>
<tr>
  <td>Comments</td>
  <td>
<textarea rows=6 cols=25 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
<tr>
   <td align=center colspan=2><input type=\"submit\"></td>
</tr>
</table>

    </form>\n";
    //include($hfPrefix . "footer.php");
    return;
  }

if (isset($_GET['action']) && ($_GET['action'] == 'display_list')) 
{
  $rows = 0;
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Coupon</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Product</b></td><td align=center><b>Disc/Price Amt</b></td><td align=center><b>Disc/Price Type</b></td><td align=center><b>Expiration Date</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT coupon_id as id, coupon.*, product.* FROM coupon, product WHERE coupon.product_id = product.product_id ORDER BY coupon_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['coupon_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&coupon_id=" . $objects['coupon_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&coupon_id=" . $objects['coupon_id'] . ">Edit</a>";
echo "</td>  <td><a href=coupon.php?action=display&coupon_id=" . $objects['coupon_id'] . ">" . displayField($objects['coupon_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td align=right>" . displayField($objects['discount'],'NUMBER','$###,###.00') . "</td>  <td>" . displayField($objects['discount_type'],'STRING','') . "</td>  <td>" . displayField($objects['end_date'],'DATETIME','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";
  echo "<hr>";
}

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   //include($hfPrefix . "footer.php");
   return;
}

if ($mobilesite == 'true') 
{
   //include($hfPrefix . "footer.php");
}

?>
