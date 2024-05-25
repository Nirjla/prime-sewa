<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!empty(trim($_POST['verify-email'])) && !empty(trim($_POST['password']))) {
            $email = mysqli_real_escape_string($conn, $_POST['verify-email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $login_query = "SELECT * FROM users WHERE email = '$email'";
            $login_query_execute = mysqli_query($conn, $login_query);
            if (mysqli_num_rows($login_query_execute) > 0) {
                  $user_data = mysqli_fetch_assoc($login_query_execute);
                  $hashed_password = $user_data['password'];
                  if (password_verify($password, $hashed_password)) {
                        $_SESSION['user_id'] = $user_data['id'];
                        $_SESSION['status'] = "Login Successfully";
                        $role = $user_data['role'];
                        if ($role == 'user') {
                              $_SESSION['UserLogin'] = $user_data['id'];
                              header("Location: index.php");
                              exit();
                        } else {
                              $_SESSION['AdminLogin'] = $user_data['id'];
                              header("Location: index.php");
                              exit();
                        }
                  } else {
                        $_SESSION['status'] = "Invalid Email or Password";
                        header('Location: http://localhost/prime-sewa/frontend/frontend/register.php');
                        exit();
                  }
            } else {
                  $_SESSION['status'] = "Invalid Email or Password";
                  header('Location: http://localhost/prime-sewa/frontend/frontend/register.php');
                  exit();
            }
      } else {
            $_SESSION['status'] = "All fields are required";
            header("Location: http://localhost/prime-sewa/frontend/frontend/register.php");
            exit();
      }
} else {
      $_SESSION['status'] = "Method not allowed";
      header("Location: http://localhost/prime-sewa/frontend/frontend/register.php");
      exit();
}
