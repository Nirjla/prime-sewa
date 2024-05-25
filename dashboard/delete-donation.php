<?php
include "../frontend/db.php";
session_start();
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $donation_id = $_GET['id'];

      $query = "DELETE FROM donations WHERE id = $donation_id";
      $result = $conn->query($query);
      if ($result) {
            $_SESSION['status'] = 'Data Deleted Successfully';
            header("Location:http://localhost/prime-sewa/dashboard/donation.php");
            exit();
      }
}
