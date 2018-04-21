<div class="componentheading">Add Zone</div>
<?php 
  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) 
  {
     $email_address = tep_db_prepare_input($_POST['email_address']);
     $location = tep_db_prepare_input($_POST['location']);

     if (empty($_POST['email_address'])) 
     {
        $messageStack->add('Error: Email address is a required field');
     }
     if (empty($_POST['location'])) 
     {
        $messageStack->add('Error: Zone is a required field');
     }
     if ($messageStack->size > 0) 
     {
         echo $messageStack->output();
         return;
     }
     $sql_data_array = array('creation_date' => 'now()',
                             'created_by' => $user_id,
                             'modification_date' => 'now()',
                             'modified_by' => $user_id,
                             'email' => $email_address,
                             'location' => $location);
      tep_db_perform('new_zone', $sql_data_array, 'insert', "new_zone_id = " . $_POST['new_zone_id']);
   
      echo "Your request for a new Zone has been processed.  If you would like to accelerate the process, please invite your friends to join as well.";
      return;
  }

?>
<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
</script>


<form action="index.php?view=add_zone&action=process" method="post" id="josForm" name="josForm" class="form-validate">

Please send us your email address and we will notify you once we have collected 1000 users for that region.  If you would like to help us a long, feel free to tell your friends in your area as well.  Also, you might want to inquire about setting up your region on your own.

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
<tr>
	<td height="40">
		<label id="emailmsg" for="email_address">
			E-mail:
		</label>
	</td>
	<td>
		<input type="text" id="email_address" name="email_address" size="40" value="" class="inputbox required validate-email" maxlength="100" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="location" for="location">
			Zone 1:
		</label>
	</td>
	<td>
          <select name="location">
            <option>
<?php
$select_query = tep_db_query("SELECT reference_id AS _key, value FROM reference WHERE category = 'Future Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> *
</tr>
<tr>
	<td colspan="2" height="40">
		Fields marked with an asterisk (*) are required.	</td>
</tr>
</table>
	<button class="button validate" type="submit">Submit</button>
</form>
