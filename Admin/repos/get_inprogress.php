<?php

require "../../config/connect.php";

$query = "SELECT * FROM fire_report WHERE status = 'ON_THE_WAY' or status = 'IN_PROGRESS' ";

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
    <td colspan='6' class='text-center'>No Reports AVL.</td>
  </tr>";
}
