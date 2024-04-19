<?php
include "../frontend/db.php";
include('header.php');
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM donations";
$result = $conn->query($query);
if ($result->num_rows > 0) {
      $donations = $result->fetch_all(MYSQLI_ASSOC);
      // print_r($donations);
} else {
      $donations = [];
}


?>
<div class="container mt-5">
      <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="card-title">
                        <h5>Donation Lists</h5>
                  </div>
                  <div>
                        <a href="donation.php" class="btn btn-primary">
                              <i class='bx bx-plus'></i> Back
                        </a>
                        <a href="donation-users.php" class="btn btn-primary">
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
                                    <th scope="col">Donation Title</th>
                                    <th scope="col">Donation Image</th>
                                    <th scope="col">Donation Description</th>
                                    <th scope="col">Organization Name Type</th>
                                    <th scope="col">Organization Location</th>
                                    <th scope="col">Status</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php foreach ($donations as $index => $donation) : ?>
                                    <tr>
                                          <td><?= $index + 1 ?></td>
                                          <td><?= $donation['donation_title'] ?></td>
                                          <td><img src="<?= $donation['donation_img']; ?>" /></td>
                                          <td><?= $donation['donation_desc'] ?></td>
                                          <td><?= $donation['organization_name'] ?></td>
                                          <td><?= $donation['organization_location'] ?></td>
                                          <td><?= $donation['status'] ?></td>
                                    </tr>
                              <?php endforeach ?>
                        </tbody>
                  </table>
                  </tbody>
                  </table>
            </div>
      </div>
</div>
<?php
include('footer.php');

?>