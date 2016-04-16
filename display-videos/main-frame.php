<?php 
session_start();
if(!isset($_SESSION['mysid'])){
header("location:main_login.php");}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<title>video1</title>
<script type="text/javascript">
<!-- Begin
function fullScreen(theURL) {
window.open(theURL, '', 'fullscreen=yes, scrollbars=yes');
}
//  End -->
</script>
</head>


<body bgcolor="#FFFFFF" text="#FFFFFF" link="#FFFFFF">
<table width="92%" border="1" align="center" bgcolor="#0099FF">
  <tr>
  <td width="12%">-- </td>
  <td width="62%"><b><font size="5">
  <div align="center">
    <h4>Interactive Video Examples</h4>
  </div>
  </font></b></td>
  <td width="8%">--</td>
  <td width="11%">--</td>
  <td width="7%">--</td>
  </tr>
  <tr>
    <td>--</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>
  </tr>
  <tr>
    <td align="center">1</td>
    <td><strong>Video 1 (with questions and table of contents)</strong></td>
    <td><font face="Arial, Helvetica, sans-serif"><a href="display_video_questions_table_of_contents.php?videoid=1">Video</a></font></td>
     <td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>

  <tr>
    <td align="center">1</td>
    <td><strong>Video 2 (with subtitles) </strong></td>
    <td><font face="Arial, Helvetica, sans-serif"><a href="video-subtitles.php?videoid=1">Video</a></font></td>
   
	<td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>

  <tr>
    <td align="center">1</td>
    <td><strong>Video 3 (with web content e.g Urls, Google Maps and Images) </strong></td>
    <td><font face="Arial, Helvetica, sans-serif"><a href="display_video_urls.php?videoid=1">Video</a></font></td>
   
	<td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>

  <tr>
    <td align="center">1</td>
    <td><strong>Video 1 (with hot potatoes activity) </strong></td>
    <td><font face="Arial, Helvetica, sans-serif"><a href="display_video_hotpotatoes.php?videoid=1">Video</a></font></td>
   
	<td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>



  </table>
  <br><br>

 
 
 

</body>
</html>
