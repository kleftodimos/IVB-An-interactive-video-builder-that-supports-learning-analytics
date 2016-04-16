

<?php

require_once '../config/config.php';



$videoid=$_POST['videoid'];
$videourl=$_POST['videourl'];
$videotitle=$_POST['videotitle'];
$video_sections_bool=$_POST['video_sections_bool'];
$videolength=$_POST['duration'];
$time_section_threshold=$_POST['time_sections_threshold'];

$videolength=round($videolength);






	
    $sql="insert into videos (videoid,videotitle,videolength,videourl,video_sections_bool,time_section_threshold) values ('$videoid','$videotitle','$videolength','$videourl','$video_sections_bool','$time_section_threshold')";
    $myfile = fopen("C://sql.txt", "w") or die("Unable to open file!");
    
    fwrite($myfile, $sql);

    fclose($myfile);

    $result = mysql_query($sql);
 
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

  
	  <title>Graphic Design</title>

                    
                
       
	<meta charset="utf-8" />
 </HEAD>

 <div id="video" style="float:left; width:50%;">
 


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
 <span id="label"></span>


</div>



<br><br>
<br><span id="examplecomframe"></span>

 </div>

<div id="respond" style="float:right; width:50%;">


      <h3>Set Sections here. Use the video to check the exact time when the section starts</h3>

     <form name="commentform" >
      
     

        <label for="FROM" class="required">TimePoint</label><br>
        <input type="number" name="from" id="from" value="" tabindex="1" required="required"><br>
         
		

        Section Title <input type="text" size="80" name="Section"  id="Section"><br><br>
        
		<input name="Submit"  type="button" value="Submit" onClick="JavaScript:handleSubmit()">
        </form>
      
      
    
 <div>Sections here: <span id="commentSection"></span></div>

 </div>


<script>

var count=0;
var timestamps = [];
var all=0;
var gComment="";

var last = 0,
now,
old;

var gvideoid=1;
var gme;
var gi;



$('#commentSection').html('.....<br>');

function getComments()
{

var lAnswers=[];

timestamps = [];
var str1,str2;

$('article').each(function(o){
      if($(this).attr('data-start')){
	     
       
	    var lcommenttext=$(this).text();
		//alert(lcommenttext);
		/*var offset1=lcommenttext.indexOf("Section:");
		var offset2=lcommenttext.indexOf("[Q1]");
		var offset=offset1+9;
		var end= offset2-offset-1;
		var lQuestion = lcommenttext.substr(offset, end);*/
		

		}
		
		

        timestamps.push({
          start : +$(this).attr('data-start'),
		  
		  Question: lcommenttext
		  
        });
      }
    });


all = timestamps.length;



}


function storeComments()
{

	$.post("send_sections.php", {
		timestamps:JSON.stringify(timestamps),
		num:all,
		videoid: gvideoid
	}, function(data) {
		//alert(data);
	});
	
}




function createComment(data) {
  count=count+1;
  
  var comment = data.comment;
  

  var html = '' +
  '<div><article id="' + count + '" data-start="'+data.from+'"'+'<br>'+
    '<br>Section:<span id="dataQuestion">'+data.Section+' [Q1] </span>';

	
	
  
  html=html+'</article> <a href="#" class="remove_field">Remove</a></div>';

  
  return html;
}



function displayComment(data) {
  var commentHtml = createComment(data);
  
// alert(commentHtml);
$('#commentSection').append(commentHtml);
$('#from').val('');

$('#Section').val('');




}

function handleSubmitquiz() {

gme.play();
timestamps[gi].Submitted=1;

}


function handleSubmit() {
 

 //alert ('hello');
 //alert ( $('#Answer2').val());
  
  var data = {
    "from": $('#from').val(),
	"Section": $('#Section').val(),
	
 };
  
  if (data.from=='' ||   data.Section=='' )
  {
  alert('fill in the fields');
  exit;
  }
 

 displayComment(data);
 return false;
 }

  

 
   document.getElementById('button1')['onclick'] = function() {getComments(); }
   document.getElementById('button2')['onclick'] = function() {storeComments();}
 

  


/*$("button").click(function(){
   post_comment();
  });*/

function showsection(t){
var Answers=[];
var lSubmitted;
var comment='';
      for(i=0;i<all;i++){
        if(t >= timestamps[i].start && t <= timestamps[i].end){
			
			 Section=timestamps[i].Section;
			 //alert (Question);
			 

    if (Section!=gSection)
    {
	document.getElementById('label').innerHTML = Section;
	
	gSection=cSection;
	
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






