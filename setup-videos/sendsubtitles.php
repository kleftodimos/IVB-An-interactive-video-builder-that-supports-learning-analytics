

<?php

require_once '../config/config.php';





$timestamps=json_decode($_POST['timestamps']); 
$num=$_POST['num'];
$videoid=$_POST['videoid'];
//$num=5;

echo $num;


/*$myfile = fopen("C://newfile.txt", "w") or die("Unable to open file!"); //debugging
$txt = "John Doe\n";
fwrite($myfile, $num);*/


//echo $comment;


for($i=0;$i<$num;$i++) {
	
	$start=$timestamps[$i]->start;
	$end=$timestamps[$i]->end;
	$text=$timestamps[$i]->comment;
	$sql="select * from video_subtitles where videoid='$videoid'";
	$result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
	if  ($num_rows ==0) {$maxsubtitleid=0;}
	else {
		 $sql="select max(subtitleid) maxid from video_subtitles where videoid='$videoid'";
		 fwrite($myfile, $sql);
		 $result = mysql_query($sql);
		 $row = mysql_fetch_array($result);
		 $maxsubtitleid=$row['maxid'];
	     }


    $subtitleid=$maxsubtitleid+1;
    $sql="insert into video_subtitles (subtitleid,videoid,start,end,text) values ('$subtitleid','$videoid','$start','$end','$text')";
    fwrite($myfile, $sql);
	$result = mysql_query($sql);
    }

//fclose($myfile);


?>



