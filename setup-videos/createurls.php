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


  
	    <title><?php echo $videotitle; ?></title>

                    
                
       
	<meta charset="utf-8" />
 </HEAD>

 <script>
  var gvideourl="<?php echo $videourl; ?>";
  var gvideoid="<?php echo $videoid; ?>";
  var gvideotitle="<?php echo $videotitle; ?>";
 
 

 </script>

 <div id="video" style="float:left; width:50%;">
 <h2>Video Title: <?php echo $videotitle; ?></h2><br>
 


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

<div class="container1">
 <span id="label"></span>

 <br><br>
 <input type="button" id="button3" value="Return to choose other elements" />



</div>



<br><br>
<br><span id="examplecomframe"></span>

 </div>

<div id="respond" style="float:right; width:50%;">


      <h3>Set urls here</h3>

    <form name="commentform" >
      
     

        <label for="FROM" class="required">From</label><br>
        <input type="number" name="from" id="from" value="" tabindex="1" required="required"><br>
        
        <label for="TO" class="required">To</label><br>
        <input type="number" name="to" id="to" value="" tabindex="2" required="required"><br>

		<label for="isEmbedCode" class="required">isEmbedCode</label><br>
        <input type="checkbox" name="isEmbedCode" id="isEmbedCode" value="1" tabindex="3" ><br>

        <label for="comment" class="required">Type in URL or Embed code</label><br>
        <textarea name="comment" id="comment" type="text" cols="50" rows="7" tabindex="4"  required="required"></textarea><br><br>

		<input name="Submit"  type="button" value="Sumbit" onClick="JavaScript:handleSubmit()">

       <!--button id="button" type="button">transfer</button-->
        </form>
      
      
    
 <div>Urls/Embed Codes here: <span id="commentSection"></span></div>

 </div>


<script>

var count=0;
var timestamps = [];

var gSubmitted= [];


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
		var offset=lcommenttext.indexOf("URL:");
		offset=offset+4;
		lcommentlen=lcommenttext.length;
		var lcomment = lcommenttext.substr(offset, lcommentlen);

		offset=lcommenttext.indexOf("isEmbedCode:");
		offset=offset+12;
		lisEmbedCode = lcommenttext.substr(offset, 1);

        timestamps.push({
          start : +$(this).attr('data-start'),
          end : +$(this).attr('data-end'),
		  isEmbedCode: lisEmbedCode,
          comment : lcomment
		  
        });
      }
    });

all = timestamps.length;
gSubmitted.length = all; 
gSubmitted.fill(0);
}


function storeComments()
{

	$.post("sendurls.php", {
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
  
  var comment = data.comment;
  var finalcomment = comment.replace("<", "&lt;");

  var html = '' +
  '<div><article id="' + count + '" data-start="'+data.from+'"'+' data-end="'+data.to+'"  class="hentry">' + 
    '<br><div>from:'+data.from+' to: '+data.to+' ' +'<br>'+
    'isEmbedCode:<span id="dataisEmbedCode">'+data.isEmbedCode+'</span>'+
	'<br>URL: <span id="datacomment">'+finalcomment+'</span></div>' +
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
$('#isEmbedCode').attr('checked', false);
$('#comment').val('')

}

function handleSubmitquiz() {

gme.play();
//timestamps[gi].Submitted=1;
gSubmitted[gi]=1;

}


function handleSubmit() {
  //var form = $(this);

  var isEmbedCodeval=$("#isEmbedCode").is(':checked') ? 1 : 0;
  //alert (isEmbedCodeval);
  
 
  var data = {
    "from": $('#from').val(),
    "to": $('#to').val(),
	"isEmbedCode": isEmbedCodeval,
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
var isEmbedCode=0;
      for(i=0;i<all;i++){
        if(t >= timestamps[i].start && t <= timestamps[i].end){
			//alert(timestamps[i].comment);
			 
			 comment=timestamps[i].comment;
			 isEmbedCode=timestamps[i].isEmbedCode;

             gi=i;
			 if (gSubmitted[i]==0) {gme.pause();}
			 
			 if (isEmbedCode==0)
			 {
			 comment="<a href='"+ comment+"' target='_blank'>"+comment+"</a>";
			// comment='hello';
			 } 
			 else
			 {
             comment = comment.replace("&lt;", "<");
			 }

			 

			 var formend='<input name="SubmitQuiz"  type="button" value="Continue" onClick="JavaScript:handleSubmitquiz()"></form>';
			 comment=comment+'<br><br>'+formend;
			 
            /* if (comment!=gComment)
             {
			 document.getElementById('label').innerHTML = comment;
			 gComment=comment;
             }*/
			 
			 
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
