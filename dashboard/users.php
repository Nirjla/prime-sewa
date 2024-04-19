<?php
include "../frontend/db.php";
include('header.php');
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM users";
$result = $conn->query($query);
if ($result->num_rows > 0) {
      $users = $result->fetch_all(MYSQLI_ASSOC);
      // print_r($users);
} else {
      $users = [];
}


?>
<div class="container mt-5">
      <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="card-title">
                        <h5>Users Lists </h5>

                  </div>
            </div>
            <div class="card-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                              <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone </th>
                                    <th scope="col">Email </th>
                                    <th scope="col">Role</th>

                              </tr>
                        </thead>
                        <tbody>
                              <?php
                              foreach ($users as $index => $user) :
                              ?>
                                    <tr>
                                          <th scope="row"><?php echo $index + 1 ?></th>
                                          <td><?= $user['name'] ?></td>
                                          <td><?= $user['phone'] ?></td>
                                          <td><?= $user['email'] ?></td>
                                          <td><?= $user['role'] ?></td>
                                    </tr>

                              <?php endforeach ?>
                        </tbody>
                  </table>
            </div>
      </div>
</div>