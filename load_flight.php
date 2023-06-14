<?php
include 'db_connect.php';

$qry = $conn->query("SELECT * FROM flight where status = 1 order by flight_number asc");
$data = array();
while($row = $qry->fetch_assoc()){
	$data[]= $row;
}
echo json_encode($data);