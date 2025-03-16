<?php
require "../../config/connect.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query to find the admin with the provided email
  $sql = "SELECT * FROM admin WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);

    // Verify the provided password against the hashed password
    if ($password === $admin['password']) {
      $_SESSION['admin'] = $admin['admin_id'];

      echo json_encode(["status" => "success", "message" => "Login successful."]);
    } else {
      echo json_encode(["status" => "error", "message" => "Invalid email or password."]);
    }
  } else {
    echo json_encode(["status" => "error", "message" => "Invalid email or password."]);
  }

  mysqli_close($conn);
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
