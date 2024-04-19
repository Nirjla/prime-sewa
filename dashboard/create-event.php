<?php include('header.php'); ?>
<section>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <h5>Your Event Details</h5>
                    <div>
                        <a href="event.php" class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>
                <form class="row g-3 mt-3" action="insert-event.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <label for="event-title" class="form-label">
                            Event title
                              <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="event-title" id="event-title" required onchange="validateAdminForm('event-title')" />
                        <span id="event-titleError" class="error"></span>
                    </div>
                    <div class="col-md-4 ">
                        <label for="venue" class="form-label">
                            Event Venue
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="venue" id="venue" required />
                    </div>
                    <div class="col-md-4 ">
                        <label for="event-date" class="form-label">
                            Event Date
                            <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" name="event-date" id="event-date" required />
                    </div>

                    <div class="col-md-4 ">
                        <label for="register-deadline" class="form-label">
                            Register Deadline
                            <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" name="register-deadline" id="register-deadline" required />
                    </div>
                    <div class="col-md-4 ">
                        <label for="club-name" class="form-label">
                            Club Name
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="club-name" required>
                            <option selected>Select</option>
                            <option value="Prime IT Club">Prime IT Club</option>
                            <option value="Prime Esports Club">Prime Esports Club</option>
                            <option value="Prime Sports Club">Prime Sports Club</option>
                            <option value="Prime Entepreneur Club">Prime Entepreneur Club</option>
                            <option value="Prime Social Innovation Club">Prime Social Innovation Club</option>
                            <option value="Prime Flair Club">Prime Flair Club</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="priority" class="form-label">
                            Priority
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="priority" required>
                            <option selected>Select </option>
                            <option value="High">High</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <label for="seat-limit" class="form-label">
                            Seat Limit
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="seat-limit" id="seat-limit" min="1" required />
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            Status
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="status" required>
                            <option selected>Select </option>
                            <option value="1">Active</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>

                    <div class="col-md-4 ">
                        <label for="event-img" class="form-label">
                            Event Image
                            <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control" name="event-img" id="event-img" accept=".jpg, .jpeg ,.png" onchange="restrictFileUpload('event-img')" required />
                        <span class="text-danger" id='event-imgError'></span>

                    </div>
                    <div class="col-md-12 ">
                        <label for="event-desc" class="form-label">
                            Event Description
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="event-desc" id="event-desc" cols="30" rows="4" required></textarea>
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