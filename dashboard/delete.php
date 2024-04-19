<?php
include "../frontend/db.php";
session_start();
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $event_id = $_GET['id'];

      $query = "DELETE FROM events WHERE id = $event_id";
      $result = $conn->query($query);
      if ($result) {
            $_SESSION['status'] = 'Data Deleted Successfully';
            header("Location:http://localhost/prime-sewa/dashboard/event.php");
            exit();
      }
}
