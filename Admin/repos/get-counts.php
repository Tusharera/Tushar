<?php

require "../../config/connect.php";

$counts = [];

$statuses = ['none', 'IN_PROGRESS', 'COMPLETE'];
foreach ($statuses as $status) {
  $sql = "SELECT COUNT(id) AS count FROM `fire_report` WHERE STATUS = '$status'";
  $result = $conn->query($sql);

  if ($result) {
    $row = $result->fetch_assoc();
    $counts[$status] = (int)$row['count']; // Store count
  } else {
    echo "Error: " . $conn->error;
  }
}

$sql = "SELECT COUNT(`team_id`) AS count FROM `fire_team`";
$result = $conn->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $counts['fire_team_count'] = (int)$row['count']; // Store team count
} else {
  echo "Error: " . $conn->error;
}

$conn->close();

echo json_encode($counts);
