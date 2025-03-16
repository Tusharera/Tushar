<?php
// Database connection
require "../../config/connect.php";

// Insert or Update Team
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {
  $team_id = $_POST['team_id'] ?? '';
  $team_name = $_POST['team_name'];
  $team_leader = $_POST['team_leader'];
  $mobile = $_POST['mobile'];
  $team_members = $_POST['team_members'];

  if ($team_id != '') {
    // Update query
    $sql = "UPDATE fire_team SET team_name='$team_name', team_leader='$team_leader', mobile='$mobile', team_members='$team_members' WHERE team_id='$team_id'";
    if ($conn->query($sql) === TRUE) {
      echo "Team updated successfully!";
    } else {
      echo "Error updating team: " . $conn->error;
    }
  } else {
    // Insert query
    $sql = "INSERT INTO fire_team (team_name, team_leader, mobile, team_members, posting_date) VALUES ('$team_name', '$team_leader', '$mobile', '$team_members', NOW())";
    if ($conn->query($sql) === TRUE) {
      echo "Team added successfully!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

// Fetch Teams
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM fire_team WHERE team_name LIKE '%$search%' OR team_leader LIKE '%$search%' OR mobile LIKE '%$search%' OR team_members LIKE '%$search%'";
  } elseif (isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $sql = "SELECT * FROM fire_team WHERE team_id = '$team_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo json_encode($result->fetch_assoc());
    }
    exit;
  } else {
    $sql = "SELECT * FROM fire_team";
  }

  $result = $conn->query($sql);
  $output = '';

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $output .= "<tr>
                          <td>{$row['team_name']}</td>
                          <td>{$row['team_leader']}</td>
                          <td>{$row['mobile']}</td>
                          <td>{$row['team_members']}</td>
                          <td>
                            <button class='btn btn-primary edit-btn' data-id='{$row['team_id']}'>Edit</button>
                            <button class='btn btn-danger delete-btn' data-id='{$row['team_id']}'>Delete</button>
                          </td>
                        </tr>";
    }
  } else {
    $output .= "<tr><td colspan='5' class='text-center'>No teams found</td></tr>";
  }

  echo $output;
}

// Delete Team
else if (isset($_POST['delete_id'])) {
  $delete_id = $_POST['delete_id'];
  $sql = "DELETE FROM fire_team WHERE team_id = '$delete_id'";
  if ($conn->query($sql) === TRUE) {
    echo "Team deleted successfully!";
  } else {
    echo "Error deleting team: " . $conn->error;
  }
}

$conn->close();
