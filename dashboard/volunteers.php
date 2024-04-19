<?php
include('header.php');
include "../frontend/db.php";
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * ,v.status as v_status FROM users u join volunteers v on v.user_id = u.id 
join events e on e.id = v.event_id where v.status=1";
$result = $conn->query($query);
if ($result->num_rows > 0) {
      $volunteers = $result->fetch_all(MYSQLI_ASSOC);
      // print_r($events);
} else {
      $volunteers = [];
}

?>
<div class="container mt-5">
      <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="card-title">
                        <h5>Volunteer Lists </h5>
                        <div class="request-list">
                              <a href='volunteer-request.php' class="btn btn-primary">Request Lists</a>
                        </div>
                  </div>
            </div>
            <div class="card-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                              <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> Name</th>
                                    <th scope="col">Event Title </th>
                                    <th scope="col">Apply Date </th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Remarks</th>


                              </tr>
                        </thead>
                        <tbody>
                              <?php
                              foreach ($volunteers as $index => $volunteer) :
                              ?>
                                    <tr>
                                          <th scope="row"><?=
                                                            $index + 1 ?></th>
                                          <td><?= $volunteer['name'] ?></td>
                                          <td><?= $volunteer['event_title'] ?></td>
                                          <td><?= $volunteer['apply_date'] ?></td>
                                          <td><?= $volunteer['v_status']?'Accepted':'' ?></td>
                                          <td><?= $volunteer['remarks'] ?></td>
                                    </tr>

                              <?php
                              endforeach ?>
                        </tbody>

                  </table>
            </div>
      </div>
</div>

<?php
include('footer.php');

?>