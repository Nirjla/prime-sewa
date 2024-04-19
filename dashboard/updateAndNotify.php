<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';
include "../frontend/db.php";
include('sendEmail.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $status = $_POST['status'];
      // echo $status;
      $id = $_POST['id'];
      // Update volunteer status using prepared statement to prevent SQL injection
      if($status==1){
            $updateQuery ="UPDATE volunteers SET request = 0, status = 1 WHERE id = ?";
            $_SESSION['count'] = 1;
            // echo $_SESSION['count'];
      }
      else{
            $updateQuery="UPDATE volunteers SET request = 0, status = 0 WHERE id = ?";
      }
      $stmt = $conn->prepare($updateQuery);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->close();

      // Send email notification
      $query = "SELECT u.name, u.email, e.event_title, e.event_date, e.venue
              FROM users u
              JOIN volunteers v ON u.id = v.user_id
              JOIN events e ON v.event_id = e.id
              WHERE v.id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                  $volunteer_name = $row['name'];
                  $volunteer_email = $row['email'];
                  $event_title = $row['event_title'];
                  $event_date = $row['event_date'];
                  $venue = $row['venue'];

                  $fromEmail = 'primesewa2024@gmail.com';
                  $fromName = 'Prime Sewa Non-Profit Organization';
                  $toEmail = $volunteer_email;
                  $toName = $volunteer_name;
                  $subject = 'About Volunteering Request';

                  $body = ($status == 1)
                        ? "<p>Dear $volunteer_name,</p>
                   <p>Thank you for your interest in volunteering for the event <strong>$event_title</strong>.</p>
                   <p>Please arrive at the following location:</p>
                   <ul>
                       <li><strong>Event Name:</strong> $event_title</li>
                       <li><strong>Event Date:</strong> $event_date</li>
                       <li><strong>Venue:</strong> $venue</li>
                   </ul>
                   <p>Regards,<br>Prime Sewa Non-Profit Organization</p>"
                        : "<p>Dear $volunteer_name,</p>
                   <p>You have crossed your volunteering limits</p>";

                  sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body);
            }
      } else {
            echo "No rows found!";
      }

      $stmt->close();
      $conn->close();
} else {
      echo "Invalid request method!";
}

