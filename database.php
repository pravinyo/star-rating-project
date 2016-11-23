<?php
$DBServer='localhost';
$DBUser='bp6am';
$DBPassword='bp6ampass';
$DBName='starform';

$connect=new mysqli($DBServer,$DBUser,$DBPassword,$DBName);
if($connect->connect_error)
{
	die('Connection Error: ' . $connect->connect_error);
}
?>