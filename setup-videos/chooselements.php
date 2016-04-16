
<?php

require_once '../config/config.php';

$videourl=$_GET["videourl"];
$videotitle=$_GET["videotitle"];
$videoid=$_GET["videoid"];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
  <!--script src="http://code.jquery.com/jquery-1.7.1.min.js"></script-->
  <script src="../build/jquery.js"></script>	
  <!--script src="../build/mediaelement.js"></script-->
  <script src="../build/mediaelement-and-player.min.js"></script>
  <script src="testforfiles.js"></script>

  <style type="text/css">
   .style1{
	font-size: 14px;
	
   }

   .style2 {
	font-size: 14px;
   }
  </style>
  
  <link rel="stylesheet" href="jquery-3.css" type="text/css" />
  <link rel="stylesheet" href="../build/mediaelementplayer.min.css" />

<br><br><br>

<form align="center">
Click Here to set Sections<br>
<input type="button" id="button1" value="Sections" /><br>


<!--input type="checkbox" id="content_table" value="">Tick if you want a table of contents (derived from the sections)<br--><br>

Click Here to set Questions<br>
<input type="button" id="button2" value="Questions" /><br><br>

Click Here to set Internet resources<br>
<input type="button" id="button3" value="Internet Resources" /><br><br>

Click Here to set Subtitles<br>
<input type="button" id="button4" value="Subtitles" /><br>


</form>

<script>

var gvideourl="<?php echo $videourl; ?>";
var gvideoid="<?php echo $videoid; ?>";
var gvideotitle="<?php echo $videotitle; ?>";

document.getElementById('button1')['onclick'] = function() {setSections(); }
document.getElementById('button2')['onclick'] = function() {setQuestions();}
document.getElementById('button3')['onclick'] = function() {setInternetResources();}
document.getElementById('button4')['onclick'] = function() {setSubtitles();}



function setSections(){

 var urlstr="createsections.php?videoid="+gvideoid+"&videourl="+gvideourl+"&videotitle="+gvideotitle+"";
	//alert (urlstr);
 window.location=urlstr;

}

function setQuestions(){
  var urlstr="createquizquestions.php?videoid="+gvideoid+"&videourl="+gvideourl+"&videotitle="+gvideotitle+"";
	//alert (urlstr);
 window.location=urlstr;

}

function setInternetResources(){
 var urlstr="createurls.php?videoid="+gvideoid+"&videourl="+gvideourl+"&videotitle="+gvideotitle+"";
	//alert (urlstr);
 window.location=urlstr;

}


function setSubtitles(){
 var urlstr="createsubtitles.php?videoid="+gvideoid+"&videourl="+gvideourl+"&videotitle="+gvideotitle+"";
	//alert (urlstr);
 window.location=urlstr;

}






</script>