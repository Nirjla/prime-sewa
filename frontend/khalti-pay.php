<?php
session_start();
include "../frontend/db.php";

if ($conn) {
  // echo "Connection";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $payment = $_POST['payment'];
  $converted_payment = (float)$payment * 100;
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $user_id = $_POST['user_id'];
  $donate_id = $_POST['donation_id'];
  $address = $_POST['address'];
  $remarks = $_POST['remarks'];

  try {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
        "return_url": "http://localhost/prime-sewa/frontend",
        "website_url": "http://localhost",
        "amount": "' . $converted_payment . '",
        "purchase_order_id": "Order01",
        "purchase_order_name": "test",
        "customer_info": {
          "name": "' . $name . '",
          "email": "' . $email . '",
          "phone": "' . $phone . '"
        }
      }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Key e6acf73475c0480f93d9b6674b489c55',
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    echo $response;
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_code == 200) { // Check if the request was successful
      $response_data = json_decode($response, true);
      $payment_url = $response_data['payment_url'];

      // Insert data into the database
      $insert_query = $conn->prepare('INSERT INTO donations_users (user_id, donate_id, address, amount, remarks) VALUES (?, ?, ?, ?, ?)');
      $insert_query->bind_param('iisis', $user_id, $donate_id, $address, $converted_payment, $remarks);
      $insert_query->execute();
      $_SESSION['status'] = "Donated successfully";

      // Redirect user to payment URL
      header('Location: ' . $payment_url);
      exit();
    } else {
      // Handle unsuccessful payment initiation
      echo "Error: Payment initiation failed.";
    }
  } catch (Exception $e) {
    die('Error: ' . $e->getMessage());
  }
} else {
  echo "Error: Invalid request method.";
}
