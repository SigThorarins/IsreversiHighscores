
<?php
 
/*
 * Following code will update an existing high score row
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_GET['id'])&& isset($_GET['score'])) {
 
 
    $id = $_GET['id'];
    $score = $_GET['score'];
 
    // include db connect class
    include_once("dbConnect.php");
 
    // connecting to db
 
    // sqlite inserting a new row
	$sql = "UPDATE highscores SET score = '$score', updated = CURRENT_TIMESTAMP , wins = wins +1 , streak = streak +1 where id = '$id'";
    $result = $dbCon->query($sql);
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Score successfully committed.";
 
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