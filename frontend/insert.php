<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

// Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;

// require 'vendor/autoload.php';


include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// function sendemail_verify($name, $email, $verify_token)
// {

//       //Declare the object of PHPMailer

//       $mail = new PHPMailer();
//       $mail->SMTPDebug = 3; // Enable verbose debug output

//       $mail->isSMTP();
//       $mail->SMTPAuth = true;
//       $mail->Host = "smtp.gmail.com";
//       $mail->Username  = "primesewa2024@gmail.com";
//       $mail->Password = "primeprime";
//       $mail->SMTPSecure = 'tls';
//       $mail->Port       = 587;
//       $mail->SetFrom('primesewa2024@gmail.com', $name);
//       $mail->AddAddress($email);
//       $mail->isHTML(true);
//       $mail->Subject = "Email Verifications From Prime Sewa";
//       $email_template = "
//       <h2>You have Registered with Prime Sewa</h2>
//       <h5>Verify your email address to login with the below given link</h5>
//       <br/>
//       <br/>
//       <a href='http://localhost/prime-sewa/frontend/frontend/auth/verify-email.php/$verify_token'>Click Me</a>
//       ";
//       $mail->Body = $email_template;
//       $mail->send();
//       var_dump($mail->send());
// }

function sanitizeInput($data)
{
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
      $name = sanitizeInput($_POST['name']);
      $phone = sanitizeInput($_POST['phone']);
      $email = sanitizeInput($_POST['email']);
      $password = sanitizeInput($_POST['password']);
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);
      $verify_token = md5(rand());
      // echo $name;
      var_dump($verify_token);
      // if (empty($name) || empty($phone) || empty($email) || empty($password)) {
      //       $_SESSION['error'] = "All fields are required";
      //       header("Location:register.php");
      // }

      // if (strpos($email, 'prime.edu.np') === false) {
      //       $_SESSION['error'] = "Only prime students are allowed to register";
      //       header('Location:register.php');
      //       exit();
      // }
      $check_email_query = "SELECT email FROM users WHERE email = '$email'";

      $check_email_query_execute = mysqli_query($conn, $check_email_query);
      if (mysqli_num_rows($check_email_query_execute) > 0) {
            // session_start();
            $_SESSION['status'] = "Registration Failed!";
            header('Location: register.php');
            exit();
      } else {
            $query = "INSERT INTO users (name, phone, email, password, verify_token) VALUES ('$name', '$phone', '$email', '$hashed_password', '$verify_token')";
            $query_execute = mysqli_query($conn, $query);

            if ($query_execute) {
                  // sendemail_verify("$name", "$email", "$verify_token");
                  // session_start();
                  $_SESSION['status'] = 'Registration Successful!';
                  header("Location: register.php");
                  exit();
            } else {
                  $_SESSION['status'] = "Registration Failed";
                  header("Location: register.php");
                  exit();
            }
      }
}
