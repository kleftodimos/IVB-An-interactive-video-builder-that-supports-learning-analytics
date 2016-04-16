<?php

require_once '../config/config.php';

$videourl=$_POST["videourl"];
$videotitle=$_POST["videotitle"];

$sql="select * from videos";
	$result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
	if  ($num_rows ==0) {$maxvideoid=1;}
	else {
		 $sql="select max(videoid) maxvideoid from videos";
		 $result = mysql_query($sql);
		 $row = mysql_fetch_array($result);
		 $maxvideoid=$row['maxvideoid'];
	     }

$videoid=$maxvideoid;
  

		
	     

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
  
                        
  
  <!--link rel="stylesheet" href="jquery-3.css" type="text/css" />
  <link rel="stylesheet" href="../build/mediaelementplayer.min.css" /-->

  
	  <title><?php echo $videotitle; ?></title>

                    
                
       
  <meta charset="utf-8" />
 </HEAD>

 <script>
 var gDuration=0
 </script>

 <div id="video" style="float:left; width:50%;">
 
<h2>Video Title: <?php echo $videotitle; ?></h2><br>

<!--video id="player1" width="600" height="420"-->
<video id="player1" width="500" height="380">
    <!--source src="<?php echo $videourl; ?>" type="video/youtube"-->
	<source src="https://www.youtube.com/watch?v=KaHr1_5ujoM" type="video/youtube">
	 <!--track kind="subtitles" src="../media/graphic_design.srt" srclang = "el" /-->
	 

</video>


<br><br><br>

<input type="button" id="button2" value="Store in DB" />
<!--button id="button1" type="button">transfer</button-->
<br>
<span id="time"></span>

<br>

<span id="duration"></span>
<br><br>



</div>



 <div id="video" style="float:right; width:50%;">
 <h3>Press the play button so the duration of the video is obtained</h3>

 <span id="duration2"></span>

 <form action="previewvideo.php" method="post">

<label for="FROM" class="required">Time sections split in minutes (Split video into intervals to track activity)</label><br>
<input type="number" name="time_sections_threshold" id="time_sections_threshold" value="" tabindex="1" required="required"><br><br>
<input type="checkbox" name="video_sections_bool" id="video_sections_bool" value="">Tick if you want to define logical sections in the video<br>


 </div>



 <script>

 function storeData()
{


     
    var time_sections_threshold=$('#time_sections_threshold').val();

	 var video_sections_bool=0;

	 if($("#video_sections_bool").is(':checked'))
		 {video_sections_bool=1;}
	 else
         {video_sections_bool=0;}

 

	

	gvideotitle="<?php echo $videotitle; ?>";
	gvideourl="<?php echo $videourl; ?>";
	gvideoid=<?php echo $videoid; ?>;

   
	$.post("send_video.php", {
		videoid: gvideoid,
		videourl:gvideourl,
		videotitle:gvideotitle,
	    time_sections_threshold:time_sections_threshold,
		video_sections_bool:video_sections_bool,
		duration:gDuration
		
		
	}, function(data) {
		//alert(data);
	});

    var urlstr="chooselements.php?videoid="+gvideoid+"&videourl="+gvideourl+"&videotitle="+gvideotitle+"";
	//alert (urlstr);
    window.location=urlstr;
    
	
}


  document.getElementById('button2')['onclick'] = function() {storeData();}

$('video').mediaelementplayer({
	//framesPerSecond: 20,
	features: ['playpause','progress','current','duration','tracks','volume'],
		
    // Hide controls when playing and mouse is not over the video
    
	
	
	success: function(me, node, player) {
		

		
old=0;
now=0;
eventtype=0;
gDuration=0;


gme=me;
gDuration=me.duration;
 

//time_cuepoints = parseInt(me.duration/interval);

var events = ['loadstart', 'play','pause', 'ended','seeking','volumechange', 'muted'];






me.addEventListener('timeupdate', function() {

document.getElementById('time').innerHTML = 'Time : '+ me.currentTime;
document.getElementById('duration').innerHTML = 'Duration : '+ me.duration;
document.getElementById('duration2').innerHTML = '<h3>Duration : '+ me.duration+'</h3>';
		now = parseInt(me.currentTime);
		gDuration=me.duration;
		
		//if(now > old){
        if (now!=old)
        {
		//showsection(now);
        }
        now=old;


		


	}, false);

}});
  
 </script>

 
 </BODY>
</HTML>