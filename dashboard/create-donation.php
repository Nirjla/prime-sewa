<?php
session_start();
include('header.php');
if (isset($_SESSION['user_id'])) {
      // echo $user_id;
}
?>
<div class="container mt-5">
      <div class="card">
            <div class="card-body">
                  <div class="card-header  d-flex justify-content-between align-items-center">
                        <h5>Your Donation Details</h5>
                        <div>
                              <a href="donation.php" class="btn btn-primary">
                                    Back
                              </a>
                        </div>
                  </div>
                  <form class="row g-3 mt-3" action="insert-donation.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                              <label for="donation-title" class="form-label">
                                    Donation title
                                    <span class="text-danger">*</span>
                              </label>
                              <input type="text" class="form-control" name="donation-title" id="donation-title" />
                        </div>
                        <div class="col-md-6 ">
                              <label for="donation-name" class="form-label">
                                     Organization Name
                                    <span class="text-danger">*</span>

                              </label>
                              <input type="text" class="form-control" name="donation-name" id="donation-name" />
                        </div>

                        <div class="col-md-4 ">
                              <label for="donation-location" class="form-label">
                              Organization Location
                                    <span class="text-danger">*</span>

                              </label>
                              <input type="text" class="form-control" name="donation-location" id="donation-location" />
                        </div>
                        
                        
                        <div class="col-md-4">
                              <label for="status" class="form-label">
                                    Status
                                    <span class="text-danger">*</span>
                                    
                              </label><select class="form-select" name="status">
                                    <option selected>Select </option>
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                              </select>
                        </div>
                        
                        <div class="col-md-4 ">
                              <label for="donation-img" class="form-label">
                                    Donation Image
                                    <span class="text-danger">*</span>

                              </label>
                              <input type="file" class="form-control" name="donation-img" id="donation-img" />
                        </div>
                        <div class="col-md-12 ">
                              <label for="donation-desc" class="form-label">
                                    Donation Description
                                    <span class="text-danger">*</span>

                              </label>
                              <textarea class="form-control" name="donation-desc" id="donation-desc" cols="30" rows="4"></textarea>
                        </div>
                      <div class="">
                        <button class="btn btn-primary">Submit</button>
                      </div>
                  </form>
            </div>

      </div>
</div>

<?php include('footer.php') ?>