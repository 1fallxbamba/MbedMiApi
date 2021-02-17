<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../../config/sqldbconf.php';

$postdata = file_get_contents("php://input");

try{

// insert query
$query = "INSERT INTO incidents SET i_Type=:i_tp, i_Description=:i_desc, i_Location=:i_loc, submitter_Username=:s_uname, submitter_Name=:s_name, i_Picture=:i_pic";
// prepare query for execution
$stmt = $con->prepare($query);
// posted values

$request = json_decode($postdata);

@$incident_type = $request->incidentType;
@$incident_description = $request->incidentDesc;
@$incident_location = $request->incidentLoc;
@$submitter_existing_username = $request->submitterExistingUsername;
@$submitter_new_username = $request->submitterNewUsername;
@$submitter_name = $request->submitterName;
@$incident_picture = $request->incidentPic;

if ($incident_picture == '') {
	$incident_picture = "default.jpg";
}
// bind the parameters

$stmt->bindParam(':i_tp', $incident_type);
$stmt->bindParam(':i_desc', $incident_description);
$stmt->bindParam(':i_loc', $incident_location);

if ($submitter_existing_username == '') {

	$stmt->bindParam(':s_uname', $submitter_new_username);

} else {

	$stmt->bindParam(':s_uname', $submitter_existing_username);

}

$stmt->bindParam(':s_name', $submitter_name);
$stmt->bindParam(':i_pic', $incident_picture);

// Execute the query
if($stmt->execute()){
echo json_encode("success");
}else{
echo json_encode(array('result'=>'fail'));
}
}
// show error
catch(PDOException $exception){
die('ERROR: ' . $exception->getMessage());
}


?>