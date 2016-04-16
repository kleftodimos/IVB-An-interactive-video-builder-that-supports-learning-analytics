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


  
	  <title>Subtitles</title>

                    
                
  
 </HEAD>

 <script>
  var gvideourl="<?php echo $videourl; ?>";
  var gvideoid="<?php echo $videoid; ?>";
  var gvideotitle="<?php echo $videotitle; ?>";
 

 </script>



 <div id="video" style="float:left; width:50%;">
 <h3><?php echo $videotitle; ?></h3>


<!--video id="player1" width="600" height="420"-->
<video id="player1" width="500" height="380">
 <source src="<?php echo $videourl; ?>" type="video/youtube">	 
    <!--source src="https://www.youtube.com/watch?v=KxJWF36SANU??vq=hd1080" type="video/youtube" -->
	 <!--track kind="subtitles" src="../media/graphic_design.srt" srclang = "el" /-->
	 

</video>


<br>
<input type="button" id="button1" value="Preview" />
<input type="button" id="button2" value="Store in DB" />
<!--button id="button1" type="button">transfer</button-->
<span id="time"></span>
<br><br>

<div class="container">
 <span id="label"></span>

 <br><br>
 
</div>

<br><input type="button" id="button3" value="Return to choose other elements" />



<br><br>
<br><span id="examplecomframe"></span>

 </div>

<div id="respond" style="float:right; width:50%;">


      <h3>Set subtitles</h3>

    <form name="commentform" >
      
     

        <label for="FROM" class="required">From</label><br>
        <input type="number" name="from" id="from" value="" tabindex="1" required="required"><br>
        
        <label for="TO" class="required">To</label><br>
        <input type="number" name="to" id="to" value="" tabindex="2" required="required"><br>

		

        <label for="comment" class="required">Type in subtitle</label><br>
        <textarea name="comment" id="comment" type="text" cols="50" rows="7" tabindex="4"  required="required"></textarea><br><br>

		<input name="Submit"  type="button" value="Sumbit" onClick="JavaScript:handleSubmit()">

       <!--button id="button" type="button">transfer</button-->
        </form>
      
      
    
 <div>Subtitles here: <span id="commentSection"></span></div>

 </div>


<script>

var count=0;
var timestamps = [];
var all=0;
var gComment="";

var last = 0,
now,
old;


var gme;
var gi;



$('#commentSection').html('.....<br>');

function getComments()
{

timestamps = [];

$('article').each(function(o){
      if($(this).attr('data-start')){
	   
	    var lcommenttext=$(this).text();
		var offset=lcommenttext.indexOf("Comment:");
		offset=offset+8;
		lcommentlen=lcommenttext.length;
		var lcomment = lcommenttext.substr(offset, lcommentlen);
        timestamps.push({
          start : +$(this).attr('data-start'),
          end : +$(this).attr('data-end'),
          comment : lcomment
        });
      }
    });

all = timestamps.length;
}


function storeComments()
{

	$.post("sendsubtitles.php", {
		timestamps:JSON.stringify(timestamps),
		num:all,
		videoid: gvideoid
	}, function(data) {
		//alert(data);
	});
	
}

function ReturntoSetElements()
{

var urlstr="chooselements.php?videoid="+gvideoid+"&videourl="+gvideourl+"&videotitle="+gvideotitle+"";
	//alert (urlstr);
window.location=urlstr;

}



function createComment(data) {
  count=count+1;
  var html = '' +
  '<div><article id="' + count + '" data-start="'+data.from+'"'+' data-end="'+data.to+'"  class="hentry">' + 
    '<div>from:'+data.from+' to: '+data.to+' ' +'<br>Comment:'+
	'<br><span id="datacomment">'+data.comment+'</span></div>' +
	//  '<p>'+data.comment+'</p></div>'+ 

  '</article> <a href="#" class="remove_field">Remove</a></div>';

  
  return html;
}





function displayComment(data) {
  var commentHtml = createComment(data);
  
// alert(commentHtml);
$('#commentSection').append(commentHtml);
$('#from').val('');
$('#to').val('');
$('#comment').val('')

}


/*function handleSubmitquiz() {

gme.play();
timestamps[gi].Submitted=1;

}*/


function handleSubmit() {
  //var form = $(this);
 
  var data = {
    "from": $('#from').val(),
    "to": $('#to').val(),
    "comment": $('#comment').val()
 };
  if (data.from=='' || data.to=='' || data.comment=='' )
  {
  alert('fill in the fields');
  exit;
  }
 //alert (data.from);
  displayComment(data);
 return false;
 }
  

 
   document.getElementById('button1')['onclick'] = function() {getComments(); }
   document.getElementById('button2')['onclick'] = function() {storeComments();}
   document.getElementById('button3')['onclick'] = function() {ReturntoSetElements();}
 

  


/*$("button").click(function(){
   post_comment();
  });*/


function showsection(t){
var comment='';
      for(i=0;i<all;i++){
        if(t >= timestamps[i].start && t <= timestamps[i].end){
			//alert(timestamps[i].comment);
			 comment=timestamps[i].comment;
			 document.getElementById('label').innerHTML = comment;
           } 

		  }

    if (comment=='')
    {
	document.getElementById('label').innerHTML = '';
    }
      
    };

function showsection(t){
var comment='';
var isEmbedCode=0;
      for(i=0;i<all;i++){
        if(t >= timestamps[i].start && t <= timestamps[i].end){
			//alert(timestamps[i].comment);
			 comment=timestamps[i].comment;
			 
			 
           } 

		  }

    if (comment!=gComment)
    {
	document.getElementById('label').innerHTML = comment;
	gComment=comment;
    }

	
      
    };




$('#commentSection').on("click",".remove_field", function(e){ //user click on remove text
         e.preventDefault(); $(this).parent('div').remove(); x--;
     })

$('video').mediaelementplayer({
	//framesPerSecond: 20,
	features: ['playpause','progress','current','duration','tracks','volume'],
		
    // Hide controls when playing and mouse is not over the video
    
	
	
	success: function(me, node, player) {
		

		
old=0;
now=0;
eventtype=0;


gme=me;
 

//time_cuepoints = parseInt(me.duration/interval);

var events = ['loadstart', 'play','pause', 'ended','seeking','volumechange', 'muted'];

me.addEventListener('timeupdate', function() {

document.getElementById('time').innerHTML = 'Time : '+ me.currentTime;
		now = parseInt(me.currentTime);
		
		//if(now > old){
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
