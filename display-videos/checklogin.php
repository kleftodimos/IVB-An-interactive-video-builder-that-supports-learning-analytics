<!DOCTYPE HTML>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">

<?php
require_once '../config/config.php';

//ob_start();



// Define $myusername and $mypassword 
$username=$_POST['myusername']; 
$password=$_POST['mypassword']; 

$ip1=$_SERVER['REMOTE_ADDR'];
$ip2=$_SERVER['HTTP_X_FORWARDED_FOR'];


//echo $ip1;
//echo "<br>";
//echo $ip2;




// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

//echo $username.' '.$password.' <br>';

$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1 ){
	
 $db_record = mysql_fetch_assoc($result);
 $checked =$db_record['checked'];

 if ($checked==1) 
	 {
		 $user_id=$db_record['user_id'];
		 $firstname=$db_record['firstname'];
		 $am=$db_record['am'];

		// Register $myusername, $mypassword and redirect to file "login_success.php"

		$sql="SELECT * FROM sessions  order by sessionid desc ";
		$result=mysql_query($sql);
		$count2=mysql_num_rows($result);
		if  ($count2==0)
			{
			$sid=1; 
			
			} 
		  else {
			 $db_record = mysql_fetch_assoc($result);

			 $sid=$db_record['sessionid'];
			 $sid=$sid+1; 	 
		  }

		//$mysid=$sid;
		$sql="INSERT INTO SESSIONS (sessionid, user_id,ipaddr_1,ipaddr_2, startdate, starttime) VALUES ('$sid', '$user_id', '$ip1','$ip2',curdate(), curtime())";

		$result=mysql_query($sql);
		echo $sql;
		//session_register("mysid");
		//session_register("user_id");
		//session_register("username");

		session_start();
		$_SESSION['mysid']=$sid;
		$_SESSION['user_id']=$user_id;
		$_SESSION['username']=$firstname;
		$_SESSION['am']=$am;

        //echo  'userid '.$user_id;
		if (!file_exists('img/user_'.$user_id.'_'.$am)) {
			mkdir('img/user_'.$user_id.'_'.$am, 0777, true);
		}
		//$_SESSION['videotime']=0;
		//$_SESSION['vid_id']=1;




		/*echo $mysid.'<br> ';
		echo $user_id.'<br>';
		echo $username.'<br>';*/

		//header("location: login_success.php");

		header("location: start.php");
  }
else {
	  echo "Ο Διαχειριστής δεν έχει ακόμη ελέγξει τα στοιχεία σας. Παρακαλώ ξαναπροσπαθήστε αργότερα";
     }


}
else {
header("location: main_login-2.php");
//echo "Wrong Username or Password";


}

//ob_end_flush();
?>

</body>

</html>



