<?php include('./header.php');
include('db.php');
session_start();
echo $user_id;
if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $query = "SELECT * FROM users  where id=$user_id ";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();
            print_r($user);
      }
}
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $donation_id = $_GET['id'];
      echo $donation_id;
}
$query2 = "SELECT * FROM donations where id = $donation_id";
$result2 = $conn->query($query2);

if ($result2->num_rows > 0) {
      $donation = $result2->fetch_assoc();
      print_r($donation);
      // print_r($donations);
}
?>
<div class="donation-details">
      <div class="donation-bg">
            <div class="donation-heading ">
                  <h1>Make a Donation</h1>
            </div>
      </div>
      <form action="khalti-pay.php" method="post">
      <div class="donation-container">
            <div class="container">
                  <div class="position-relative">
                        <div class="donation-box ">
                              <div class="donation-img">
                                    <img src="../assets/donations.jpg" alt="" class="img-fluid" width="700" height='450'>
                              </div>
                              <div class="donation-content">
                                    <span> You are donating to: </span>
                                    <h4><?= $donation['donation_title'] ?></h4>
                              </div>
                        </div>

                        
                        <div class="donation-payment--bar position-absolute">
                              <div class="donation-payment--bar_inner">
                                          <h5>Select Donation Method</h5>
                                          <input type="hidden" name='user_id' value="<?=$user_id?>">
                                          <input type="hidden" name='donation_id' value="<?=$donation_id?>">
                                          <input type='text' class="form-control" placeholder="Amount (NRS)" name='payment' />
                                          <h6>Payment Method</h6>
                                          <div class="khati-pay">
                                                <img src="../assets/clubs/khalti-logo.svg" alt="" class="img-fluid">
                                          </div>
                                          <?php
                                          // echo $_SESSION['loggedIn'];
                                          if (isset($_SESSION['user_id'])) {
                                          ?>
                                                <button>Pay Now</button>
                                          <?php
                                          }
                                          ?>
                                    </div>
                              </div>

                  </div>
            </div>
      </div>
      <div class="container">
            <div class="col-lg-7">

                  <div class="donation-details-form">
                        <?php
                        // echo $_SESSION['loggedIn'];
                        if (!isset($_SESSION['user_id'])) {
                        ?>
                              <div class="check_auth">
                                    <p>You must
                                          <a href="login.php"> Login</a>
                                          or
                                          <a href="register.php">Register</a>

                                          to donate
                                    </p>
                              </div>
                        <?php
                        }
                        ?>
                        <h5>Personal Details</h5>
                        <div class="row">
                              <div class="col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Your Name" name='name' value="<?= $user['name']  ?>">
                              </div>
                              <div class="col-lg-6 mb-3">
                                    <input type="email" class="form-control" name='email' placeholder="Enter Your Email" value="<?= $user['email'] ?>">
                              </div>
                              <div class="col-lg-6 mb-3">
                                    <input type="text" class="form-control" name='phone' placeholder="Enter Your Phone" value="<?= $user['phone'] ?>">
                              </div>
                              <div class="col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Your Address" name="address">
                              </div>
                              <div class="col-lg-12 mb-3">
                                    <textarea name="remarks" placeholder="Remarks here..." class="form-control" cols="30" rows="10"></textarea>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</form>
</div>
