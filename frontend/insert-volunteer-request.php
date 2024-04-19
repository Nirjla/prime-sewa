<?php
include('db.php');
session_start();
include_once('http://localhost/prime-sewa/dashboard/sendEmail.php');

if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user_id = $_POST['user_id'];
      if (empty($user_id)) {
            $_SESSION['status'] = "You must login or register before volunteering.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
      }
      $event_id = $_POST['event_id'];
      $remarks = $_POST['remarks'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($remarks)) {
            $_SESSION['status'] = "All fields are required";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
      }

      // Check if the event_id already exists in the volunteers table
      $query2 = "SELECT * FROM volunteers WHERE event_id = ? and user_id=?";
      $stmt2 = $conn->prepare($query2);
      $stmt2->bind_param("ii", $event_id, $user_id);
      $stmt2->execute();
      $stmt2->store_result();

      if ($stmt2->num_rows > 0) {
            $_SESSION['status'] = 'You have already requested for volunteering';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
      }

      // Prepare the SQL statement for inserting into volunteers table
      $query = "INSERT INTO volunteers (user_id, event_id,address, remarks) VALUES (?, ?,?, ?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("iiss", $user_id, $event_id, $address, $remarks);

      // Execute the insert statement
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
            $_SESSION['status'] = 'Your request has been received. We will send mail for the confirmation as soon as possible';
      } else {
            $_SESSION['status'] = 'Insertion failed';
      }

      // Close the statements
      $stmt->close();
      $stmt2->close();
      $conn->close();

      // Redirect back to the previous page
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
}
