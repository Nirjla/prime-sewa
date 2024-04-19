<?php
include "../frontend/db.php";
session_start();
$user_id = $_SESSION['user_id'];
$event_title = $_POST['eventTitle'];
$check_title_query = "SELECT * FROM events WHERE user_id = $user_id";
$check_title_query_execute = mysqli_query($conn, $check_title_query);
if (mysqli_num_rows($check_title_query_execute) > 0) {
      $row = mysqli_fetch_assoc($check_title_query_execute);
      if ($event_title == $row['event_title']) {
            echo '1';
      } else {
            echo '0';
      }
} else {
      return 0;
}
