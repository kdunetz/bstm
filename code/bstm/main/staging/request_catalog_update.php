<?php
$title = "";
$body = "";
$fieldLabel = "";
if ($_GET['category'] == 'product')
{
   $title = "Request Product?";
   $body = "Please enter the product(s) you would like added to the Bring Savings To Me catalog.  Provide the manufacturer, the brand name, and the type of product.  This process generally takes 24-72 hours to complete.  You will be notified once your data is added.  Please note that not all products will be accepted. ";
   $fieldLabel = "Requested Product(s)";
}
if ($_GET['category'] == 'store_restaurant')
{
   $title = "Request Store/Restaurant?";
   $body = "Please enter the Store(s) or Restaurant(s) you would like added to the Bring Savings To Me catalog.  This process generally takes 24-72 hours to complete.  You will be notified once your data is added.  Please note that not all stores/restaurants will be accepted. ";
   $fieldLabel = "Requested Store(s)/Restaurants(s)";
}
if ($_GET['action'] == 'add_product')
{
     $to = "admin@bringsavingstome.com"; 
     $subject = "Request Product Confirmation";
     $headers = "MIME-Version: 1.0" . "\r\n"; 
     $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
     //$headers .= "Content-type: multipart/alternative; boundary=" . $mime_boundary_header . "\r\n";
     $headers .= 'From: admin@bringsavingstome.com' . "\r\n";
     $body  = "Please add: " . $_POST['product'];
   
     echo "<div class=\"componentheading\">" . $title . "</div>\n";
     if (mail($to, $subject, $body, $headers)) 
     {
        echo "<p>Your information has been received.  We will reply back once your data has been added. <p>Thanks for using Bring Savings To Me.</p>\n";
     } 
     else 
     {
        echo "<p>There was an error with your message.  Please try again or just email your request to <a HREF=\"mailto:admin@bringsavingstome.com\">admin@bringsavingstome.com</a></p>\n";
      }

   return;
}
?>

<div class="componentheading">
<?php echo $title; ?>
</div>
<form action="/bstm/main/staging/index.php?view=request_catalog_update&action=add_product&category=<?php echo $_GET['category'] ?>" method="post" class="josForm form-validate">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
		<tr>
			<td colspan="2" height="40">
			<p>
<?php echo $body; ?>
                              </p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="product" class="hasTip" title="E-mail Address::Please enter the e-mail address for your account.">
<?php echo $fieldLabel; ?>
</label>
			</td>
			<td>
				<textarea rows=10 cols=30 id="product" name="product" type="text" class="required" /></textarea>
			</td>
		</tr>
	</table>

	<button type="submit" class="validate">Submit</button>
	</form>

