

<?php

require_once '../config/config.php';






$timestamps=json_decode($_POST['timestamps']); 
$num=$_POST['num'];
$videoid=$_POST['videoid'];
//$num=5;

//echo $comment;

$answers=array();

for($i=0;$i<$num;$i++) {
	$start=$timestamps[$i]->start;
	$end=$timestamps[$i]->end;
	$title=$timestamps[$i]->Section;
	


	

	$sql="select * from video_quiz where videoid='$videoid'";
	$result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
	if  ($num_rows ==0) {$maxsectionid=0;}
	else {
		 $sql="select max(sectionid) maxsectionid from video_sections where videoid='$videoid'";
		 $result = mysql_query($sql);
		 $row = mysql_fetch_array($result);
		 $maxsectionid=$row['sectionid'];
	     }


    $sectionid= $maxsectionid+1;
    $sql="insert into video_sections (videoid,sectionid,title,start,end) values ('$videoid','$sectionid','$title','$start','$end')";
    $myfile = fopen("C://sql.txt", "w") or die("Unable to open file!");
    
    fwrite($myfile, $sql);

    fclose($myfile);

    $result = mysql_query($sql);
    }




?>



