<?php
mysql_connect("localhost","root","") or die("Could not connect" . mysql_error());
mysql_select_db("videoapp");
mysql_query("SET NAMES 'UTF8'");
//mysql_query("SET CHARACTER SET 'greek'");
 
?>