<div class="componentheading">Search Results</div>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'search')) 
  {
     if (isset($_POST['searchword'])) 
     {
        $filter = " AND (coupon_name LIKE '%" . $_POST['searchword'] . "%' OR product_name LIKE '%" . $_POST['searchword'] . "%')";
/* echo $filter; */
     }
     $id = $_GET['id'];

     $objects_query = tep_db_query("select *, datediff(end_date,curdate()) days_left from coupon, product WHERE coupon.product_id = product.product_id"  . $filter . " ORDER BY end_date"); 
     $rows = 0;
     $htmlbody .= "<table border=1><tr><td align=center><b>Coupon</b></td><td align=center><b>Discount</b></td><td align=center><b>End Date</b></td><td align=center><b>Days Left</b></td></tr>\n";
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;

        $packaging_size = $objects['packaging_size'];
        $packaging_size = str_replace(".0000", "", $packaging_size);
        $variable = $objects['packaging_quantity'] . " ". $packaging_size . " " . $objects['packaging_units'] . " " . $objects['packaging_type'];  

        if ($objects['packaging_quantity'] != "" && $objects['packaging_quantity'] != 1) $variable .= "s";

        /* clean up bad data before it is displayed */
        if (str_replace(" ", "", $variable) == "00s") $variable = "";
   
        if ($mobile)
        {
           echo "<div class=\"uip"; if ($rows == 1) echo " first"; if ($rows == sizeof($objects)) echo " last"; echo "\"><table class=\"template single two-column\" onclick=\"location.href='index.php?action=detail&id=" . $objects['coupon_id'] . "'\"><tr><td class=\"icon\" width=\"24\">" . $rows . ")</td><td class=\"right\">
        
           <table class=\"template\"><tr><td class=\"title-cell\"><div class=\"uic small first\"> <span class=\"title\">" . $objects['product_name'] . "</span><br/> 
           <span class=\"small\">" . $variable;  echo "</span> </div></td>
           <td class=\"value-cell\"><div class=\"uic small first\"> <span><strong>Save $" . $objects['discount'] . "</strong></span><br/> <span class=\"positive\">Expires " . sqltoUserDate($objects['end_date']) . "</span> </div></td></tr></table></td></tr></table></div>";
           if ($id == $objects['coupon_id']) print_coupon_details($objects);
         }
         else
         {
            $htmlbody .= "<tr" . $bgcolor ."><td align=center><a href=index.php?view=coupon&action=display&coupon_id=" . $objects['coupon_id'] . ">" . $objects['coupon_name'] . "</a></td><td align=right>" . ($objects['discount_units'] == 'Dollars'?"$":"") . $objects['discount'] . ($objects['discount_units'] == 'Percent'?"%":"") . "</td><td align=center>". sqlToUserDate($objects['end_date']) . "</td><td align=center>" . $objects['days_left'] . "</td></tr>\n";
         }
      }
      if (!$mobile)
         $htmlbody .= "</table>\n";

      if ($rows == 0)
      {
         //echo "</div>";
         if ($mobile)
            echo "<div class=\"uip first\"><table class=\"items\"><tr><td class=\"blocks\" align=center><div class=\"uic small first\"> <strong>No Results</strong> </div></span> </div></td></tr></table></div>";
         else
            echo "<tr><td colspan=3>NO RESULTS</td></tr>\n";
       //return;
      }
      if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
      {
         //return;
      }
      if (!$mobile)
         echo $htmlbody;
  }
?>
