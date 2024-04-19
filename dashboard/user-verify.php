<?php
include "../frontend/db.php";
session_start();

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
      if (!empty(trim($_POST['verify-email'])) && !empty(trim($_POST['password'])))
            // echo($_POST['verify-email']);
            $email = mysqli_real_escape_string($conn, $_POST['verify-email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $login_query = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
      $login_query_execute = mysqli_query($conn, $login_query);
      // print_r($login_query_execute);
      if (mysqli_num_rows($login_query_execute) > 0) {
            $user_data = mysqli_fetch_assoc($login_query_execute);
            $_SESSION['user_id'] = $user_data['id'];
            $role = $user_data['role'];
            print_r($role);
            if ($role == 'user') {
                  session_start();
                  $_SESSION['UserLogin'] = $user_data['id'];
                  header("Location:index.php");
                  exit();
            } else {
                  session_start();
                  $_SESSION['AdminLogin'] = $user_data['id'];

                  header("Location:http://localhost/prime-sewa/dashboard/");
                  exit();
            }
            // print_r($user_data);
      } else {

            // $_SESSION['status'] = "Invalid Email or password";
            header('Location:http://localhost/prime-sewa/frontend/frontend/register.php');
            exit();
      }
} else {
      $_SESSION['status'] = "ALl fields are required";
      header("Location:http://localhost/prime-sewa/frontend/frontend/register.php");
      exit();
}
