<?php
require "../../config/connect.php";

$search = $_GET['searchVal'];

if (trim($search) != "" && (strlen($search)) >= 5) {

  $result = mysqli_query($conn, "SELECT * FROM fire_report WHERE 
                                  full_name LIKE '%" . $search . "%' OR 
                                  mobile LIKE '%" . $search . "%' OR 
                                  email LIKE '%" . $search . "%' OR 
                                  location LIKE '%" . $search . "%' ");

  $count = mysqli_num_rows($result);

  if ($count > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
                  <td>" . $row['full_name'] . "</td>
                  <td>" . $row['mobile'] . "</td>
                  <td>" . $row['email'] . "</td>
                  <td>" . $row['posting_date'] . "</td>
                  <td><a href='show-status.php?request_id=" . $row['id'] . "' class='btn btn-view'>View</a></td>
                </tr>";
    }
  } else {
    echo "<tr><td colspan='5' class='text-danger h5'>No Reports Avl</td></tr>";
  }
} else {
  echo "<tr><td colspan='5' class=' h5'>Search Atleast 5 characters to search</td></tr>";
}
// echo "</table>";
