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
  <title>Progressing Requests</title>
  <!-- <link rel="stylesheet" href="../../user/styles/view-apt.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="../styles/manage-teams.css">
</head>

<body>
  <?php
  include "./navbar.php";
  ?>
  <!-- ------ -->
  <div class="card-header text-center p-3 my-5">
    <h3>In-Progress Requests</h3>
  </div>

  <div class="container mt-5">
    <!-- Search Field -->
    <div class="row  mb-4">
      <div class="col-md-6 ms-auto">
        <input type="text" id="SEARCH_FIELD" class="form-control search-input border border-secondary" placeholder="Search by name, email, or mobile..." aria-label="Search">

        <div class="d-flex gap-5">
          <span>
            <input type="radio" name="status" id="IN_PROGRESS" value="IN_PROGRESS" onclick="searchFun()" checked> <label for="IN_PROGRESS">: IN PROGRESS</label>
          </span>
          <span>
            <input type="radio" name="status" id="ON_THE_WAY" onclick="searchFun()" value="ON_THE_WAY"> <label for="ON_THE_WAY">: ON THE WAY</label>
          </span>
          <span>
            <input type="radio" name="status" id="BOTH" onclick="searchFun()" value="BOTH"> <label for="BOTH">: BOTH</label>
          </span>
        </div>
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
    // load all data

    // function loadInProgressRequests() {


    //   $.ajax({
    //     url: "../repos/get_inprogress.php",
    //     type: "GET",

    //     success: (data) => {
    //       // console.log(data);
    //       $("#TBL_BODY").html(data);
    //     },
    //     error: (error) => {
    //       console.error(error);
    //     }
    //   });
    // }
    // loadInProgressRequests();


    // search fun.
    let time;

    $("#SEARCH_FIELD").keyup(searchFun);

    function searchFun() {


      let status = document.querySelector("input[type=radio]:checked").value;

      clearTimeout(time);

      time = setTimeout(() => {
        let searchVal = $("#SEARCH_FIELD").val();

        $.ajax({
          url: "../repos/get_progression_reports.php",
          type: "GET",
          data: {
            searchVal,
            "status": status
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

    // console.log(document.querySelector("input[type=radio]"));

    // document.querySelector("input[type=radio]").forEach(element => {
    //   element.addEventListener('click', () => {
    //     alert("clicked");
    //   })
    // });

    searchFun();
  </script>

</body>

</html>