<?php
// include('header.php');
session_start();
include "../frontend/db.php";

if ($conn) {
      // echo "Connection";
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $donation_id = $_GET['id'];
      // $_SESSION['event_id'] = $event_id;
      // echo "Eevnt:".$_SESSION['event_id'] ;
      $query = "SELECT * FROM donations WHERE id=$donation_id";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
      $donation = $result->fetch_assoc();
            // print_r($event);
            // $_SESSION['status'] = "Data inserted successfully";
      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Dashboard - SB Admin</title>
      <!-- bootstrap link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
      <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
      <link href="css/style.css" rel="stylesheet" />
      <link href="css/styles.css" rel="stylesheet" />
      <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
      <!-- boxicons -->
      <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
      <!-- google icon -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
<section>
      <div class="container mt-5">
            <div class="card">
                  <div class="card-body">
                        <div class="card-header  d-flex justify-content-between align-items-center">
                              <h5>Your Donation Details</h5>
                              <div>
                                    <a href="http://localhost/prime-sewa/dashboard/donation.php" class="btn btn-primary">
                                          Back
                                    </a>
                              </div>
                        </div>

                        <form class="row g-3 mt-3" action="/prime-sewa/dashboard/update-donation.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                              <label for="donation-title" class="form-label">
                                    Donation title
                                    <span class="text-danger">*</span>
                              </label>
                              <input type="text" class="form-control" name="donation-title" id="donation-title" 
                              value="<?=$donation['donation_title']?>"
                              />
                        </div>
                        <div class="col-md-6 ">
                              <label for="donation-name" class="form-label">
                                     Organization Name
                                    <span class="text-danger">*</span>

                              </label>
                              <input type="text" class="form-control" name="donation-name" id="donation-name" 
                              value="<?=$donation['organization_name']?>"
                              />
                        </div>

                        <div class="col-md-4 ">
                              <label for="donation-location" class="form-label">
                              Organization Location
                                    <span class="text-danger">*</span>

                              </label>
                              <input type="text" class="form-control" name="donation-location" id="donation-location" 
                              value="<?=$donation['organization_location']?>"/>
                        </div>
                        
                        
                        <div class="col-md-4">
                              <label for="status" class="form-label">
                                    Status
                                    <span class="text-danger">*</span>
                                    
                              </label><select class="form-select" name="status">
                              <option value="1"
                                          <?= $donation['status'] == 1?'selected':''?>
                                          >Active</option>
                                          <option value="0"  <?= $donation['status'] == 0?'selected':''?>>Disable</option>
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
                              <textarea class="form-control" name="donation-desc" id="donation-desc" cols="30" rows="4">
                              <?=trim($donation['donation_desc'])?>
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
</body>
</html>