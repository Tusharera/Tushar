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
  <title>New Requests</title>
  <!-- <link rel="stylesheet" href="../../user/styles/view-apt.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="../styles/manage-teams.css">

</head>

<body>
  <?php
  include "./navbar.php";
  ?>
  <!-- ------ -->
  <div class="card-header text-center p-3 my-5">
    <h3>New Requests</h3>
  </div>

  <div class="container mt-5">
    <!-- Search Field -->
    <div class="row justify-content-center mb-4">
      <div class="col-md-6 ms-auto">
        <input type="text" id="SEARCH_FIELD" class="form-control search-input  border border-secondary" placeholder="Search by name, email, or mobile..." aria-label="Search">
      </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-dark">
        <thead>
          <tr>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="TBL_BODY">

        </tbody>
      </table>
    </div>
  </div>
  <!-- -------- -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
    let time;

    $("#SEARCH_FIELD").keyup(searchFun);

    function searchFun() {

      clearTimeout(time);

      time = setTimeout(() => {
        let searchVal = $("#SEARCH_FIELD").val();

        $.ajax({
          url: "../repos/get_new_reports.php",
          type: "GET",
          data: {
            searchVal
          },
          success: (data) => {
            // console.log(data);
            $("#TBL_BODY").html(data);
          },
          error: (error) => {
            console.error(error);
          }
        });
      }, 1000);
    }
    searchFun();
  </script>

</body>

</html>