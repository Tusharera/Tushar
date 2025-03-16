<?php
// Database connection
require "../../config/connect.php";

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request']) && isset($_POST['team_id']) && isset($_POST['request_id'])) {


  if ($_POST['request'] == "UPDATE_TEAM") {
    $team_id = $_POST['team_id'];
    $request_id = $_POST['request_id'];

    $sql = "UPDATE fire_report SET assign_to='$team_id', assignment_time = '$date' WHERE id='$request_id'";
    if ($conn->query($sql) === TRUE) {


      echo "Team updated successfully!";
    } else {
      echo "Error updating team: " . $conn->error;
    }
  }
} else if (isset($_POST['request'], $_POST['remark'], $_POST['message'], $_POST['request_id'])) {

  $remark = mysqli_real_escape_string($conn, $_POST['remark']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);
  $req_id = (int)$_POST['request_id'];

  $date = date("Y-m-d H:i:s");

  $sql = "INSERT INTO request_history (r_id, remark, `message`, `date`) VALUES ($req_id, '$remark', '$message', '$date')";


  if ($conn->query($sql) === TRUE) {
    mysqli_query($conn, "UPDATE fire_report SET status = '$remark' WHERE id=$req_id");
    echo "Request Status Updated!";
  } else {
    echo "Error updating Status: " . $conn->error;
  }
}
