<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

// include database connection
include '../../config/sqldbconf.php';

$user_name=isset($_GET['uname']) ? $_GET['uname'] : die('ERROR: Record ID not found.');

// select all data
 $query = "SELECT * FROM incidents WHERE submitter_Username = '$user_name' AND i_Deleted = 'Non' ";
 
$stmt = $con->prepare($query);

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($results);

echo $json;
?>