<!DOCTYPE html>
<html lang="en">
<link />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<head>
      <title>
            <?=
            isset($page_title) ? $page_title : "Prime Sewa";
            ?>
      </title>
      <!-- bootstrap link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
      <!-- boxicons -->
      <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
      <!-- google icon -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <!-- Link Swiper's CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
      <!-- custom links -->
      <link rel="stylesheet" href="./styles/style.css" />
</head>

<body>

      <header class="">
            <div class="container">



                  <div class="ps__header">
                        <div class="ps__logo">
                              <a href="index.php">
                                    <img src="/prime-sewa/assets/primesewa-high-resolution-logo-transparent.png" class="img-fluid" alt="" />
                              </a>
                        </div>
                        <div class="ps__navbar">
                              <nav>
                                    <ul class="font-small">
                                          <li><a href="index.php">Home</a></li>

                                          <?php
                                          session_start();
                                          // echo $_SESSION['loggedIn'];
                                          if (isset($_SESSION['UserLogin']) || isset($_SESSION['AdminLogin'])) {
                                          ?>
                                                <li class="position-relative"><button class="btn profile_btn" id='toggleBtn'>
                                                            <i class='bx bx-user'></i>
                                                      </button>
                                                      <ul class="role_lists position-absolute  font-small" id="roleList">
                                                            <div class="text-justify  ">
                                                                  <?php
                                                                  if (!isset($_SESSION['UserLogin'])) {

                                                                  ?>

                                                                        <li><a href='http://localhost/prime-sewa/dashboard/'>Dashboard</a></li>



                                                                  <?php   } ?>
                                                                  <li><a href="logout.php">Log Out</a></li>
                                                            </div>
                                                      </ul>
                                                <?php } else { ?>
                                                <li><a href="javascript:void(0)" onclick="openLoginPopup()">Login</a></li>

                                                <li><a href="./register.php">Register</a></li>
                                          <?php } ?>
                                    </ul>
                              </nav>
                        </div>
                  </div>
            </div>
      </header>
      <?php
      include('./login.php')
      ?>