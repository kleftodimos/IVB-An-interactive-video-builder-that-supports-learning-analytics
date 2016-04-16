

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
	$Question=trim($timestamps[$i]->Question);
	$Answer1=trim($timestamps[$i]->Answers[1]);
	$Answer2=trim($timestamps[$i]->Answers[2]);
	$Answer3=trim($timestamps[$i]->Answers[3]);
	$Answer4=trim($timestamps[$i]->Answers[4]);
	$Answer5=trim($timestamps[$i]->Answers[5]);
	$HasAnswers=trim($timestamps[$i]->HasAnswers);


    if ($HasAnswers>0) {$questionType=1;} else {$questionType=2;}
   
    $sql="insert into video_quiz (videoid,start,end,question,questionType, answer1,answer2,answer3,answer4,answer5) values ('$videoid','$start','$end','$Question','$questionType','$Answer1','$Answer2','$Answer3','$Answer4','$Answer5')";
    $myfile = fopen("sql.txt", "w") or die("Unable to open file!");
    
    fwrite($myfile, $sql);

    fclose($myfile);

    $result = mysql_query($sql);
    }




?>



