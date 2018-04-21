<div class="componentheading">My Stores/Restaurants</div>
Enter all the stores/restaurants that you typically shop at or eat in.  The software will then be able to better provide you the deals/coupons/sales at those locations. <p><p><p>

Store/Restaurant missing? Click <a href=index.php?view=request_catalog_update&category=store_restaurant>here</a> to request a store or restaurant be added to our catalog.<p><p><p>
<?php

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM my_stores WHERE my_stores_id = " . $_GET['my_stores_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE my_stores SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE my_store_id = " . $_GET['my_store_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

$display = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
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
'store_id' => $_POST['store_id'],
'user_id' => $_POST['user_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('my_stores', $sql_data_array, 'update', "my_stores_id = " . $_POST['my_stores_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      $display= "true";
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from my_stores WHERE store_id = " . $_POST['store_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'store_id' => $_POST['store_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('my_stores', $sql_data_array, 'insert', "my_stores_id = " . $_POST['my_stores_id']);

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
     echo "Please confirm you would like to delete this Store from your list<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=index.php?view=my_stores&action=delete_confirm&my_stores_id=" . $_GET['my_stores_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=index.php&view=my_stores>No</a>";
     }
     return;
  }
  if ((isset($_GET['action']) && ($_GET['action'] == 'display')) || $display == "true") 
  {
/* KAD leave off the ending quotes because it is an equation on the end */
if (!isset($_GET['my_stores_id']) && isset($_POST['my_stores_id']))
   $_GET['my_stores_id'] = $_POST['my_stores_id'];
     $objects_query = tep_db_query("SELECT my_stores.*,user.user_name,store.store_name FROM my_stores,user,store WHERE my_stores.store_id = store.store_id AND my_stores.user_id = user.user_id AND my_stores.my_stores_id = " . $_GET['my_stores_id']);
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
<a href=index.php?view=my_stores&action=list>Back to My Stores</a> |
<a href=index.php?view=my_stores&action=display_edit_form&my_stores_id=" . $objects['my_stores_id'] . ">Edit</a>\n<table width=100% border=1>
<tr>
  <td>Store Name: *</td>
  <td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>" .  $objects['comments']  . "</td>
</tr>\n";
/*
<tr>
  <td>Created By</td><td>" .  $objects['created_by'] . "</td></tr>
<tr>
  <td>Creation Date</td><td>" .  sqlToUserDate($objects['creation_date']) . "</td></tr>
<tr>
  <td>Modified By</td><td>" .  $objects['modified_by'] . "</td></tr>
<tr>
  <td>Modification Date</td><td>" .  sqlToUserDate($objects['modification_date']) . "</td></tr> */
echo "</table>

     </div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"index.php?view=my_stores&action=create\" method=\"post\">
    <input type=\"hidden\" name=\"view\" value=\"my_stores\">
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
  <td>Store Name: *</td>
  <td>
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
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=50 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from my_stores WHERE my_stores_id = " . $_GET['my_stores_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=my_stores&action=edit\" method=\"post\">
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
  <td>Store Name: *</td>
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
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=50 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_POST['action']) && ($_POST['action'] == 'update_my_stores')) 
  {
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store LEFT JOIN my_stores ON my_stores.store_id = store.store_id AND my_stores.user_id = " . $user_id . " ORDER BY value");
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
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store LEFT JOIN my_stores ON my_stores.store_id = store.store_id AND my_stores.user_id = " . $user_id . " ORDER BY value");
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
     $_GET['action'] = "display_my_stores"; /* fall through and redisplay the list of stores */
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_my_stores')) 
  {
     echo "<a class=\"button\" href=index.php?view=my_stores&action=update_stores><span>Add/Remove a Store/Restaurant</span></a><br>\n";
     echo "<div id=buttonspacer></div>\n";
     echo "<table class=contenttoc width=\"100%\">\n";
     echo "<tr>\n";
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store, my_stores WHERE store.store_id = my_stores.store_id AND my_stores.user_id = " . $user_id . " ORDER BY value");
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
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_stores')) 
  {
     echo "<form action=index.php?view=my_stores method=post>\n";
     echo "<input type=hidden name=\"action\" value=\"update_my_stores\">\n";
     echo "<table>\n";
     echo "<tr>\n";
     $select_query = tep_db_query("SELECT store.store_id as _key, store.store_name as value, my_stores.my_stores_id FROM store LEFT JOIN my_stores ON my_stores.store_id = store.store_id AND my_stores.user_id = " . $user_id . " ORDER BY value");
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
     return;
  }

  $rows = 0;
  echo "<a class=\"button\" href=index.php?view=my_stores&action=display_create_form><span>Add a Store or Restaurant to My Collection</span></a>\n";

  echo "<table class=contenttoc width=\"100%\">";
  echo "<tr><td class=sectiontableheader align=center><b>Action</b></td><td class=sectiontableheader align=center><b>Store</b></td></tr>\n";

  $filter = "";

  $rows = 0;
  $objects_query = tep_db_query("SELECT my_stores_id as id, my_stores.*, user.*, store.* FROM my_stores, user, store WHERE my_stores.store_id = store.store_id AND my_stores.user_id = user.user_id AND my_stores.user_id = '" . $user_id . "'" . $filter . "ORDER BY store_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['my_stores_id'] . "\"></a><td class=bstm_td><a href=index.php?view=my_stores&action=delete&my_stores_id=" . $objects['my_stores_id'] . ">Delete</a><br><a href=index.php?view=my_stores&action=display_edit_form&my_stores_id=" . $objects['my_stores_id'] . ">Edit</a>";
echo "</td>  <td class=bstm_td><a href=index.php?view=my_stores&action=display&my_stores_id=" . $objects['my_stores_id'] . ">" . displayField($objects['store_name'],'STRING','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td class=bstm_td colspan=3 align=center>No Results</td></tr>";
  }
  echo "</table>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}

?>
