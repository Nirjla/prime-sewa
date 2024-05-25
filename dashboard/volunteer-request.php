<?php
session_start();

include('header.php');
include "../frontend/db.php";
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}



$query2 = "SELECT s.* FROM settings s JOIN (SELECT user_id , MAX(id) as max_id from settings GROUP BY user_id ) max_settings ON s.user_id = max_settings.user_id AND s.id = max_settings.max_id JOIN users u on s.user_id = u.id ";
$result2 = $conn->query($query2);

if ($result2->num_rows > 0) {
      $settings = $result2->fetch_all(MYSQLI_ASSOC);
      foreach ($settings as $setting) {
            $count = $setting['volunteer_count'];
            $month = $setting['time_limit'];
            // Use $count and $month here as needed
      }
}

$current_date = date('Y-m-d'); // today's date
$before_month = date('Y-m-d', strtotime("-$month months", strtotime($current_date)));
// $query = "SELECT u.* ,MAX(v.id) as v_id, COUNT(*) as total_volunteering FROM users u join volunteers v on v.user_id = u.id
// join events e on e.id = v.event_id where e.created_at > '$before_month' and v.status=1 and v.request=0  GROUP BY v.user_id";
$query1 = "SELECT v.user_id,COUNT(DISTINCT v.event_id) AS total_volunteering
FROM volunteers v
JOIN events e ON v.event_id = e.id
WHERE v.status = 1 AND v.request = 0 AND e.created_at > '$before_month'
GROUP BY v.user_id";
$query2 = "SELECT v.user_id , v.id
FROM volunteers v
JOIN events e ON v.event_id = e.id
WHERE v.status = 0 AND v.request = 1 AND e.created_at > '$before_month' ORDER BY v.created_at ASC
 ";
$result2 = $conn->query($query2);
if ($result2->num_rows > 0) {
      $requests = $result2->fetch_all(MYSQLI_ASSOC);
}
$result1 = $conn->query($query1);
// print_r($result);
if ($result1->num_rows > 0) {
      $count_volunteers = $result1->fetch_all(MYSQLI_ASSOC);
} else {
      $count_volunteers = [];
}

?>
<div class="container mt-5 ">

      <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="card-title">
                        <h5>Total Volunteered Counts </h5>
                  </div>
            </div>
            <div class="card-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                              <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> User ID</th>
                                    <th scope="col">Count </th>


                              </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($count_volunteers)) : ?>
    <tr>
        <td colspan="4">No requests available</td>
    </tr>
<?php else : ?>
                              <?php foreach ($count_volunteers as $index => $count_volunteer) : ?>

                                    <tr>
                                          <td><?= $index + 1; ?></td>
                                          <td><?= $count_volunteer['user_id'] ?></td>
                                          <td>
                                                <?= $count_volunteer['total_volunteering'] >= $count ? '<span class="text-danger">Volunteering Limit Exceeds</span>' : $count_volunteer['total_volunteering'] . ' / ' . $count ?>
                                          </td>

                                    </tr>

                              <?php endforeach; ?>
                              <?php endif; ?>
                        </tbody>

                  </table>
            </div>
      </div>
      <div class="card ">
            <div class="card-header ">
                  <div class="card-title d-flex justify-content-between align-items-center">
                        <h5>Request Lists </h5>
                        <div class="back">
                              <a href='volunteers.php' class="btn btn-primary">Back</a>
                        </div>
                  </div>
            </div>
            <div class="card-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                              <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"> User ID</th>
                                    <th scope="col"> Request</th>
                                    <th scope="col">Action</th>


                              </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($requests)) : ?>
    <tr>
        <td colspan="4">No requests available</td>
    </tr>
<?php else : ?>
                              <?php foreach ($requests as $index => $request) : ?>
                                    <tr>
                                          <td><?= $index + 1; ?></td>
                                          <td><?= $request['user_id'] ?></td>
                                          <td><?= $request['id'] ? 'Requested' : '' ?></td>
                                          <td>
                                                <?php
                                                $user_id = $request['user_id'];
                                                $query = "SELECT COUNT(user_id) as user_count FROM volunteers where user_id = ? and request = 0 and status = 1";
                                                $stmt = $conn->prepare($query);
                                                $stmt->bind_param('i', $user_id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if ($result->num_rows > 0) {
                                                      $row = $result->fetch_assoc();
                                                      $user_count = $row['user_count'];
                                                }
                                                if ($user_count >= $count) {
                                                      echo '<button class="rejectButton btn btn-primary" id="rejectButton" data-id="' . $request['id'] . '">Reject</button>';
                                                      echo '<div id="message_' . $request['id'] . '" style="display: none;"></div>';
                                                } else {
                                                      echo '<button class="acceptButton btn btn-primary" id="acceptButton" data-id="' . $request['id'] . '">Accept</button>';
                                                      echo '<div id="message_' . $request['id'] . '" style="display: none;"></div>';
                                                }



                                                ?>
                                          </td>
                                    </tr>
                              <?php endforeach; ?>
                              <?php endif; ?>
                        </tbody>

                  </table>
            </div>
      </div>

</div>

<?php
include('footer.php');


