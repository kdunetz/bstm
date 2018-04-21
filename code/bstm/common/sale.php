<p>
<center><h3><font color=blue>Sale</font></h3></center>
<p>
<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "sale.php?";
     $urlPrefixShort = "sale.php";
  }
  else
  {
     $urlPrefix = "index.php?view=sale&";
     $urlPrefixShort = "index.php?view=sale";
  }

  if ($mobilesite == "true")
  {
    require('configure.php');
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

    if (!tep_session_is_registered('user_id')) {
      //$navigation->set_snapshot();
      tep_redirect(tep_href_link('index.php', '', 'SSL'));
    }
  }

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM sale WHERE sale_id = " . $_GET['sale_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE sale SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE sale_id = " . $_GET['sale_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['sale_name'])) {
   $messageStack->add('Sale Name is required');
}
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['begin_date'])) {
   $messageStack->add('Begin Date is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['zip_code'])) {
   $messageStack->add('Zip Code is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
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
'sale_name' => $_POST['sale_name'],
'store_id' => $_POST['store_id'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'zip_code' => $_POST['zip_code'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('sale', $sql_data_array, 'update', "sale_id = " . $_POST['sale_id']);

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
if (empty($_POST['sale_name'])) {
   $messageStack->add('Sale Name is required');
}
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['begin_date'])) {
   $messageStack->add('Begin Date is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['zip_code'])) {
   $messageStack->add('Zip Code is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from sale WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'sale_name' => $_POST['sale_name'],
'store_id' => $_POST['store_id'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'zip_code' => $_POST['zip_code'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('sale', $sql_data_array, 'insert', "sale_id = " . $_POST['sale_id']);

      }
      else
      {
         $messageStack->add('This record has already been loaded'); 
         if ($messageStack->size > 0) 
         { 
            echo $messageStack->output(); 
            include($hfPrefix . "footer.php");
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
     echo "Please confirm you would like to delete this sale<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&sale_id=" . $_GET['sale_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=" . $urlPrefixShort . ">No</a>";
     }
     include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
    if (!isset($_GET['sale_id']) && isset($_POST['sale_id']))
        $_GET['sale_id'] = $_POST['sale_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT sale.*, store.store_name FROM sale, store WHERE store.store_id = sale.store_id AND sale.sale_id = " . $_GET['sale_id']);
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
     {
        echo "<a href=" . $urlPrefix . "action=display_edit_form&sale_id=" . $objects['sale_id']. "&redirect_url="; echo urlencode("sale.php?action=display&sale_id=" . $objects['sale_id'] . ""); echo "&sale_id=" . $objects['sale_id']; echo ">Edit</a>\n";
     }
echo "<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader><b>Sale Name</b></td>
  <td class=bstm_td>" .  $objects['sale_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader><b>Store Name</b></td>
  <td class=bstm_td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader><b>Begin Date</b></td>
  <td class=bstm_td>" . sqlToUserDate( $objects['begin_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader><b>End Date</b></td>
  <td class=bstm_td>" . sqlToUserDate( $objects['end_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader><b>Comments</b></td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>
</tr>
</table>\n";
echo "<br>\n";
     if (($role == 'admin' || $objects['user_id'] == $user_id) && tep_session_is_registered('user_id'))
     {
        echo "<a href=sale_line_item.php?action=display_create_form&redirect_url="; echo urlencode("sale.php?action=display&sale_id=" . $objects['sale_id'] . ""); echo "&sale_id=" . $objects['sale_id'] . ">Add Sale Line Item</a>";
    }
  echo "<table class=contenttoc border=1 width=\"100%\">\n";
  echo "<tr><td class=sectiontableheader align=center><b>Name</b></td><td class=sectiontableheader align=center><b>Product Name</b></td><td class=sectiontableheader align=center><b>Price</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT sale_line_item.*, product.product_name FROM sale_line_item, product WHERE sale_line_item.product_id = product.product_id AND sale_line_item.sale_id = " . $objects['sale_id']);
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     $priceString = "";

     if ($objects['price'] == 0)
         $priceString = $objects['special_promotion'];
      else
         $priceString = displayField($objects['price'],'NUMBER','$###,###.00');

     echo "<tr>\n";
     echo "<td class=bstm_td><a href=index.php?view=sale_line_item&action=display&sale_line_item_id=" . $objects['sale_line_item_id'] . ">" . displayField($objects['sale_line_item_name'],'STRING','') . "</a></td>  <td class=bstm_td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td  class=bstm_td align=right>" . $priceString . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";
     include($hfPrefix . "footer.php");
     return;
  }
?>
