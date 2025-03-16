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
  <title>Fire Team Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../styles/manage-teams.css">
</head>

<body>

  <?php
  include "./navbar.php";
  ?>

  <div class="container my-5">
    <!-- Form for inserting team data -->
    <div class="card mb-4">
      <div class="card-header text-center">
        <h3>Fire Team Management</h3>
      </div>
      <div class="card-body">
        <form id="teamForm">
          <input type="hidden" id="teamId" name="teamId">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="teamName" class="form-label">Team Name</label>
              <input type="text" id="teamName" class="form-control" placeholder="Enter team name" required>
            </div>
            <div class="col-md-6">
              <label for="leaderName" class="form-label">Team Leader Name</label>
              <input type="text" id="leaderName" class="form-control" placeholder="Enter team leader name" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="mobile" class="form-label">Mobile</label>
              <input type="tel" id="mobile" class="form-control" placeholder="Enter mobile number" required>
            </div>
            <div class="col-md-6">
              <label for="teamMembers" class="form-label">Team Members</label>
              <input type="text" id="teamMembers" class="form-control" placeholder="Enter team members" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-custom">Save Team</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Search field and table -->
    <div class="card">
      <div class="card-header text-center">
        <h4>Team List</h4>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <input type="text" id="searchField" class="form-control search-input" placeholder="Search team...">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-dark">
            <thead>
              <tr>
                <th>Team Name</th>
                <th>Team Leader</th>
                <th>Mobile</th>
                <th>Team Members</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="teamTable">
              <!-- Table rows will be dynamically generated -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      loadTeams();

      // Insert or Update Team
      $("#teamForm").on("submit", function(e) {
        e.preventDefault();

        const teamId = $("#teamId").val();
        const teamName = $("#teamName").val();
        const leaderName = $("#leaderName").val();
        const mobile = $("#mobile").val();
        const teamMembers = $("#teamMembers").val();

        $.ajax({
          url: "../repos/manage_teams.php",
          type: "POST",
          data: {
            request: "INSERT_UPDATE",
            team_id: teamId,
            team_name: teamName,
            team_leader: leaderName,
            mobile: mobile,
            team_members: teamMembers
          },
          success: function(response) {
            alert(response);
            $("#teamForm")[0].reset();
            loadTeams();
          }
        });
      });

      // Load teams data
      function loadTeams(search = "") {
        $.ajax({
          url: "../repos/manage_teams.php",
          type: "GET",
          data: {
            search: search
          },
          success: function(data) {
            $("#teamTable").html(data);
          }
        });
      }

      // Search teams
      $("#searchField").on("keyup", function() {
        const query = $(this).val();
        loadTeams(query);
      });

      // Edit team data
      $(document).on("click", ".edit-btn", function() {
        const teamId = $(this).data("id");
        $.ajax({
          url: "../repos/manage_teams.php",
          type: "GET",
          data: {
            team_id: teamId
          },
          success: function(data) {
            const team = JSON.parse(data);
            $("#teamId").val(team.team_id);
            $("#teamName").val(team.team_name);
            $("#leaderName").val(team.team_leader);
            $("#mobile").val(team.mobile);
            $("#teamMembers").val(team.team_members);
          }
        });
      });

      // Delete team data
      $(document).on("click", ".delete-btn", function() {
        const teamId = $(this).data("id");
        if (confirm("Are you sure you want to delete this team?")) {
          $.ajax({
            url: "../repos/manage_teams.php",
            type: "POST",
            data: {
              delete_id: teamId
            },
            success: function(response) {
              alert(response);
              loadTeams();
            }
          });
        }
      });
    });
  </script>
</body>

</html>