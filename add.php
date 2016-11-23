<?php
session_start();
$message=array();
require('database.php');

if(isset($_POST['image']))
{
	if($_SESSION['votes']>1)
	{
		$postId=$_POST['image'];
		$postVotes=$_POST['votes'];
		
		$query="SELECT * FROM ratings WHERE id=$postId LIMIT 1";
		$result=$connect->query($query);
		
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		$ratings=$row['rated'];
		$votes=$row['votes'];
		
		$ratings+=$postVotes;
		$votes++;
		
		$query2="UPDATE ratings SET rated=$ratings,votes=$votes WHERE id=$postId";
		$result2=$connect->query($query2);
		
		$message['type']="SUCCESS";
		$message['avg']=round($ratings/$votes,2);
		
		$_SESSION['votes']--;
	}
	else
	{
		$message['type']="Too Many Votes";
	}
	$message['votesremaining']=$_SESSION['votes'];
}
else
{
	$message['type']="FAIL";
}
header('content-type:application/json');
echo json_encode($message);
?>