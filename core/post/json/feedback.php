<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');


// include database connection
include '../../../config/sqldbconf.php';

$postdata = file_get_contents("php://input");

try{

// insert query
$query = "INSERT INTO feedback SET submitter_Name=:s_name, satisfaction=:s_satis, content=:f_content";
// prepare query for execution
$stmt = $con->prepare($query);
// posted values

$request = json_decode($postdata);

@$submitter_name = $request->name;
@$submitter_satisfaction = $request->happiness;
@$feedback_content = $request->content;



// bind the parameters
$stmt->bindParam(':s_name', $submitter_name);
$stmt->bindParam(':s_satis', $submitter_satisfaction);
$stmt->bindParam(':f_content', $feedback_content);


// Execute the query
if($stmt->execute()){
echo json_encode("success");
}else{
echo json_encode("error");
}
}
// show error
catch(PDOException $exception){
die('ERROR: ' . $exception->getMessage());
}


?>