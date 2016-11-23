<?php
session_start();
$message=array();
require('database.php');

$query="SELECT * FROM ratings ORDER BY RAND() LIMIT 1";
$result=mysqli_query($connect,$query) or die('Data fetching error');
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$message["image"]=$row["image"];
$message["id"]=$row["id"];
if($row["votes"]>0)
{
	$message["avg"]=round($row["rated"]/$row["votes"],2);
	$message["votes"]=$row["votes"];
}
else
{
	$message["avg"]=0;
	$message["votes"]=0;
}
if(empty($_SESSION['votes']))
{
	$_SESSION['votes']=50;
	$message['votesleft']=$_SESSION['votes'];
}
else
{
	$message['votesleft']=$_SESSION['votes'];
}
header('content-type:application/json');
echo json_encode($message);
?>