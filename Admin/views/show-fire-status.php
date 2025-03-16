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
  <title>Fire Status Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      color: #343a40;
      font-family: 'Arial', sans-serif;
    }

    .card-custom {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: none;
      border-radius: 10px;
      transition: transform 0.2s;
      position: relative;
    }

    .card-custom:hover {
      transform: scale(1.02);
    }

    .card-header-custom {
      background-color: #343a40;
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .card-body-custom {
      background-color: #fdfdfd;
      color: #343a40;
    }

    .full-width-card {
      background-color: #28a745;
      color: white;
    }

    .small-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-bottom: 20px;
      gap: 20px;
    }

    .small-card {
      flex: 1 0 450px;
      margin-bottom: 20px;
      z-index: 2;
      position: relative;
    }

    li {
      cursor: pointer;
    }

    .large-card {
      width: 100%;
      position: relative;
      z-index: 1;
    }

    @media (max-width: 768px) {
      .small-card {
        width: 100%;
        z-index: 1;
      }

      .small-card:first-child {
        z-index: 2;
      }
    }
  </style>
</head>

<body>
  <?php
  include "./navbar.php";
  ?>


  <div class="container my-5">
    <div class="small-cards">
      <!-- Card 1 -->
      <div class="card card-custom small-card">
        <div class="card-header card-header-custom text-center">
          <h5>Fire Details</h5>
        </div>
        <div class="card-body card-body-custom first-card">
          <table class="table table-bordered border-secondary">

            <?php
            require "../../config/connect.php";
            $report_id = $_GET['request_id'];
            $result = mysqli_query($conn, "SELECT *FROM fire_report WHERE id = $report_id");
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              echo "
                <tr>
                <td>Full Name</td>
                <td>$row[full_name]</td>
                </tr>  
                <tr>
                  <td>Mobile</td>
                  <td>$row[mobile]</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td>$row[location]</td>
                </tr>
                <tr>
                  <td>Message</td>
                  <td>$row[message]</td>
                </tr>
                <tr>
                  <td>Reporting Time</td>
                  <td>$row[posting_date]</td>
                </tr>
                ";
            } else {
              echo " <p>Not Found</p>";
            }
            ?>

          </table>
        </div>
        <?php
        if ($row['assign_to'] > 0) {
          $isAssign = true;
        ?>
          <div class="btn-group w-50">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Update Remark
            </button>
            <ul class="dropdown-menu" id="DROP_DOWN">
              <!-- <li class="dropdown-item"> Action</li>
              <li class="dropdown-item"> Another action</li>
              <li class="dropdown-item"> Something else here</li> -->
            </ul>
          </div>
        <?php
        } else {
          $isAssign = false;
        ?>
          <!-- --------- -->
          <div class="btn-group w-50">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Assigned to
            </button>
            <ul class="dropdown-menu" id="DROP_DOWN">
              <!-- <li class="dropdown-item"> Team-1 </li>
              <li class="dropdown-item"> Team-2 </li>
              <li class="dropdown-item"> Team-3 </li> -->
            </ul>
          </div>
        <?php
        }
        ?>
      </div>

      <!-- Card 2 -->
      <div class="card card-custom small-card">
        <div class="card-header card-header-custom text-center">
          <h5>Assigned Details</h5>
        </div>
        <div class="card-body card-body-custom">
          <table class="table table-bordered border-secondary">

            <?php
            $result = mysqli_query($conn, "SELECT *FROM fire_team WHERE team_id = $row[assign_to]");
            $result1 = mysqli_query($conn, "SELECT *FROM fire_report WHERE id = $_GET[request_id]");

            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $dateRow = mysqli_fetch_assoc($result1);

              echo "
              <tr>
                <th>Team Name</th>
                <td>$row[team_name]</td>
              </tr>
              <tr>
                <th>Team Leader</th>
                <td>$row[team_leader]</td>
              </tr>
              <tr>
                <th>Team Lead. Mob.</th>
                <td>$row[mobile]</td>
              </tr>
              <tr>
                <th>Team Members</th>
                <td>$row[team_members]</td>
              </tr>
              <tr>
                <th>Assignment Time</th>
                <td>$dateRow[assignment_time]</td>
              </tr>
              ";
            } else {
              echo "<tr><td colspan='2' class='text-center text-danger'>No Assignment Found</td></tr>";
            }
            ?>
          </table>
        </div>
      </div>
    </div>

    <!-- Full-width card -->
    <div class="card card-custom large-card full-width-card">
      <div class="card-header card-header-custom text-center">
        <h5>Request Track History</h5>
      </div>
      <div class="card-body card-body-custom">
        <table class="table table-bordered border-secondary">
          <tr>
            <th scope="col">Remark</th>
            <th scope="col">Status</th>
            <th scope="col">Remark Date</th>
          </tr>
          <tbody class="table-group-divider">

            <?php
            $result = mysqli_query($conn, "SELECT *FROM request_history WHERE r_id = $_GET[request_id]");

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo " <tr>
                    <td>$row[remark]</td>
                    <td>$row[message]</td>
                    <td>$row[date]</td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='3' class='text-center text-danger'>No Request History AVL..</td></tr>";
            }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
    // -----------------------
    $.ajax({
      url: "../repos/request-details.php",
      type: "GET",
      data: {
        isAssigned: "<?php echo $isAssign; ?>",
        request_id: "<?php echo $_GET['request_id'] ?>"
      },
      success: (data) => {
        data = JSON.parse(data);

        // console.log(("data = ", data));

        let dropDown = $("#DROP_DOWN");
        dropDown.empty();

        if (data.TYPE == "REMARKS") {

          for (const [key, value] of Object.entries((data.REMARKS))) {

            if (key === "TYPE") {
              continue;
            } else {
              let li = `
              <li class="dropdown-item remarks-dropdown" data-key="${key}" data-value="${value}"> ${value} </li>
              `;

              dropDown.append(li);
            }
          }

          $(".dropdown-item").click(insertTrackHistory);

        } else { //load teams 

          data = data[0]

          data.forEach(element => {
            // console.log(element);
            let li = `
                <li class="dropdown-item" data-team_id="${element.team_id}"> ${element.team_name} </li>
            `;

            dropDown.append(li);
          });

          $(".dropdown-item").click(updateTeam);
        }

      },
      error: (error) => {
        // console.error(error);
      }
    });


    // update team id
    function updateTeam(e) {
      let team_id = $(e.target).data("team_id");
      // console.log(team_id);

      // alert("team id = " + team_id);

      $.ajax({
        url: "../repos/manage_requests.php",
        type: "POST",
        data: {
          request: "UPDATE_TEAM",
          team_id,
          request_id: "<?php echo $_GET['request_id'] ?>"
        },
        success: (data) => {
          alert(data);
          window.location.reload();
        },
        error: (error) => {
          console.error(error);
        }
      });
    }


    function insertTrackHistory(e) {
      let key = $(e.target).data("key");
      let value = $(e.target).data("value");


      $.ajax({
        url: "../repos/manage_requests.php",
        type: "POST",
        data: {
          request: "INSERT_HIS",
          remark: key,
          message: value,
          request_id: "<?php echo $_GET['request_id'] ?>"
        },
        success: (data) => {
          // console.log(data);
          alert(data);
          window.location.reload();
        },
        error: (error) => {
          console.error(error);
        }
      });
    }


    // load request history
  </script>
</body>

</html>