<?php
session_start();
$user_id = $_SESSION['user_id'];
// echo $user_id;
include "../frontend/db.php";
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM `settings` ORDER BY `created_at` DESC LIMIT 1";
$result = $conn->query($query);
// print_r($result);
if($result){
   $row= $result->fetch_assoc();
//    print_r($row);
}
?>

<!DOCTYPE html>
<html lang="en">
<link />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<head>



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
      <header>
            <div class="header-top">
                  <div class="container">
                        <div class="header_inner d-flex justify-content-between align-items-center">
                              <div class="logo_img">
                                    <a href="http://localhost/prime-sewa/frontend/" class="d-block">
                                          <img src='../assets/primesewa-high-resolution-logo-transparent.png' class="img-fluid" />
                                    </a>
                              </div>
                              <div class="d-flex justify-content-between align-items-center">
                              <div class="position-relative"><button class="btn profile_btn" id="toggleBtn">
                                          <i class="bx bx-user"></i>
                                    </button>
                                    <ul class="role_lists position-absolute  font-small" id="roleList">
                                          <div class="text-justify  ">
                                                <li><a href="logout.php">Log Out</a></li>
                                          </div>
                                    </ul>
                              </div>
                              <?php
                              if (isset($_SESSION['AdminLogin'])) {

                              ?>
                                    <div class="settings text-white position-relative h-100">
                                          <button class="btn btn-primary" id='settingsButton' onclick="toggleButton('settingsButton','settingsContent')">Settings</button>
                                          <div class="settings-content position-absolute" id='settingsContent'>
                                          <form action="insert-setting.php" method='POST'>
                                                      <ul>
                                                            <li>Manage Volunteering Limits
                                                                  <ul>
                                                                        <li>
                                                                              Time Limits:
                                                                              <select class="form-select" name='months'>
                                                                                    <option selected>Months</option>
                                                                                    <option value='1'  <?=$row['time_limit']==  1?'selected':''?> >1</option>
                                                                                    <option value='2'  <?=$row['time_limit']==  2?'selected':''?>>2</option>
                                                                                    <option value='3' <?=$row['time_limit']==  3?'selected':''?>>3</option>
                                                                                    <option value='4'  <?=$row['time_limit']==  4?'selected':''?>>4</option>
                                                                                    <option value='5'  <?=$row['time_limit']==  5?'selected':''?>>5</option>
                                                                                    <option value='6'  <?=$row['time_limit']==  6?'selected':''?>>6</option>
                                                                                    <option value='7'  <?=$row['time_limit']==  7?'selected':''?>>7</option>
                                                                                    <option value='8'  <?=$row['time_limit']==  8?'selected':''?>>8</option>
                                                                                    <option value='9'  <?=$row['time_limit']==  9?'selected':''?>>9</option>
                                                                                    <option value='10'  <?=$row['time_limit']==  10?'selected':''?>>10</option>
                                                                                    <option value='11'  <?=$row['time_limit']==  11?'selected':''?>>11</option>
                                                                                    <option value='12' <?=$row['time_limit']==  12?'selected':''?>>12</option>


                                                                              </select>
                                                                        </li>
                                                                        <li>Volunteering Counts
                                                                              <input type="number" id='count' name='count' min='1' max='10' value="<?=$row['volunteer_count']?>"/>
                                                                        </li>
                                                                  </ul>
                                                            </li>

                                                      </ul>
                                                      <button class="btn btn-primary" onclick="getValues()">Save Changes</button>
                                                </form>
                                                </div>
                                    </div>
                                    </div>
                              <?php
                              }
                              ?>

                              <?php

                              ?>
                        </div>
                  </div>
            </div>

      </header>
      <?php include('navbar.php');
      ?>