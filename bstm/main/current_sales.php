<div class="moduletable"> <h3>Current Sales</h3><div>
					


<table class="contentpaneopen">
	<tr>
		<td valign="top" ><p>
<?php
 
  if (tep_session_is_registered('user_id')) 
     echo sqlQuery("SELECT concat('<a href=index.php?action=display&view=sale&sale_id=', sale_id, '>', sale_name, '</a>') as 'Sale' FROM sale, my_stores WHERE sale.store_id = my_stores.store_id AND my_stores.user_id = " . $user_id . " AND datediff(sale.end_date, curdate()) >= 0 AND datediff(sale.begin_date, curdate()) <= 0 ORDER BY end_date DESC limit 0, 15");
  else
     echo sqlQuery("SELECT concat('<a href=index.php?action=display&view=sale&sale_id=', sale_id, '>', sale_name, '</a>') as 'Sale' FROM sale ORDER BY end_date DESC limit 0, 15");

?>
</p></td>
	</tr>
	<tr>
        <td valign="top" >

       		</td>
     </tr>
</table>
		</div>
