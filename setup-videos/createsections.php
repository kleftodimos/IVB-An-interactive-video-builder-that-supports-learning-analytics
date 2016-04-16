<?php

require_once '../config/config.php';

$videourl=$_GET["videourl"];
$videotitle=$_GET["videotitle"];
$videoid=$_GET["videoid"];
  
//echo $videourl;	
	     

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
 

<video id="player1" width="500" height="380">
    <source src="<?php echo $videourl; ?>" type="video/youtube">	 
	
	<!--track kind="subtitles" src="../media/graphic_design.srt" srclang = "el" /-->
	 

</video>


<br>
<input type="button" id="button1" value="Preview" />
<input type="button" id="button2" value="Store in DB" />
<!--button id="button1" type="button">transfer</button-->
<span id="time"></span>
<br><br>

<div class="container1">
 <span id="Sectionlabel"></span>


</div>



<br><br>
<br><span id="examplecomframe"></span>

<br><br>
 <input type="button" id="button3" value="Return to choose other elements" />

 </div>

 

<div id="respond" style="float:right; width:50%;">


      <h3>Set Sections here. Use the video to check the exact time when the section starts</h3>

     <form name="commentform" >
      
     

        <label for="FROM" class="required">TimePoint</label><br>
        <input type="number" name="from" id="from" value="" tabindex="1" required="required"><br>
		
		<label for="TO" class="required">To</label><br>
        <input type="number" name="to" id="to" value="" tabindex="2" required="required"><br>
         
		
         Section Title<br>
        <input type="text" size="40" name="Section"  id="Section"><br><br>
        
		<input name="Submit"  type="button" value="Submit" onClick="JavaScript:handleSubmit()">
        </form>
      
      
    
 <div>Sections here: <span id="commentSection"></span></div>

 </div>


<script>

var count=0;
var timestamps = [];
var all=0;
var gSection="";

var last = 0,
now,
old;


var gme;
var gi;



$('#commentSection').html('.....<br>');

function getSections()
{

var lAnswers=[];

timestamps = [];
var str1,str2;

$('article').each(function(o){
      if($(this).attr('data-start')){
	     
       
	    var lcommenttext=$(this).text();
		var lcommentlen=lcommenttext.length;
		                                  
		var offset1=lcommenttext.indexOf("Section :");
		//var offset2=lcommenttext.indexOf("[Q1]");
		var offset2=lcommentlen;
		var offset=offset1+10;
		var end= offset2-offset;
		var lSection = lcommenttext.substr(offset, end);
		//alert (lSection);
		

		

        timestamps.push({
          start : +$(this).attr('data-start'),
		  end : +$(this).attr('data-end'),
		  
		  Section: lSection
		  
        });
      }
    });


all = timestamps.length;
//alert(all);



}


function storeSections()
{

	$.post("send_sections.php", {
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
  

 var html = '' +
  '<div><article id="' + count + '" data-start="'+data.from+'"'+' data-end="'+data.to+'"  class="hentry">' + 
    '<div>from:'+data.from+' to: '+data.to+' ' +'<br>'+
    '<br>Section : <span id="dataSection">'+data.Section+'</span>';

	
	
  
  html=html+'</article> <a href="#" class="remove_field">Remove</a></div><br><br>';

  
  return html;
}



function displayComment(data) {
  var commentHtml = createComment(data);
  
// alert(commentHtml);
$('#commentSection').append(commentHtml);
$('#from').val('');
$('#to').val('');

$('#Section').val('');




}

/*function handleSubmitquiz() {

gme.play();
timestamps[gi].Submitted=1;

}
*/

function handleSubmit() {
 

 //alert ('hello');
 //alert ( $('#Answer2').val());
  
  var data = {
    "from": $('#from').val(),
	 "to": $('#to').val(),
	"Section": $('#Section').val(),
	
 };
  
  if (data.from=='' || data.to=='' || data.Section=='' )
  {
  alert('fill in the fields');
  exit;
  }
 

 displayComment(data);
 return false;
 }

  

 
   document.getElementById('button1')['onclick'] = function() {getSections(); }
   document.getElementById('button2')['onclick'] = function() {storeSections();}
   document.getElementById('button3')['onclick'] = function() {ReturntoSetElements();}
 

  


/*$("button").click(function(){
   post_comment();
  });*/

function showsection(t){
var Answers=[];
var lSubmitted;
var comment='';
var Section ='';
var start=0;
var end=0;

      for(i=0;i<all;i++){
        if(t >= timestamps[i].start && t <= timestamps[i].end){
			
			 Section=timestamps[i].Section;
			 start=timestamps[i].start;
			 end=timestamps[i].end;
			 //alert (Question);
			 
		}
	  }

    if (Section!=gSection)
    {
	document.getElementById('Sectionlabel').innerHTML = 'from : '+start+' to: '+end+' '+Section;
	
	gSection=Section;
	
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
