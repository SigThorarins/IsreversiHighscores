<?php
 session_start();
/*
 * Following code will list all the highscores
 */
 
// array for JSON response
$response = array();
 
// include db connect class
include_once("dbConnect.php");
 
// get all highscores from highscores table
$sql = "SELECT * FROM highscores ORDER BY score DESC";
 
$query = $dbCon->query($sql);
// check for empty result
if (!empty($query)) {
    // looping through all results
    // highscores node
	
	$response["highscores"] = array();

	foreach ($query as $data) {
		// temp user array
		$highscores = array();
		$highscores["id"] = $data["id"];
		$highscores["name"] = $data["name"];
		$highscores["score"] = $data["score"];
		$highscores["wins"] = $data["wins"];
		$highscores["streak"] = $data["streak"];
		$highscores["created"] = $data["created"];
		$highscores["updated"] = $data["updated"];
 
    // push single product into final response array
		array_push($response["highscores"], $highscores);
	}
// success
	$response["success"] = 1;
 // echoing JSON response
	echo json_encode($response);
	
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>