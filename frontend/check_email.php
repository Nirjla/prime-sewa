<?php

// print_r();

include('db.php');
$email = $_POST['email'];
$check_email_query = "SELECT * FROM users WHERE email = '$email'";
$check_email_query_execute = mysqli_query($conn, $check_email_query);
// print_r(mysqli_num_rows($check_email_query_execute) > 0);
if (mysqli_num_rows($check_email_query_execute) > 0) {
      echo '1';
} else {
      echo '0';
}
