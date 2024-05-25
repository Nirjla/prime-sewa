<?php include('./header.php');
include('db.php');
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $event_id = $_GET['id'];
      // echo $event_id;
      $query = "SELECT * FROM events WHERE id = $event_id";

      $result = $conn->query($query);


    
      if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            // print_r($event);
            //print_r($volunteer);
            // print_r($event);
            // print_r($users);
            // echo $event['event_title'];
      }
}
session_start();
if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      // $query2 = "SELECT * FROM users WHERE id=$user_id";
      // $query3 = "SELECT * FROM volunteers where id = $user_id";
      $query = "SELECT u.*, v.* FROM users u LEFT JOIN volunteers v ON u.id = v.user_id WHERE u.id=$user_id";
      $result = $conn->query($query);
      // $result3  = $conn->query($query3);
      if ($result->num_rows) {
            $volunteer_user = $result->fetch_assoc();
      } else {
            exit();
      }
}


?>

<div class="ps__std-event_detail">
      <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                  <div class="col-lg-7">
                        <div class="ps__std-event_left">
                              <div class="event_left-image w-100">
                                    <img src=<?= $event['event_img'] ?> alt='' class="img-fluid w-100" />
                              </div>
                              <div class="event_left-content mt-3">
                                    <?= $event['event_desc'] ?>
                              </div>
                              <table class="table mt-3">
                                    <thead>
                                          <tr>
                                                <th>Event Date</th>
                                                <th>Register Deadline</th>
                                                <th>Organizer</th>
                                                <th>Venue</th>
                                          </tr>
                                          <tr>
                                                <td><?= date("F jS, Y", strtotime($event['event_date'])) ?></td>
                                                <td><?= date("F jS, Y", strtotime($event['event_deadline'])) ?></td>
                                                <td><?= $event['club_name'] ?></td>
                                                <td><?= $event['venue'] ?></td>
                                          </tr>
                                    </thead>
                              </table>
                              <div>
                                    <form action="insert-volunteer-request.php" method="post">
                                          <h5>Personal Details</h5>

                                          <div class="row">

                                                <div class="col-lg-6 mb-3">
                                                      <input type="text" class="form-control" placeholder="Enter Your Name" name="name" value="<?= $volunteer_user['name'] ?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                      <input type="email" class="form-control" placeholder="Enter Your Email" name="email" value="<?= $volunteer_user['email'] ?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                      <input type="text" class="form-control" placeholder="Enter Your Phone" name="phone" value="<?= $volunteer_user['phone'] ?>">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                      <input type="text" class="form-control" name="address" placeholder="Enter Your Address">
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                      <textarea placeholder="Remarks here..." class="form-control" cols="30" rows="10" name="remarks"></textarea>
                                                </div>
                                          </div>

                                          <input type="hidden" value="<?= $user_id ?>" name="user_id">
                                          <input type="hidden" value="<?= $event_id ?>" name="event_id">
                                          <?=
                                          $volunteer_user['status'] === 1 ? '<p class="event_btn btn btn-primary">Accepted</p>' : '<button class="event_btn btn btn-primary">Volunteer</button>'
                                          ?>
                                          <?php
                                          session_start();
                                          if (isset($_SESSION['status'])) {
                                                echo '<p id="status">' . $_SESSION['status'] . '</p>';
                                          }
                                          unset($_SESSION['status']);
                                          ?>
                                    </form>
                                    <span id="success"></span>
                              </div>

                        </div>
                  </div>
                  <!-- <div class="col-lg-4">
                        <div class="event_sidebar">
                              <div class="event_search">
                                    <input class="form-control" type="search" placeholder="Search..." />
                              </div>
                              <div class="upcoming_events mt-3">
                                    <h5>Upcoming events</h5>
                                    <div class="upcoming_events-container">
                                          <div class="upcoming_event">
                                                <div class="upcoming_event-img">
                                                      <img src=<?= $event['event_img'] ?> alt='' class="img-fluid" />
                                                </div>
                                                <div class="upcoming_event-content">
                                                      <h6>Titile</h6>
                                                      <div class="event_date">
                                                            <?= date("F jS, Y", strtotime($event['event_date'])) ?>
                                                      </div>

                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div> -->
            </div>
      </div>
</div>
<?php include('./footer.php')
?>