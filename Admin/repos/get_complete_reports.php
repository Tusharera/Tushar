<?php

require "../../config/connect.php";

$search = $_GET['searchVal'];

$search = mysqli_real_escape_string($conn, $search);

$query = "SELECT * FROM fire_report WHERE 
                (full_name LIKE '%$search%' OR 
                mobile LIKE '%$search%' OR 
                email LIKE '%$search%' OR 
                location LIKE '%$search%') AND status = 'COMPLETE' ";

$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);

if ($count > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                    <td>" . htmlspecialchars($row['mobile']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['location']) . "</td>
                    <td>" . htmlspecialchars($row['posting_date']) . "</td>
                    <td><a href='show-fire-status.php?request_id=" . intval($row['id']) . "' class='btn btn-success btn-view'>View</a></td>
                  </tr>";
  }
} else {
  echo "<tr>
    <td colspan='6' class='text-center '>No Reports AVL.</td>
  </tr>";
}
