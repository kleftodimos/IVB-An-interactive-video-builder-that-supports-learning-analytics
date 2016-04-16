<?php

require_once '../config/config.php';

$file = 'results_2.txt';
// The new person to add to the file
$res= 'hello there';
//$res= $UserId.' Exid '.$Exercise_Id.' name'.$Exercise_Name.PHP_EOL;

// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($file, $res, FILE_APPEND | LOCK_EX);


$UserId = $_POST['userid'];
$Exercise_Name = $_POST['exercisename'];
$Exercise_Id = $_POST['exerciseid'];

$Score = $_POST['score'];
$Start_Time = $_POST['starttime'];
$End_Time = $_POST['endtime'];
$All_Done = $_POST['alldone'];
$vid=$_POST['vid'];
$sessionid=$_POST['sessionid'];

//echo ("Realname".$realname.'<br>');
//echo ("Score".$Score.'<br>');
//echo ("starttime".$Start_Time.'<br>');
//echo ("endtime".$End_time.'<br>');

$Start_Time=str_replace(",","",$Start_Time);
$End_Time=str_replace(",","",$End_Time);

$sql="INSERT INTO session_potatoes (userid,sessionid,vid,exerciseid,exercisename,score,starttime,endtime,alldone,date,time) values ($UserId,$sessionid,$vid,'$Exercise_Id','$Exercise_Name',$Score,STR_TO_DATE('$Start_Time', '%d/%m/%Y %H:%i:%s'),STR_TO_DATE('$End_Time', '%d/%m/%Y %H:%i:%s'),$All_Done,curdate(), curtime())";

$result=mysql_query($sql);


$file = 'results.txt';
// The new person to add to the file
$res= $sql.PHP_EOL.$Exercise_Name;
//$res= $UserId.' Exid '.$Exercise_Id.' name'.$Exercise_Name.PHP_EOL;

// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($file, $res, FILE_APPEND | LOCK_EX);
?>