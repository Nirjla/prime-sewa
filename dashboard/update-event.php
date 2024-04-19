<?php
session_start();
// $event_id = $_SESSION['event_id'];
// echo $event_id;
include "../frontend/db.php";

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
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
      $event_id = $_POST['event_id'];
      // echo $event_id;
      // echo $user_id;
      $event_title = sanitizeInput($_POST['event-title']);
      // echo $event_title;
      $event_date = sanitizeInput($_POST['event-date']);
      // echo $event_date;
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
      $targetFilePath = $_POST['prev-event-img'];
      if($_FILES['event-img']['error'] !== UPLOAD_ERR_NO_FILE){
            $event_img = $_FILES['event-img'];
            // print_r($_FILES['event-img']);
            $targetDir = "../uploads/events/";
            $filename = basename($_FILES['event-img']['name']);
            // echo $filename;
            // print_r($_FILES['event-img']['error']);
            $targetFilePath = $targetDir . $filename;
            move_uploaded_file($_FILES['event-img']['tmp_name'], $targetFilePath);

      }
      $event_desc = sanitizeInput($_POST['event-desc']);

      try {
            $query = "SELECT * FROM events WHERE event_title= ? AND id != ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $event_title, $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                  $_SESSION['status'] = "Title Already exists";
                  header("Location:" . $_SERVER['HTTP_REFERER']);
                  exit();
            }
            $query = "UPDATE events SET user_id=?, event_title=?, event_img=?, event_desc=?, event_priority=?, event_date=?, event_deadline=?, club_name=?, seat_limit=?, status=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isssisssiii", $user_id, $event_title, $targetFilePath, $event_desc, $event_priority, $event_date, $register_deadline, $club_name, $seat_limit, $status, $event_id);
            if ($stmt->execute()) {
                  $_SESSION['status'] = "Data updated successfully";
                  header("Location:http://localhost/prime-sewa/dashboard/event.php");
                  exit();
            } else {
                  die("Update failed: " . $stmt->error);
            }
      } catch (Exception $e) {
            die("Error:" . $e->getMessage());
      }
}
