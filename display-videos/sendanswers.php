

<?php

require_once '../config/config.php';





$sessionid=$_POST['sessionid'];
$vid=$_POST['vid'];
$userid=$_POST['userid'];
$questionid=$_POST['questionid'];
$answerInt=$_POST['answerInt'];
$answerText=$_POST['answerText'];
$questionType=$_POST['questionType'];



    $sql="insert into session_video_quiz (sessionid,vid,userid,questionid,answerInt,answerText,date,time) values ('$sessionid','$vid','$userid','$questionid','$answerInt','$answerText', curdate(),curtime())";
    $result = mysql_query($sql);

	$file = fopen("test2.txt","w");
    fwrite($file,$sql);
    fclose($file);
    




?>



