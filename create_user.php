
<?php
 
/*
 * Following code will create a new high score row
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_GET['score'])&& isset($_GET['name'])) {
 
 
    $score = $_GET['score'];
    $name = $_GET['name'];
 
    // include db connect class
    include_once("dbConnect.php");
 
    // connecting to db
 
    // sqlite inserting a new row
	$sql = "INSERT INTO highscores (name,score,wins,streak,created,updated) VALUES('$name' , '$score', 0, 0, current_timestamp, current_timestamp)";
    $result = $dbCon->query($sql);
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "User successfully registered.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>