<div class="moduletable"> <h3>Tips To Save</h3><div>
					


<table class="contentpaneopen">
	<tr>
		<td valign="top" ><p>
<?php

        $tip = getRandomTip();
        
        echo "<b>" . $tip['tip_name'] . "</b><p>";
        echo $tip['comments'];
function getRandomTip()
{
   $tip_query = tep_db_query("select count(*) as counter FROM tip");
   $tip = tep_db_fetch_array($tip_query);
   $numRows = $tip['counter'];
   $tip = array();
   while (strlen($tip['tip_name']) == 0)
   {
      $tipID = rand(1, $numRows);
      $tip_query = tep_db_query("select * FROM tip WHERE tip_id = " . $tipID);
      $tip = tep_db_fetch_array($tip_query);
   }
   return $tip;
}
?>
</p></td>
	</tr>
	<tr>
        <td valign="top" >

       		</td>
     </tr>
</table>
		</div>
