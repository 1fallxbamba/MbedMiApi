<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../config/sqldbconf.php';


$deleted = "Oui";


try {

	$incident_id=isset($_GET['iid']) ? $_GET['iid'] : die('ERROR: Record ID not found.');

	// prepare select query 

	$query = "UPDATE incidents SET i_Deleted = '$deleted' WHERE id = '$incident_id'" ;

	$stmt = $con->prepare($query);

 	if($stmt->execute()) {
 		echo json_encode("deleted");
 	} else {
 		echo json_encode("error");
 	}


}

// show error 

catch(PDOException $exception) {
	die('Error: ' . $exception->getMessage());
}


?>