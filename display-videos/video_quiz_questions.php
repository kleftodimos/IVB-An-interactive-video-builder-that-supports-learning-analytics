<?php

require_once '../config/config.php';


$videoid=$_GET['videoid']; 

//$videoid=1;



 $data=array();
 //unset($data);

 $data2=array();

 

 class quiz_store { 
	public  $qid;
    public $start; 
    public $endl;
	public $Question;
	public $Answer1;
	public $Answer2;
	public $Answer3;
	public $Answer4;
	public $Answer5;
} 

$sql="select * from video_quiz where videoid='$videoid' order by qid";
$result = mysql_query($sql);
$num_rows = mysql_num_rows($result);
while($row = mysql_fetch_array($result))
  {   

	$quizobj=new quiz_store();
    $quizobj->qid = $row['qid'];
	$quizobj->start = $row['start'];
    $quizobj->endl = $row['end'];
    $quizobj->Question = $row['question'];
	$quizobj->Answer1 = $row['answer1'];
	$quizobj->Answer2 = $row['answer2'];
	$quizobj->Answer3 = $row['answer3'];
	$quizobj->Answer4 = $row['answer4'];
	$quizobj->Answer5 = $row['answer5'];
	$quizobj->Submitted = 0;
	


	array_push($data2, $quizobj);
     

  $data = array(
		    "videoid" => $videoid,
			"num_quiz_questions"=>$num_rows,
		    "quiz_questions"  =>$data2
		 
            );
	 
 //echo json_encode($data);

  }




?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <!--script src="http://code.jquery.com/jquery-1.7.1.min.js"></script-->
  <script src="../build/jquery.js"></script>	
  <!--script src="../build/mediaelement.js"></script-->
  <script src="../build/mediaelement-and-player.min.js"></script>
  <script src="testforfiles.js"></script>
  <link rel="stylesheet" href="jquery-3.css" type="text/css" />
  <link rel="stylesheet" href="../build/mediaelementplayer.min.css" />
  
	<title>Video Production Principles</title>
	<meta charset="utf-8" />
 </HEAD>

 <BODY>

 

 <div id="video" style="float:left; width:50%;">
 <h2>Video Production Principles</h2>
<video width="640" height="480" id="player1"  controls="controls">
<source src="../media/graphic_design.mp4" type="video/mp4">
<track kind="subtitles" src="../media/graphic_design.mp4"  />

</video>


<br>
<span id="time"></span>
</div>





<br><br>

<div class="container2" style="float:right; width:50%;">
<br><br><br><br><br>
 <span id="label"></span>

 </div>





<script>

 var timestamps = <?php echo json_encode($data); ?>;

// alert (timestamps.quiz_questions[0].Question);
 //alert('hello');


var last = 0,
now,
old;

var gComment='';
var gme;
var gi=0;


function handleSubmitquiz() {

gme.play();
timestamps.quiz_questions[gi].Submitted=1;

}

function showsection(t){
var Question, Answer1,Answer2,Answer3,Answer4,Answer5;
var AnswerallText='';

var lSubmitted;
var comment='';
      for(i=0;i<timestamps.num_quiz_questions; i++){
        if(t >= timestamps.quiz_questions[i].start && t <= timestamps.quiz_questions[i].endl){
			 Question=timestamps.quiz_questions[i].Question;
			 Answer1=timestamps.quiz_questions[i].Answer1;
			 Answer2=timestamps.quiz_questions[i].Answer2;
			 Answer3=timestamps.quiz_questions[i].Answer3;
			 Answer4=timestamps.quiz_questions[i].Answer4;
			 Answer5=timestamps.quiz_questions[i].Answer5;

			
			
             var formstart=' <form name="form1">';
			 var Question=Question+'<br>';
			 
			 if (Answer1!='') {AnswerallText=AnswerallText+'<input type="radio" name="1" value="1">'+Answer1+'<BR>';}
			 if (Answer2!='') {AnswerallText=AnswerallText+'<input type="radio" name="2" value="2">'+Answer2+'<BR>';}
			 if (Answer3!='') {AnswerallText=AnswerallText+'<input type="radio" name="3" value="3">'+Answer3+'<BR>';}
			 if (Answer4!='') {AnswerallText=AnswerallText+'<input type="radio" name="4" value="4">'+Answer4+'<BR>';}
			 if (Answer5!='') {AnswerallText=AnswerallText+'<input type="radio" name="5" value="5">'+Answer5+'<BR>';}
			
             

		     var formend='<input name="SubmitQuiz"  type="button" value="Submit" onClick="JavaScript:handleSubmitquiz()"></form>';

             
            
			if (timestamps.quiz_questions[i].Submitted==0)
			{
				comment=formstart+Question+ AnswerallText+formend;
				gme.pause();
				gi=i;

			}
			
		 
           } 

		  }

    if (comment!=gComment)
    {
	document.getElementById('label').innerHTML = comment;
	
	gComment=comment;
	
    }

	
      
    };





MediaElement('player1', {success: function(me) {


old=0;
now=0;
	
	//me.play();
	gme=me;
	me.addEventListener('timeupdate', function() {
		document.getElementById('time').innerHTML = 'Time : '+ me.currentTime;
		now = parseInt(me.currentTime);
		
        if (now!=old)
        {
		showsection(now);
        }
        now=old;


		

	}, false);

}});




</script>
  



 </BODY>
</HTML>
