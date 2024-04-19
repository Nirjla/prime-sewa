<?php
session_start();
$user_id = $_SESSION['user_id'];
echo $user_id;
include "../frontend/db.php";
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      try{
            $month = $_POST['months'];
            echo $month;
            $count = $_POST['count'];
            echo $count;
            $query = "INSERT INTO settings (user_id, time_limit,volunteer_count) VALUES ($user_id,$month, $count)";
            $result =  $conn->query($query);
            print_r($result);
            if ($result) {
                  $_SESSION['status'] = "Settings Set Sucessfully";
                  header("Location:" . $_SERVER['HTTP_REFERER']);
                  exit();
            }
}
catch(Exception $e){
      die("Error:".$e->getMessage());
}
}
