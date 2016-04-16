

<?php

require_once '../config/config.php';





$sessionid=$_POST['sessionid'];
$vid=$_POST['vid'];
$eventtype=$_POST['eventtype'];
$sectionid=$_POST['sectionid'];
$videotime=$_POST['videotime'];
$percent=$_POST['percent'];
$percent=$_POST['percent'];
$content_table_bool=$_POST['content_table_bool'];



    $sql="insert into session_events (sessionid,vid,sectionid,eventtype,videotime,percent,content_table_bool,date,time) values ('$sessionid','$vid','$sectionid','$eventtype','$videotime','$percent','$content_table_bool', curdate(),curtime())";
    $result = mysql_query($sql);

	$file = fopen("test.txt","w");
    fwrite($file,$sql);
    fclose($file);
    




?>



