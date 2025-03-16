
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $addr = $_POST['address'];
  $msg = $_POST['message'];
  $date = date('Y-m-d H:i:s');

  require "../../config/connect.php";

  $row = mysqli_query($conn, "INSERT INTO `fire_report`( `full_name`, `mobile`, `email`, `location`, `message`, `assign_to`, `status`, `posting_date`, `assignment_time`) VALUES ('" . $name . "','" . $mobile . "','" . $email . "','" . $addr . "','" . $msg . "','none','none','" . $date . "','null')");

  if ($row >= 1) {
    echo "
    <script>
    alert('Report Submitted..');

    window.location.replace('../views/fire-register.php');
    </script>
    ";
  } else {
    echo "
    <script>
      alert('Something went Wrong..');
      window.location.replace('../views/fire-register.php');
    </script>
    ";
  }
  // header("Location:../views/fire-register.php");

  // print_r([$name, $email, $mobile, $addr, $msg, $date]);
}
?>