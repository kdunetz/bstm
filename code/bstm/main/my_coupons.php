<div class="componentheading">My Coupons</div>
<?php

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM my_coupons WHERE my_coupons_id = " . $_GET['my_coupons_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE my_coupons SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE my_coupon_id = " . $_GET['my_coupon_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

$display = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['coupon_id'])) {
   $messageStack->add('Coupon Name is required');
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
'coupon_id' => $_POST['coupon_id'],
'user_id' => $_POST['user_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('my_coupons', $sql_data_array, 'update', "my_coupons_id = " . $_POST['my_coupons_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      $display= "true";
  }
  if (isset($_POST['action']) && ($_POST['action'] == 'redeem')) 
  {
      if (empty($_POST['store_id'])) {
          $messageStack->add('Store Name is required');
      }
      if (empty($_POST['total_savings'])) {
          $messageStack->add('Total Savings is required');
      }
      if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from my_savings WHERE coupon_id = " . $_POST['coupon_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'coupon_id' => $_POST['coupon_id'],
'savings' => $_POST['total_savings'],
'comments' => $_POST['comments']);
tep_db_perform('my_savings', $sql_data_array, 'insert', "my_savings_id = " . $_POST['my_savings_id']);

      }
      else
      {
         $messageStack->add('This record has already been loaded'); 
         if ($messageStack->size > 0) { echo $messageStack->output(); return; }
      }
      //tep_redirect(tep_href_link('login.php', '', 'SSL'));
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['coupon_id'])) {
   $messageStack->add('Coupon Name is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from my_coupons WHERE coupon_id = " . $_POST['coupon_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'coupon_id' => $_POST['coupon_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('my_coupons', $sql_data_array, 'insert', "my_coupons_id = " . $_POST['my_coupons_id']);

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
     echo "Please confirm you would like to delete this Coupon from your list<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=index.php?view=my_coupons&action=delete_confirm&my_coupons_id=" . $_GET['my_coupons_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=index.php&view=my_coupons>No</a>";
     }
     return;
  }
  if ((isset($_GET['action']) && ($_GET['action'] == 'display')) || $display == "true") 
  {
/* KAD leave off the ending quotes because it is an equation on the end */
if (!isset($_GET['my_coupons_id']) && isset($_POST['my_coupons_id']))
   $_GET['my_coupons_id'] = $_POST['my_coupons_id'];
     $objects_query = tep_db_query("SELECT my_coupons.*,user.user_name,coupon.coupon_name FROM my_coupons,user,coupon WHERE my_coupons.coupon_id = coupon.coupon_id AND my_coupons.user_id = user.user_id AND my_coupons.my_coupons_id = " . $_GET['my_coupons_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by'] = $user['user_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by'] = $user['user_name'];
     }
     echo "<div id=\"content\">
<a href=index.php?view=my_coupons&action=list>Back to My Coupons</a> |
<a href=index.php?view=my_coupons&action=display_edit_form&my_coupons_id=" . $objects['my_coupons_id'] . ">Edit</a>\n<table width=100% border=1>
<tr>
  <td>Coupon Name: *</td>
  <td>" .  $objects['coupon_name']  . "</td>
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
    <form action=\"index.php?view=my_coupons&action=create\" method=\"post\">
    <input type=\"hidden\" name=\"view\" value=\"my_coupons\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
//$select_query = tep_db_query("SELECT coupon_id as _key, concat(coupon_name, '(', ifnull(store_name,''), ',', source_name, ',', product_name, ')') as value FROM (SELECT coupon_id, coupon_name, store_name, source_name, product_name FROM coupon LEFT JOIN store on coupon.store_id = store.store_id INNER JOIN source on source.source_id = coupon.source_id INNER JOIN product on coupon.product_id = product.product_id WHERE end_date >= now()) result ");
echo sqlQuery("SELECT concat('<input type=checkbox name=', coupon_id,'>')  as '', concat('<a href=index.php?action=display&view=coupon&coupon_id=', coupon_id,'>', coupon_name, '</a>') as 'Coupon Name', store_name as 'Store Name', source_name as 'Source Name', product_name as 'Product Name', date_received as 'Date Received' FROM (SELECT coupon_id, coupon_name, store_name, source_name, product_name, date_received FROM coupon LEFT JOIN store on coupon.store_id = store.store_id INNER JOIN source on source.source_id = coupon.source_id INNER JOIN product on coupon.product_id = product.product_id WHERE (end_date >= now() OR datediff(curdate(), date_received) < 30)) result ");
/*
echo "
<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Coupon Name: *</td>
  <td class=bstm_td>
<select name=coupon_id>
  <option>";
$objects['coupon_id'] = '';
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   if (strpos($select['value'], "Any ") !== false) * KAD added to take off the any to make it easier to search *
   {
      $select['value'] = substr($select['value'], 4);
   }
   //echo "<option value=\"" . $select['_key'] . "\""; if ($objects['coupon_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
*/
/*
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>
<textarea rows=6 cols=50 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>
*/

    echo "<input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from my_coupons WHERE my_coupons_id = " . $_GET['my_coupons_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=my_coupons&action=edit\" method=\"post\">
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
  <td class=sectiontableheader>Coupon Name: *</td>
  <td class=bstm_td>
<select name=coupon_id>
  <option>";
$select_query = tep_db_query("SELECT coupon_id as _key, coupon_name as value FROM coupon ORDER BY coupon_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['coupon_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>
<textarea rows=6 cols=50 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_redeemed_form')) 
  {
     $objects_query = tep_db_query("select * from my_coupons WHERE my_coupons_id = " . $_GET['my_coupons_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=my_coupons&action=redeem\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"redeem\">
    <input type=\"hidden\" name=\"coupon_id\" value=\"" . $objects['coupon_id'] . "\">\n";
echo "<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Store Name: *</td>
  <td class=bstm_td>
<select name=store_id>
  <option>";
$objects['store_id'] = '';$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   if (strpos($select['value'], "Any ") !== false) /* KAD added to take off the any to make it easier to search */
   {
      $select['value'] = substr($select['value'], 4);
   }
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Total Savings: *</td>
  <td class=bstm_td><input name=total_savings></td>
</tr>
</table>";
    echo "<input type=\"submit\">
    </form>
    </div> <!- content ->";
   return;
   }

  $rows = 0;
  echo "<a class=\"button\" href=index.php?view=my_coupons&action=display_create_form><span>Add a Coupon to My Collection</span></a>\n";
  echo "<table class=contenttoc width=\"100%\">";
  echo "<tr><td class=sectiontableheader align=center><b>Action</b></td><td class=sectiontableheader align=center><b>Coupon</b></td><td class=sectiontableheader align=center><b>Source</b></td><td class=sectiontableheader align=center><b>Expiration</b></td></tr>\n";

  $filter = "";

  $rows = 0;
  $objects_query = tep_db_query("SELECT my_coupons_id as id, my_coupons.*, user.*, coupon.*, source.source_name FROM my_coupons, user, coupon, source WHERE coupon.source_id = source.source_id AND my_coupons.coupon_id = coupon.coupon_id AND my_coupons.user_id = user.user_id AND my_coupons.user_id = '" . $user_id . "'" . $filter . "ORDER BY end_date");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['my_coupons_id'] . "\"></a><td class=bstm_td><a href=index.php?view=my_coupons&action=delete&my_coupons_id=" . $objects['my_coupons_id'] . ">Delete</a><br><a href=index.php?view=my_coupons&action=display_redeemed_form&my_coupons_id=" . $objects['my_coupons_id'] . ">Redeemed</a>";
echo "</td>  <td class=bstm_td><a href=index.php?view=coupon&title=" . urlencode($objects['coupon_name']) . "&action=display&coupon_id=" . $objects['coupon_id'] . ">" . displayField($objects['coupon_name'],'STRING','') . "</td><td class=bstm_td>" . $objects['source_name'] . "</td><td class=bstm_td>" . sqlToUserDate($objects['end_date']) . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}

?>
