<?php 
session_start();
if(!isset($_SESSION['mysid'])){
header("location:main_login.php");}
?>

<html>
<body>
Login Successful
<br>
<?php
$username=$_SESSION['username'];
$user_id=$_SESSION['user_id'];
$sid=$_SESSION['mysid'];
echo $username.' <br>';
echo $user_id.'<br>';
echo $sid.'<br>';
echo 'hello';

?>

Go to Page <a href="main-frame.php">Main-Frame</a><br>

</body>
</html>