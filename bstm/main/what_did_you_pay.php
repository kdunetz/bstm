<?php

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      require('configure.php');
      require('database.php');
      require('general.php');
      require('html_output.php');
      tep_db_connect();
      tep_db_query("DELETE FROM sample_bill WHERE sample_bill_id = " . $_GET['sample_bill_id']);
      tep_redirect(tep_href_link('index.php?view=what_did_you_pay&action=display_list','','SSL'));
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
?>
<div class="componentheading">What Did You Pay?</div>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'invite_neighbor')) 
  {
     echo "Enter a list of comma separated addresses for people that might be interested in seeing this bill or have a bill that you want to look at. They will be sent an email that explains how they can post their own bill.";
     echo "<form action=\"index.php?view=what_did_you_pay\" method=\"post\">
     <input type=hidden name=action value=send_invite_to_neighbor>
     <input type=hidden name=sample_bill_id value=" . $_GET['sample_bill_id'] . ">
     <table>
     <tr><td>Email Address(es): *</td><td><input name=email_addresses size=50></td></tr>
     <tr><td>Personalized Note:</td><td><textarea ROWS=10 COLS=50 name=personal_note></textarea></td></tr>
     <tr><td align=center colspan=2><input type=\"submit\"></td></tr>
     </table>
     </form>";
  }
  if (isset($_POST['action']) && ($_POST['action'] == 'send_invite_to_neighbor')) 
  {
     $objects_query = tep_db_query("SELECT * from sample_bill, user WHERE user.user_id = sample_bill.created_by AND sample_bill_id = " . $_POST['sample_bill_id']);
     $objects = tep_db_fetch_array($objects_query);

     $to = $_POST['email_addresses']; 
     if (empty($to))
     {
        $messageStack->add('Email Address field is required');
     }
     if ($messageStack->size > 0) { echo $messageStack->output(); return; }

     $subject = $objects['first_name'] . " " . $objects['last_name'] . " would like you to post your " . $objects['sample_bill_type'] . " to www.bringsavingstome.com";
     $headers = "MIME-Version: 1.0" . "\r\n"; 
     $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
     //$headers .= "Content-type: multipart/alternative; boundary=" . $mime_boundary_header . "\r\n";
     $headers .= 'From: admin@bringsavingstome.com' . "\r\n";
     $body  = $_POST['personal_note'] . "<p>";
     if (empty($_POST['personal_note'])) 
     {
        $body  = $objects['first_name'] . " " . $objects['last_name'] . " wants to compare a " . $objects['sample_bill_type'] . " with yours.<p>"; 
     }

     $body .= "<p>To load your bill and/or review the sender's bill, please log into <a href=http://www.bringsavingstome.com>www.bringsavingstome.com</a> go to the \"What Did You Pay?\" resource, and upload it there.";
   
     if (mail($to, $subject, $body, $headers)) {
        echo("<p>Message successfully sent!</p>");
      } 
      else {
        echo("<p>Message delivery failed...</p>");
     }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['sample_bill_name'])) {
   $messageStack->add('Sample Bill Name is required');
}
if (empty($_POST['sample_bill_type'])) {
   $messageStack->add('Sample Bill Type is required');
}
if (empty($_POST['neighborhood_id'])) {
   $messageStack->add('Neighborhood is required');
}
if (false)
{
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['store_location'])) {
   $messageStack->add('Store Location is required');
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
if (empty($_POST['price_date'])) {
   $messageStack->add('Price Date is required');
}
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
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
'sample_bill_name' => $_POST['sample_bill_name'],
'sample_bill_type' => $_POST['sample_bill_type'],
'neighborhood_id' => $_POST['neighborhood_id'],
'location' => $_POST['location'],
'comments' => $_POST['comments']);
/*
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view')
  {
      $sql_data_array[$key] = $value;
  }
}
*/
tep_db_perform('sample_bill', $sql_data_array, 'update', "sample_bill_id= " . $_POST['sample_bill_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      //tep_redirect(tep_href_link('sale_line_item.php?action=display&sale_line_item_id=' . $_POST['sale_line_item_id'],'','SSL'));
      $_GET['action'] = "display";
      $_GET['sample_bill_id'] = $_POST['sample_bill_id'];
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {

if (empty($_POST['sample_bill_name'])) {
   $messageStack->add('Sample Bill Name is required');
}
if (empty($_POST['sample_bill_type'])) {
   $messageStack->add('Sample Bill Type is required');
}
if (empty($_POST['neighborhood_id'])) {
   $messageStack->add('Neighborhood is required');
}
if (false)
{
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required (Select "Other" if the value is not in the list)');
}
if (empty($_POST['store_location'])) {
   $messageStack->add('Store Location is required (Enter at least the city)');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from sample_bill WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {

         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'sample_bill_name' => $_POST['sample_bill_name'],
'sample_bill_type' => $_POST['sample_bill_type'],
'neighborhood_id' => $_POST['neighborhood_id'],
'location' => $_POST['location'],
'comments' => $_POST['comments']);
/*
'other_store_name' => $_POST['other_store_name'],
'store_location' => $_POST['store_location'],
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view')
  {
      $sql_data_array[$key] = $value;
  }
}
*/
tep_db_perform('sample_bill', $sql_data_array, 'insert', "sample_bill_id = " . $_POST['sample_bill_id']);
$_GET['sample_bill_id'] = tep_db_insert_id();
$bill_id = $_GET['sample_bill_id']; 

$target_path = "uploads/bills/" . $bill_id . "/";
//echo $target_path;
//echo getcwd() . "/" . $target_path;
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
      $_GET['action'] = "display";
      $_GET['sample_bill_id'] = tep_db_insert_id();
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=what_did_you_pay.php?action=delete_confirm&sample_bill_id=" . $_GET['sample_bill_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=what_did_you_pay.php>No</a>";
     }
     return;
  }
  if (isset($_POST['action']) && ($_POST['action'] == 'update_my_stores')) 
  {
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store LEFT JOIN my_stores ON my_stores.store_id = store.store_id AND my_stores.user_id = 1 ORDER BY value");
     /* figure out what needs to be deleted */
     while ($select = tep_db_fetch_array($select_query))
     {
        if (isset($select['my_stores_id']))
        {
            $storeID = $select['_key'];

            $found = false;
            $ORIGINAL_POST = $_POST;
            while(list($key,$value) = each($ORIGINAL_POST)) 
            {
               if ($key != "action")
               {
                  if ($storeID == $key)
                     $found = true;
               }
            }
            if (!$found)
            {
               tep_db_query("DELETE FROM my_stores WHERE my_stores_id = " . $select['my_stores_id']);
            }
        }

     }
     /* figure out what needs to be added */
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store LEFT JOIN my_stores ON my_stores.store_id = store.store_id AND my_stores.user_id = 1 ORDER BY value");
     while ($select = tep_db_fetch_array($select_query))
     {
        if (!isset($select['my_stores_id']))
        {
            $storeID = $select['_key'];

            $found = false;
            $ORIGINAL_POST = $_POST;
            while(list($key,$value) = each($ORIGINAL_POST)) 
            {
               if ($storeID == $key)
                   $found = true;
            }
            if ($found)
            {
               $sql_data_array = array('creation_date' => 'now()',
                                  'created_by' => $user_id,
                                  'modification_date' => 'now()',
                                  'modified_by' => $user_id,
                                  'user_id' => $user_id,
                                  'store_id' => $storeID,
                                  'comments' => '');
               tep_db_perform('my_stores', $sql_data_array, 'insert', "my_stores_id = " . $_POST['my_stores_id']);
            }
        }
     }
     $_GET['action'] = "display_stores"; /* fall through and redisplay the list of stores */
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_my_stores')) 
  {
     echo "<a class=\"button\" href=index.php?view=what_did_you_pay&action=update_stores><span>Add/Remove a Store/Restaurant</span></a><br>\n";
     echo "<div id=buttonspacer></div>\n";
     echo "<table class=contenttoc width=\"100%\">\n";
     echo "<tr>\n";
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store, my_stores WHERE store.store_id = my_stores.store_id AND my_stores.user_id = 1 ORDER BY value");
     while ($select = tep_db_fetch_array($select_query))
     {
        $rows++;
        echo "<td class=bstm_td>" . $select['value'] . "</td>";
        if ($rows % 3 == 0)
           echo "</tr>\n</tr>";
     }
     while ($rows++ % 3 != 0)
        echo "<td class=bstm_td></td>";
     echo "</tr>\n";
     echo "</table>\n";
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_stores')) 
  {
     echo "<form action=index.php?view=what_did_you_pay method=post>\n";
     echo "<input type=hidden name=\"action\" value=\"update_my_stores\">\n";
     echo "<table>\n";
     echo "<tr>\n";
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store LEFT JOIN my_stores ON my_stores.store_id = store.store_id AND my_stores.user_id = 1 ORDER BY value");
     while ($select = tep_db_fetch_array($select_query))
     {
        $rows++;
        echo "<td><input type=checkbox name=\"" . $select['_key'] . "\" value=\"" . $select['value'] . "\""; if (isset($select['my_stores_id'])) echo " checked"; echo ">" . $select['value'] . "</td>";
        if ($rows % 3 == 0)
           echo "</tr>\n</tr>";
     }
     echo "</tr>\n";
     echo "</table>\n";
     echo "<input type=\"submit\">\n";
     echo "</form>\n";
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form enctype=\"multipart/form-data\" action=\"index.php?view=what_did_you_pay\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "
<table width=100% border=1>
<tr>
  <td>Sample Bill Name: *</td>
  <td><input name=sample_bill_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Sample Bill Type: *</td>
  <td>
<select name=sample_bill_type>
  <option>";
$objects['sample_bill_type'] = '';
$select_query = tep_db_query("SELECT value as _key, value as value FROM reference WHERE category = 'Bill Category' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;

   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['sample_bill_type'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Neighborhood: *</td>
  <td>
<select name=neighborhood_id>
  <option>";
$select_query = tep_db_query("SELECT neighborhood_id as _key, neighborhood_name as value FROM neighborhood ORDER BY neighborhood_name");

while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['neighborhood_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Vendor Name: </td>
  <td><input name=vendor_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>City and State: *</td>
  <td><input name=store_location value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Zone: *</td>
  <td>
          <select name=\"location\">
            <option>\n";
$location = $objects['location'];
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($location == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
          echo "</select>
   </td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>
<input name=\"uploadedfile\" type=\"file\" />
    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from sample_bill WHERE sample_bill_id = " . $_GET['sample_bill_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=what_did_you_pay\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "
<table width=100% border=1>
<tr>
  <td>Sample Bill Name: *</td>
  <td><input name=sample_bill_name value=\"" . $objects['sample_bill_name'] . "\"></td>
</tr>
<tr>
  <td>Sample Bill Type: *</td>
  <td>
<select name=sample_bill_type>
  <option>";
$select_query = tep_db_query("SELECT value as _key, value as value FROM reference WHERE category = 'Bill Category' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;

   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['sample_bill_type'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Neighborhood: *</td>
  <td>
<select name=neighborhood_id>
  <option>";
$select_query = tep_db_query("SELECT neighborhood_id as _key, neighborhood_name as value FROM neighborhood ORDER BY neighborhood_name");

while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['neighborhood_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Other Store Name: (*)</td>
  <td><input name=other_store_name value=\"" . $objects['other_store_name'] . "\"></td>
</tr>
<tr>
  <td>Store Location: *</td>
  <td><input name=store_location value=\"" . $objects['store_location'] . "\"></td>
</tr>
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
  <td>Zone: *</td>
  <td>
          <select name=\"location\">
            <option>\n";
$location = $objects['location'];
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($location == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
          echo "</select>
   </td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
     $objects_query = tep_db_query("SELECT sample_bill.*,neighborhood.neighborhood_name FROM sample_bill, neighborhood WHERE sample_bill.neighborhood_id = neighborhood.neighborhood_id AND sample_bill_id = " . $_GET['sample_bill_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by_name'] = $user['user_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by_name'] = $user['user_name'];
     }
     echo "<div id=\"content\">";
if ($role == 'admin' || $objects['user_id'] == $user_id || $objects['created_by'] == $user_id)
{
   echo "<a href=index.php?view=what_did_you_pay&action=display_edit_form&sample_bill_id=" . $objects['sample_bill_id'] . ">Edit</a>\n";
   echo "<a href=index.php?view=what_did_you_pay&action=invite_neighbor&sample_bill_id=" . $objects['sample_bill_id'] . ">Invite a Neighbor</a>\n";
}
echo "<table width=100% border=1>
<tr>
  <td>Sample Bill Name: *</td>
  <td>" .  $objects['sample_bill_name']  . "</td>
</tr>
<tr>
  <td>Sample Bill Type: *</td>
  <td>" .  $objects['sample_bill_type']  . "</td>
</tr>
<tr>
  <td>Neighborhood: *</td>
  <td>" .  $objects['neighborhood_name']  . "</td>
</tr>
<tr>
  <td>Store Name: *</td>
  <td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td>Other Store Name:</td>
  <td>" .  $objects['other_store_name']  . "</td>
</tr>
<tr>
  <td>Store Location: *</td>
  <td>" .  $objects['store_location']  . "</td>
</tr>
<tr>
  <td>Vendor Name: *</td>
  <td>" .  $objects['vendor_name']  . "</td>
</tr>
<tr>
  <td>Zone: *</td>
  <td>" .  $objects['location']  . "</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>" .  $objects['comments']  . "</td>
</tr>
<tr>
  <td>Created By:</td>
  <td>" .  $objects['created_by_name']  . "</td>
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
$uploadFiles = getDirectoryList("uploads/bills/" . $objects['sample_bill_id']);
echo "</table>\n";

for ($i=0;$i < sizeof($uploadFiles);$i++)
   echo "<a href=\"uploads/bills/" . $objects['sample_bill_id'] . "/" . $uploadFiles[$i] . "\"><img width=128 height=64 src=\"uploads/bills/" . $objects['sample_bill_id'] . "/" . $uploadFiles[$i] . "\"></a>\n";

     echo "</div> <!- content ->";
     return;
  }

if ($_GET['action'] == 'display_list')
{
  $rows = 0;
  echo "<a href=index.php?view=what_did_you_pay&action=display_create_form>Add New Bill</a>";
  echo "<a href=index.php?view=what_did_you_pay&action=test_popup>Test Popup</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Date Posted</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT sample_bill_id as id, sample_bill.* FROM sample_bill");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['sample_bill_id'] . "\"></a><td><a href=index.php?view=what_did_you_pay&action=delete&sample_bill_id=" . $objects['sample_bill_id'] . ">Delete</a><br><a href=index.php?view=what_did_you_pay&action=display_edit_form&sample_bill_id=" . $objects['sample_bill_id'] . ">Edit</a>";
echo "</td>  <td><a href=index.php?view=what_did_you_pay&action=display&sample_bill_id=" . $objects['sample_bill_id'] . ">" . displayField($objects['sample_bill_name'],'STRING','') . "</a></td><td align=center>" . sqlToUserDate($objects['creation_date']) . "</td></tr>\n";

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
}

?>
