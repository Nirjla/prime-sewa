<?php
include('db.php');
$email = $_POST['email'];
// print_r($email);
$check_email_query = "SELECT * FROM users WHERE email = '$email'";
$check_email_query_execute = mysqli_query($conn, $check_email_query);
// print_r($check_email_query_execute);
echo (mysqli_num_rows($check_email_query_execute));
if(mysqli_num_rows($check_email_query_execute) > 0){
      return 1;
}
else{
      return 0;
}
 
?>