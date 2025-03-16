<?php

require "../../config/connect.php";

if (isset($_GET['isAssigned'])) {
  if ($_GET['isAssigned'] == true) {
    $request_id = $_GET['request_id'];

    // Fetch rows from the database
    $result = mysqli_query($conn, "SELECT remark FROM request_history WHERE r_id = $request_id");
    $remarksFromDb = [];

    // Store the remarks from the database into an array
    while ($row = mysqli_fetch_assoc($result)) {
      $remarksFromDb[] = $row['remark'];
    }

    // Create your associative array
    $associativeArray = [
      "ON_THE_WAY" => "Team On the Way",
      "IN_PROGRESS" => "Fire Relief Work in Progress",
      "COMPLETE" => "Request Completed"
    ];

    // Check if there are no remarks from the database
    if (empty($remarksFromDb)) {
      // Return the associative array as is
      echo json_encode([
        "TYPE" => "REMARKS",
        "REMARKS" => $associativeArray
      ]);
      exit; // Stop further execution
    }

    // Get the keys (remarks) to skip from the associative array
    $valuesToSkip = array_keys($associativeArray);

    // Filter the associative array to exclude values present in the database remarks
    $filteredArray = array_diff_key($associativeArray, array_flip($remarksFromDb));

    // Prepare response
    $response = [
      "TYPE" => "REMARKS",
      "REMARKS" => $filteredArray // Return the filtered key-value pairs
    ];

    // Return the JSON response
    echo json_encode($response);
  } else {
    $result = mysqli_query($conn, "SELECT team_id, team_name FROM fire_team");

    $data = ["TYPE" => "TEAMS"];
    $dataRow = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $dataRow[] = $row;
    }

    $data[] = $dataRow;

    echo json_encode($data);
  }
}
