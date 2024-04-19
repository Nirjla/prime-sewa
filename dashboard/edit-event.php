<?php
include('header.php');
session_start();
include "../frontend/db.php";

if ($conn) {
      // echo "Connection";
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $event_id = $_GET['id'];
      // $_SESSION['event_id'] = $event_id;
      // echo "Eevnt:".$_SESSION['event_id'] ;
      $query = "SELECT * FROM events WHERE id=$event_id";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            print_r($event);
            // $_SESSION['status'] = "Data inserted successfully";
      }
}


?>
<section>
      <div class="container mt-5">
            <div class="card">
                  <div class="card-body">
                        <div class="card-header  d-flex justify-content-between align-items-center">
                              <h5>Your Event Details</h5>
                              <div>
                                    <a href="http://localhost/prime-sewa/dashboard/event.php" class="btn btn-primary">
                                          Back
                                    </a>
                              </div>
                        </div>

                        <form class="row g-3 mt-3" action="/prime-sewa/dashboard/update-event.php" method="post" enctype="multipart/form-data">

                              <div class="col-md-8">
                                    <input type="hidden" value=<?=$event_id?> name='event_id'>
                                    <label for="event-title" class="form-label">
                                          Event title
                                    </label>
                                    <input type="text" class="form-control" name="event-title" id="event-title" required onchange="validateAdminForm('event-title')" value="<?= $event['event_title'] ?>" />
                                    <span id="event-titleError" class="error"></span>
                              </div>
                              <div class="col-md-4 ">
                                    <label for="event-date" class="form-label">
                                          Event Date
                                    </label>
                                    <input type="date" class="form-control" value="<?= $event['event_date'] ?>" name="event-date" id="event-date" required />
                              </div>

                              <div class="col-md-4 ">
                                    <label for="register-deadline" class="form-label">
                                          Register Deadline
                                          <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" name="register-deadline" value="<?= $event['event_deadline'] ?>" id="register-deadline" required />
                              </div>
                              <div class="col-md-4 ">
                                    <label for="club-name" class="form-label">
                                          Club Name
                                          <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="club-name" required>

                                          <option value="Prime IT Club" <?= $event['club_name'] == 'Prime IT Club' ? 'selected' : '' ?>>Prime IT Club</option>
                                          <option value="Prime Esports Club" <?= $event['club_name'] == 'Prime Esports Club' ? 'selected' : '' ?>>Prime Esports Club</option>
                                          <option value="Prime Sports Club" <?= $event['club_name'] == "Prime Sports Club" ? 'selected' : '' ?>>Prime Sports Club</option>
                                          <option value="Prime Entepreneur Club" <?= $event['club_name'] == "Prime Entepreneur Club" ? " selected" : '' ?>>Prime Entepreneur Club</option>
                                          <option value="Prime Social Innovation Club" <?= $event['club_name'] == "Prime Social Innovation Club" ? "selected" : "" ?>>Prime Social Innovation Club</option>
                                          <option value="Prime Flair Club" <?= $event['club_name'] == 'Prime Flair Club' ? 'selected' : '' ?>>Prime Flair Club</option>
                                    </select>
                              </div>
                              <div class="col-md-4">
                                    <label for="priority" class="form-label">
                                          Priority
                                          <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="priority" required>
                                          <option value="1" <?=$event['event_priority'] == 1?'selected':''?>>High</option>
                                          <option value="0"  <?=$event['event_priority']==0?'selected':''?>>Low</option>
                                    </select>
                              </div>
                              <div class="col-md-4 ">
                                    <label for="seat-limit" class="form-label">
                                          Seat Limit
                                          <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" name="seat-limit" id="seat-limit" min="1" 
                                    value="<?=$event['seat_limit']?>"
                                    required />
                              </div>
                              <div class="col-md-4">
                                    <label for="status" class="form-label">
                                          Status
                                          <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="status" required>
                                          <option value="1"
                                          <?= $event['status'] == 1?'selected':''?>
                                          >Active</option>
                                          <option value="0"  <?= $event['status'] == 0?'selected':''?>>Disable</option>
                                    </select>
                              </div>

                              <div class="col-md-4 ">
                                    <label for="event-img" class="form-label">
                                          Event Image
                                          <span class="text-danger">*</span>
                                    </label>
                                    <input type="hidden" name='prev-event-img' value="<?=$event['event_img']?>"/>
                                    <input type="file" class="form-control" name="event-img" id="event-img" accept=".jpg, .jpeg ,.png" onchange="restrictFileUpload('event-img')"  />
                                    <span class="text-danger" id='event-imgError'></span>

                              </div>
                              <div class="col-md-12 ">
                                    <label for="event-desc" class="form-label">
                                          Event Description
                                          <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" name="event-desc" id="event-desc" cols="30" rows="4" required>
                                          <?=trim($event['event_desc'])?>
                                    </textarea>
                              </div>
                              <div class="">
                                    <button class="btn btn-primary">Submit</button>
                              </div>
                        </form>
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
<?php include('footer.php') ?>