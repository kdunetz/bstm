<?php 
$objectName = "SQL";

  if (strpos(strtoupper($_POST['sql_statement']), "DELETE") !== false && isset($_POST['action']) && ($_POST['action'] == 'execute_sql') && strlen($_POST['sql_statement']) > 0) 
  {
tep_db_query(stripslashes($_POST['sql_statement']));
echo "<center>" . mysql_affected_rows() . " rows updated</center>";
  }
  else if (strpos(strtoupper($_POST['sql_statement']), "UPDATE") !== false && isset($_POST['action']) && ($_POST['action'] == 'execute_sql') && strlen($_POST['sql_statement']) > 0) 
  {
tep_db_query(stripslashes($_POST['sql_statement']));
echo "<center>" . mysql_affected_rows() . " rows updated</center>";
  }
  else if (strpos(strtoupper($_POST['sql_statement']), "ALTER") !== false && isset($_POST['action']) && ($_POST['action'] == 'execute_sql') && strlen($_POST['sql_statement']) > 0) 
  {
tep_db_query(stripslashes($_POST['sql_statement']));
echo "<center>" . mysql_affected_rows() . " rows updated</center>";
  }
  else if (!strpos(strtoupper($_POST['sql_statement']), "SELECT") && isset($_POST['action']) && ($_POST['action'] == 'execute_sql') && strlen($_POST['sql_statement']) > 0) 
  {
     $rows = 0;
     echo "<div align=\"center\">\n";
     echo "<table class=contenttoc border=1 width=100%>\n";
     $objects_query = tep_db_query(stripslashes($_POST['sql_statement']));
     //if ($objects_query.size > 0)
     while ($objects = tep_db_fetch_array($objects_query)) 
     {
        $rows++;
        $header = $objects;
        if ($rows == 1)
        {
           echo "<tr>";
           while(list($key,$value) = each($header)) 
           {
               echo "<td class=sectiontableheader><b>" . str_replace("_"," ",strtoupper($key)) . "</b></td>\n";
           }
           echo "</tr>\n";
        }
        echo "<tr>";
        while(list($key,$value) = each($objects)) 
        {
            if (strpos($key,'date') >= 0 && strpos($key, 'date') != false) $value = sqlToUserDate($value);
//echo $key . "," . $value . "," . strpos($key,'date') . "<br>";
            echo "<td class=bstm_td>" . displayField($value,'STRING','') . "</td>\n";
        }
        echo "</tr>\n";
     }
     if ($rows == 0)
     {
        echo "<tr><td class=bstm_td colspan=5 align=center>No Results</td></tr>\n";
     }
     echo "</table>\n";
     echo "</div>\n";
     echo "<br>\n";
  }
  if (true) 
  {
    echo "<div align=center id=\"content\">
    <form action=\"index.php?view=admin&tool=sql\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"execute_sql\">
    <table class=contenttoc width=100% border=1>
    <tr>
      <td class=sectiontableheader>SQL:</td>
      <td class=bstm_td><textarea rows=10 cols=30 name=sql_statement>" . stripslashes($_POST['sql_statement']) . "</textarea></td>
    </tr>
    </table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
  }
