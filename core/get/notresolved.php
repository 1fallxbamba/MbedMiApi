<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

// include database connection
include '../../config/sqldbconf.php';

$user_name=isset($_GET['uname']) ? $_GET['uname'] : die('ERROR: Record ID not found.');

// select all data
 $query = "SELECT * FROM incidents WHERE i_Status = 'En cours de traitement' AND submitter_Username = '$user_name' ";
 
$stmt = $con->prepare($query);

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($results);

echo $json;
?>