<?php
session_start();


if (!isset($_SESSION['admin'])) {
  header("Location:./signed-in.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


  <link rel="stylesheet" href="../styles/admin-dashboard.css">
</head>

<body>
  <?php
  include "./navbar.php"
  ?>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Admin Dashboard </h2>
    <div class="row g-4">
      <!-- New Requests Card -->
      <div class="col-md-3">
        <a href="./new-requests.php">
          <div class="card new-requests">
            <h3>New Requests</h3>
            <div class="number-badge" id="NEW_REQ"></div>
          </div>
        </a>
      </div>

      <div class="col-md-3">
        <a href="./in-progress.php">
          <div class="card pending-requests">
            <h3>In-Progress</h3>
            <div class="number-badge" id="PROGRESS"></div>
          </div>
        </a>
      </div>

      <!-- Complete Requests Card -->
      <div class="col-md-3">
        <a href="./complete-request.php">
          <div class="card complete-requests">
            <h3>Complete Requests</h3>
            <div class="number-badge" id="COMPLETE"></div>
          </div>
        </a>
      </div>

      <!-- Total Members Card -->
      <div class="col-md-3">
        <a href="./manage-teams.php">
          <div class="card total-members">
            <h3>Manage Team</h3>
            <div class="number-badge" id="TEAM"></div>
          </div>
        </a>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
    $.ajax({
      url: "../repos/get-counts.php",
      type: "GET",
      success: (data) => {
        data = JSON.parse(data);
        $("#TEAM").text(data.fire_team_count);
        $("#COMPLETE").text(data.COMPLETE);
        $("#PROGRESS").text(data.IN_PROGRESS);
        $("#NEW_REQ").text(data.none);
      },
      error: (error) => {
        console.error(error);
      }
    });
  </script>

</body>

</html>