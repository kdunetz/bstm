<div class="componentheading"> List of Coupon Sites</div>
<p>
<?php
echo sqlQuery("SELECT concat('<a HREF=', url ,'>', website_name, '</a>') as 'Website Name' FROM website ORDER BY website_name");
?>
</div>

