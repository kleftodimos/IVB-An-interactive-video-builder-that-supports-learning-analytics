

<?php

require_once '../config/config.php';






$timestamps=json_decode($_POST['timestamps']); 
$num=$_POST['num'];
$videoid=$_POST['videoid'];
//$num=5;

//echo $comment;


for($i=0;$i<$num;$i++) {
	$start=$timestamps[$i]->start;
	$end=$timestamps[$i]->end;
	$text=$timestamps[$i]->comment;
	$isEmbedCode=$timestamps[$i]->isEmbedCode;
	$sql="select * from video_url_code where videoid='$videoid'";
	$result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
	if  ($num_rows ==0) {$maxurlid=0;}
	else {
		 $sql="select max(urlid) maxid from video_url_code where videoid='$videoid'";
		 $result = mysql_query($sql);
		 $row = mysql_fetch_array($result);
		 $maxurlid=$row['urlid'];
	     }


    $urlid=$maxurlid+1;
    $sql="insert into video_url_code (urlid,videoid,start,end,text,isembedcode) values ('$urlid','$videoid','$start','$end','$text','$isEmbedCode')";
    $result = mysql_query($sql);
    }




?>



