<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';
include('sendEmail.php');
session_start();

include "../frontend/db.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful";
}

// function sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body)
// {
//     $mail = new PHPMailer(true);
//     try {
//         $mail->isSMTP();
//         $mail->SMTPAuth = true;
//         $mail->Host = 'smtp.gmail.com';
//         $mail->Username = 'shakyanirjala6@gmail.com';   // Update with your email
//         $mail->Password = 'gxdw ihop ozxt flvl';       // Update with your app password
//         $mail->Port = 465;
//         $mail->SMTPSecure = 'ssl';
//         $mail->setFrom($fromEmail, $fromName);
//         $mail->addAddress($toEmail, $toName);
//         $mail->isHTML(true);
//         $mail->Subject = $subject;
//         $mail->Body = $body;
//         if (!$mail->send()) {
//             return 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
//         } else {
//             return 'Message has been sent.';
//         }
//     } catch (Exception $e) {
//         return 'Email not sent an error was encountered: ' . $e->getMessage();
//     }
// }

function updateStatusAndNotify($status, $conn, $volunteer_user)
{
    echo $status;
    $_SESSION['status'] = $status;
    $query = "UPDATE volunteers SET status = $status  WHERE user_id = $volunteer_user";
    $query2 = "SELECT name , email FROM users WHERE id = $volunteer_user ";
    // $query = "SELECT u.name from users u  WHERE u.id= $volunteer_user JOIN volunteers v WHERE v.user_id = u.id and UPDATE volunteers SET status = $status WHERE v.user_id =u.id" ;
    $result = $conn->query($query);
    $result2 = $conn->query($query2);
    

    if (!$result && !$result2) {
        return "Error updating record: " . $conn->error;
    }
    if($result2->num_rows>0){
        while($row = $result2->fetch_assoc()){
            $volunteer_name = $row['name'];
            $volunteer_email = $row['email'];
        }
    }

    $fromEmail = 'primesewa2024@gmail.com';
    $fromName = 'Prime Sewa Non-Profit Organization';
    $toEmail = $volunteer_email;
    $toName = $volunteer_name;
    $subject = 'About Volunteering Request';
    $body = $_SESSION['status']== 0?'Sorry, Your have cross your volunteering limits':'
    Dear <b>,'.$volunteer_name.'</b>
    You are accepted for volunteering';
    sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['volunteer_user'])) {
    echo "Status:" . $_POST['status'];
    $status = $_POST['status'];
    $volunteer_user = $_SESSION['volunteer_user'];
    echo $volunteer_user;
    $response = updateStatusAndNotify($status, $conn, $volunteer_user);
    echo $response;
}
