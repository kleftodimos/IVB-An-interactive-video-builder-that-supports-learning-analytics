

<?php

require_once '../config/config.php';


$videoid=$_GET['videoid']; 




 $data=array();
 //unset($data);

 $data2=array();

 

 class urls_store { 
	public  $urlid;
    public $start; 
    public $endl;
	public $text;
	public $isEmbedCode;
} 

$sql="select * from video_url_code where videoid='$videoid' order by urlid";
$result = mysql_query($sql);
$num_rows = mysql_num_rows($result);
while($row = mysql_fetch_array($result))
  {   
    
	unset($urlobj);
	$urlsobj=new urls_store();
    $urlsobj->urlid = $row['urlid'];
	$urlsobj->start = $row['start'];
    $urlsobj->endl = $row['end'];
    $urlsobj->text = $row['text'];

	array_push($data2, $urlsobj);
     
  
  $data = array(
		    "videoid" => $videoid,
			"numurls"=>$num_rows,
		    "urls"  =>$data2
		 
            );
	 
 

  }

  echo json_encode($data);




?>



