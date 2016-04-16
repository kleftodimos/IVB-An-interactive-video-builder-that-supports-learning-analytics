<?php

require_once '../config/config.php';



session_start();
if(!isset($_SESSION['mysid'])){
header("location:main_login.php");}

if(!isset($_GET['videoid'])){
header("location:main_login.php");}


require_once '../config/config.php';

$sessionid=$_SESSION['mysid'];
$videoid=$_GET['videoid']; 

$sql="select * from videos where videoid='$videoid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$videotitle=$row['videotitle'];
$videourl=$row['videourl'];

$sql="select * from sessions where sessionid='$sessionid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$userid=$row['user_id'];




 $data=array();
 //unset($data);

 $data2=array();

 

 class urls_store { 
	public  $urlid;
    public $start; 
    public $endl;
	public $text;
	public $isEmbedCode;
} 

$sql="select * from video_url_code where videoid='$videoid' order by urlid";
$result = mysql_query($sql);
$num_rows = mysql_num_rows($result);
while($row = mysql_fetch_array($result))
  {   
    $urlid=$row['urlid'];
	$start=$row['start'];
	$end=$row['end'];
	$text=$row['text'];
	$isEmbedCode=$row['isembedcode'];

	$urlobj=new urls_store();
    $urlobj->urlid = $row['urlid'];
	$urlobj->start = $row['start'];
    $urlobj->endl = $row['end'];
    $urlobj->text = $row['text'];
	$urlobj->isEmbedCode = $row['isembedcode'];
	array_push($data2, $urlobj);
     

  $data = array(
		    "videoid" => $videoid,
			"numurls"=>$num_rows,
		    "urls"  =>$data2
		 
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
  
	

     <title><?php echo $videotitle; ?></title>
	<meta charset="utf-8" />
 </HEAD>

 <BODY>

 

<div id="video" style="float:left; width:50%;">

<h2>Video Title: <?php echo $videotitle; ?></h2><br>
 

<video id="player1" width="500" height="380">
    <source src="<?php echo $videourl; ?>" type="video/youtube" >
	 <!--track kind="subtitles" src="../media/graphic_design.srt" srclang = "el" /-->
	 

</video>


<br>

<span id="time"></span><br>
<span id="percent"></span><br>

</div>







<br><br>

<!--div class="container1" style="float:right; width:50%;">
<br><br>
 <span id="label"></span>

 </div-->
<div id="space" style="float:right; width:50%;">
<br><br>
 <span id="label"></span>

 </div>






<script>

var timestamps = <?php echo json_encode($data); ?>;
 var gSubmitted= [];
 gSubmitted.length = timestamps.numurls;
 gSubmitted.fill(0);

 var gme;
 var gi;
 var last = 0,
  now,
  old;

var gurltext='';



 
 
 function handleSubmitquiz() {
	gme.play();
	//timestamps[gi].Submitted=1;
	gSubmitted[gi]=1;
}








var gText='';

function showtime(ltime){
	var timetmp=ltime;
	var hrs = Math.floor(timetmp/3600);
    timetmp = timetmp - 3600 * hrs;
	var mins = Math.floor(timetmp/60);
	timetmp = timetmp - 60 * mins;
	var secs = Math.floor(timetmp);
	var ltimetext = (hrs < 10 ? "0" : "" ) + hrs + ":" 
				 + (mins < 10 ? "0" : "" ) + mins + ":" 
				 + (secs < 10 ? "0" : "" ) + secs;
	return ltimetext;


}

function showsection(t){
var urltext='';
var isEmbedCode=0;
var finaltext='';
//there is a fucking error here and i dont know what...bye
   t = parseInt(gme.currentTime);
 
      for(i=0; i<timestamps.numurls; i++){
        if(t >= timestamps.urls[i].start && t <= timestamps.urls[i].endl){
			//alert(timestamps[i].comment);
			 
			 urltext=timestamps.urls[i].text;
			 isEmbedCode=timestamps.urls[i].isEmbedCode;

             gi=i;

			 
			 if (isEmbedCode==0)
			 {
			 urltext="<a href='"+ urltext+"' target='_blank'>"+urltext+"</a>";
			// comment='hello';
			 } 
			 else
			 {
             urltext = urltext.replace("&lt;", "<");
			 }
              
			 
			 
    
			 var formend='<form name="form1" id="submitform"><input name="SubmitQuiz"  type="button" value="Continue" onClick="JavaScript:handleSubmitquiz()"></form>';
			 finaltext=urltext+'<br><br>'+formend;
             
			 //alert(finaltext);
			 
             //document.getElementById('label').innerHTML = finaltext;
			 if (gSubmitted[i]==0) {gme.pause();}
			 
           } 

		  } 


		  if (urltext!=gurltext){
          
           if (gSubmitted[gi]==0) {document.getElementById('label').innerHTML = finaltext;}
		   else {document.getElementById('label').innerHTML = urltext;}
		   gurltext=urltext;

		  }

		 
   

    };




$('video').mediaelementplayer({
	//framesPerSecond: 20,
	features: ['playpause','progress','current','duration','tracks','volume'],
		
    // Hide controls when playing and mouse is not over the video
    
	
	
	success: function(me, node, player) {



	gme=me;
	old=0;
	now=0;
 

//time_cuepoints = parseInt(me.duration/interval);

var events = ['loadstart', 'play','pause', 'ended','seeking','volumechange', 'muted'];

me.addEventListener('timeupdate', function() {

document.getElementById('time').innerHTML = 'Time : '+ me.currentTime;
		now = parseInt(me.currentTime);
		timetext=showtime(me.currentTime);
        //document.getElementById('duration').innerHTML = 'Duration: '+durationtext;
		document.getElementById('time').innerHTML = 'Time : '+ timetext;
		percent=parseInt(me.currentTime/me.duration *100);
		document.getElementById('percent').innerHTML = 'percent : '+ percent;
		
		//if(now > old){
        if (now!=old)
        {
		old=now;
		showsection(now);
        }


		


	}, false);

}});




</script>
  



 </BODY>
</HTML>
