<?php
session_start();
// echo $_SESSION['user_id'];
// echo $_SESSION['status'];
include "../frontend/db.php";
include('header.php');

if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

// $updateQuery = "UPDATE events e
// JOIN (
//     SELECT
//         e.id,
//         (e.seat_limit - COUNT(v.user_id)) AS seats_available
//     FROM
//         events e
//     JOIN
//         volunteers v ON e.id = v.event_id
//         WHERE v.status 1 AND v.request = 0
//     GROUP BY
//         e.id, e.seat_limit
// ) AS available_seats ON e.id = available_seats.id
// SET e.seat_limit = available_seats.seats_available,
//     e.status = CASE WHEN e.event_date < CURDATE() THEN 0 ELSE e.status END";
// $conn->query($updateQuery);

// Select the updated rows
$selectQuery = "SELECT * FROM events";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
      $events = $result->fetch_all(MYSQLI_ASSOC);
      // Process the $events array as needed
} else {
      $events = [];
}



?>
<section>
      <div class="container mt-5">
            <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">
                              <h5>Event Lists </h5>

                        </div>
                        <div>
                              <a href="create-event.php" class="btn btn-primary">
                                    <i class='bx bx-plus'></i> Add Event</a>
                        </div>
                  </div>
                  <div class="card-body">

                        <table class="table table-bordered table-hover">
                              <thead>
                                    <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Event Image</th>

                                          <th scope="col">Event Title</th>
                                          <th scope="col">Event Date </th>
                                          <th scope="col">Event Deadline </th>
                                          <th scope="col">By Club Name</th>
                                          <th scope="col">Venue</th>
                                          <th scope="col"> Priority </th>
                                          <th scope="col">Seat Limit </th>
                                          <th scope="col">Status </th>
                                          <th scope="col">Action </th>


                                    </tr>
                              </thead>
                              <tbody>
                                    <?php foreach ($events as $index => $event) : ?>

                                          <tr>
                                                <th scope="row"><?php echo $index + 1; ?></th>
                                                <td><img src="<?php echo $event['event_img']; ?>" alt='' class="img-fluid" /></td>
                                                <td><?php echo $event['event_title']; ?></td>
                                                <td><?php echo  date('M d', strtotime($event['event_date'])); ?></td>
                                                <td> <?php echo $event['event_deadline']; ?></td>
                                                <td> <?php echo $event['club_name']; ?></td>
                                                <td> <?php echo $event['venue']; ?></td>
                                                <td> <?php echo $event['event_priority']; ?></td>
                                                <td> <?php echo $event['seat_limit']; ?></td>
                                                <td> <?php echo $event['status']; ?></td>
                                                <td>
                                                      <div class="d-flex gap-2">
                                                      <a href="edit-event.php/?id=<?= $event['id'] ?>" class='btn btn-primary'>Edit</a>
                                                      <a href="delete.php/?id=<?= $event['id'] ?>" class='btn btn-primary'>Delete</a>
                                                      </div>
                                                </td>

                                          </tr>
                                    <?php endforeach ?>
                              </tbody>
                        </table>
                  </div>
            </div>
      </div>
      <?=
      isset($_SESSION['status']) ? '
<p id="status">' . $_SESSION['status'] .
            '</p>
' : '';
      unset($_SESSION['status']);
      ?>
</section>
<?php include('footer.php')
?>