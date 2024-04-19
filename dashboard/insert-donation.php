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
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
      $user_id = 1;
      if (isset($_SESSION['user_id'])) {
            echo $user_id;
      }
      $donation_title = ($_POST['donation-title']);
      echo $donation_title;
      $donation_name = sanitizeInput($_POST['donation-name']);
      $donation_location = sanitizeInput($_POST['donation-location']);
      $status = sanitizeInput($_POST['status']);

      // $donation_img = sanitizeInput($_POST['donation-img']);
      $donation_img = $_FILES['donation-img'];
      $targetDir = "../uploads/donations/";
      $filename = basename($_FILES['donation-img']['name']);
      // echo $filename;
      // print_r($_FILES['donation-img']['error']);
      $targetFilePath = $targetDir . $filename;
      if (move_uploaded_file($_FILES['donation-img']['tmp_name'], $targetFilePath)) {
            echo $filename . "success";
      }
      else{
            echo "Error: " . $_FILES['donation-img']['error'];
      }
      $uploadMaxFileSize = ini_get('upload_max_filesize');
      $postMaxSize = ini_get('post_max_size');

      // echo "Maximum upload file size: $uploadMaxFileSize<br>";
      // echo "Maximum POST data size: $postMaxSize<br>";

      $donation_desc = sanitizeInput($_POST['donation-desc']);
      try {
            $insert_query =  $conn->prepare('INSERT INTO donations (user_id,donation_title,donation_desc,donation_img,organization_name,organization_location,status) VALUES (?,?,?,?,?,?,?)');
            $result = $insert_query->bind_param('isssssi', $user_id, $donation_title, $donation_desc, $targetFilePath, $donation_name, $donation_location, $status);
            echo $result;
      } catch (Exception $e) {
            die('Error' . $e->getMessage());
      }
      if (!$insert_query->execute()) {

            die('Error in executing the statement:' . $insert_query->error);
      }
      $insert_query->close();
}
$conn->close();
