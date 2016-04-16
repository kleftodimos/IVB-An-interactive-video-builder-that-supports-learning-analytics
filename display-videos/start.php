<?php 
session_start();
if(!isset($_SESSION['mysid'])){
header("location:main_login.php");}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Νέες Τεχνολογίες της Επικοινωνίας- Βίντεο</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>

<frameset rows="80,*" cols="*" framespacing="0" frameborder="yes" border="0" bordercolor="#CCCCCC">
  <frame src="imageframe.htm" name="topFrame" scrolling="NO" noresize >
  <frame src="main-frame.php" name="mainFrame">
</frameset>
<noframes><body>

</body></noframes>
</html>
