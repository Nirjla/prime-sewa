<?php
session_start();
include "../frontend/db.php";
include('header.php');

// Assuming you have a database connection, replace these with your actual database credentials

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the donations_users table
// $query = "SELECT id, user_id, donate_id, organization_name, address, payment_type, payment_status, remarks FROM donations_users";
$query = "SELECT du.id, du.user_id, du.donate_id, u.name AS username, d.donation_title AS donation_title, du.organization_name, du.address, du.payment_type, du.payment_status, du.remarks 
          FROM donations_users du
          JOIN users u ON du.user_id = u.id
          JOIN donations d ON du.donate_id = d.id";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    $donationUsers = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $donationUsers = [];
}

// Close the connection
$conn->close();
?>

<?php 

// $user_id = $_SESSION['user_id'];
function getUserName($conn,$user_id){
      $query = "SELECT * FROM users WHERE id=$user_id";
      $result = mysqli_query($conn, $query);
      if($result){
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            return $row['name'];
      }

}
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h5>Donation User Lists</h5>
            </div>
            <div>
            <a href="donation.php" class="btn btn-primary">
                              <i class='bx bx-plus'></i> Back
                        </a>
            <a href="donation-request.php" class="btn btn-primary">
                    <i class='bx bx-plus'></i> Request Lists
                </a>
                <a href="create-donation.php" class="btn btn-primary">
                    <i class='bx bx-plus'></i> Add Donation
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Organization Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donationUsers as $index => $user) : ?>
                        <tr>
                            <th scope="row"><?php echo $index + 1; ?></th>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['donation_title']; ?></td>
                            <td><?php echo $user['organization_name']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['payment_type']; ?></td>
                            <td><?php echo $user['payment_status']; ?></td>
                            <td><?php echo $user['remarks']; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('footer.php');

?>