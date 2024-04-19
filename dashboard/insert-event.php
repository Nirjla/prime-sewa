<?php
session_start();
include "../frontend/db.php";

if ($conn) {
      // echo "Connection";
}
function sanitizeInput($data)
{
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user_id = $_SESSION['user_id'];
      // echo $user_id;
      $event_title = sanitizeInput($_POST['event-title']);
      // echo $event_title;
      $event_date = sanitizeInput($_POST['event-date']);
      // echo $event_date;
      $event_venue = sanitizeInput($_POST['venue']);
      $register_deadline = sanitizeInput($_POST['register-deadline']);
      // echo $register_deadline;
      $club_name = sanitizeInput($_POST['club-name']);
      // echo $club_name;
      $event_priority = sanitizeInput($_POST['priority']);
      // echo $event_priority;
      $seat_limit = sanitizeInput($_POST['seat-limit']);
      // echo $seat_limit;
      $status = sanitizeInput($_POST['status']);
      // echo $status;
      // $event_img = sanitizeInput($_POST['event-img'];

      $event_img = $_FILES['event-img'];
      // print_r($_FILES['event-img']);
      $targetDir = "../uploads/events/";
      $filename = basename($_FILES['event-img']['name']);
      // echo $filename;
      // print_r($_FILES['event-img']['error']);
      $targetFilePath = $targetDir . $filename;
      move_uploaded_file($_FILES['event-img']['tmp_name'], $targetFilePath);
      $event_desc = sanitizeInput($_POST['event-desc']);
      // echo $event_desc;
      // $uploadMaxFileSize = ini_get('upload_max_filesize');
      // $postMaxSize = ini_get('post_max_size');

      // echo "Maximum upload file size: $uploadMaxFileSize<br>";
      // echo "Maximum POST data size: $postMaxSize<br>";
      if(empty($event_title) || empty($event_venue) || empty($event_desc) || empty($event_img) || empty($event_date) || empty($event_priority) || empty($register_deadline) || empty($club_name) || empty($seat_limit) ||   empty($status)){
            $_SESSION['status'] = "All Fields are required";
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();   
      }



      try {
            $insert_query  = $conn->prepare('INSERT INTO events (user_id, event_title, event_img, event_desc, event_priority, event_date, event_deadline, club_name, venue, seat_limit, status) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $result =   $insert_query->bind_param('isssissssii', $user_id, $event_title, $targetFilePath, $event_desc, $event_priority, $event_date, $register_deadline, $club_name,  $event_venue,$seat_limit, $status);
            if ($insert_query->execute()) {
                  $_SESSION['status'] = "Data inserted successfully";
                  header("Location:" . $_SERVER['HTTP_REFERER']);
                  exit();
            }
      } catch (Exception $e) {
            die('Error:' . $e->getMessage());
      }
      if (!$insert_query->execute()) {

            die('Error in executing the statement:' . $insert_query->error);
      }

      $insert_query->close();
}
$conn->close();
