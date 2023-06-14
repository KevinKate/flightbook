<?php
include('db_connect.php');

extract($_POST);
	$data = " name = '$name' ";
	$data .= ", flight_number = '$flight_number' ";
if(empty($id)){
	
	$insert= $conn->query("INSERT INTO flight set ".$data);
	if($insert)
		echo 1;
}else{
	$update= $conn->query("UPDATE flight set ".$data." where id =".$id);
	if($update)
		echo 1;
}