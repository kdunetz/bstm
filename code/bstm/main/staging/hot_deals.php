<?php
    $deal = getRandomDeal(); 
    if (strlen($deal['deal_name']) == 0) return;
?>
<div class="moduletable"> <h3>Hot News</h3><div>
					


<table class="contentpaneopen">
	<tr>
		<td valign="top" ><p>
<?php

//print_r($deal);
        echo "<b>" . $deal['deal_name'] . "</b><p>";
        echo $deal['comments'];
function getRandomDeal()
{
  global $location_filter;
        $deal_query = tep_db_query("select max(deal_id) as counter FROM deal");
        $deal = tep_db_fetch_array($deal_query);
        $numRows = $deal['counter'];
        $deal = array();
        $counter = 0;
        while (strlen($deal['deal_name']) == 0 && $counter++ < 10)
        {
           $dealID = rand($numRows - 20, $numRows);
           $deal_query = tep_db_query("select * FROM deal WHERE deal_id = " . $dealID . " AND end_date >= now() AND user_id IS NULL");
           $deal = tep_db_fetch_array($deal_query);
           if (strlen($deal['location']) > 0 && strpos($location_filter, $deal['location']) === false)
           {
               $deal = array();
           }
        }
    return $deal;
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
