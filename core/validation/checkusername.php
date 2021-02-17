<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../config/sqldbconf.php';

// read current data

try {

	$username=isset($_GET['uname']) ? $_GET['uname'] : die('ERROR: Record ID not found.');


	// prepare select query 

	$query = "SELECT * from incidents WHERE submitter_Username = '$username'";

	$stmt = $con->prepare($query);

	//execute the query 

	$stmt->execute();

	// store retrieved row to a variable

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results) 
	{
		echo json_encode("exists");
	}
	else
	{
		echo json_encode("does not exist");
	}

//$json = json_encode($results);

//echo $json;
}

// show error 

catch(PDOException $exception) {
	die('Error: ' . $exception->getMessage());
}


?>