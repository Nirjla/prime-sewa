<?php
session_start();
include('./header.php');
include('db.php');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION['count'])) {
  $count = $_SESSION['count'];
  echo $count;
  $updateQuery = "UPDATE events e
SET e.seat_limit = e.seat_limit - $count ,
    e.status = CASE
        WHEN e.event_date < CURDATE() THEN 0
        WHEN e.seat_limit <= 0 THEN 0
        ELSE e.status END";
  $result = $conn->query($updateQuery);
  if (!$result) {
    die("Error" . $conn->error);
  } else {
    unset($_SESSION['count']);
  }
}
if (!empty($_GET['status'])) {
  $_SESSION['status'] = "Logout Successfully";
  unset($_SESSION['status']);
  // session_destroy();
}
if(!empty($_GET['payment'])){
  $_SESSION['payment'] = "Payment Success";
  unset( $_SESSION['payment'] );
 
}




$query = "SELECT *
FROM events
WHERE status=1 AND event_priority IN (1, 0)
ORDER BY
  CASE
    WHEN event_priority = 1 THEN 1
    WHEN event_priority = 0 THEN 2
  END,
  created_at DESC";
$query2 = "SELECT d.id, d.donation_title, d.donation_desc, d.donation_img, d.organization_name, d.organization_location,
du.donate_id, CEIL(SUM(du.amount/100)) AS total_amount
FROM donations d
LEFT JOIN donations_users du ON d.id = du.donate_id
GROUP BY d.id,d.user_id, d.donation_title, d.donation_desc, d.donation_img, d.organization_name, d.organization_location, du.donate_id
";
$result = $conn->query($query);
$result2 = $conn->query($query2);

if ($result->num_rows > 0 || $result2->num_rows > 0) {
  $events = $result->fetch_all(MYSQLI_ASSOC);
  $donations = $result2->fetch_all(MYSQLI_ASSOC);
  // print_r($events);
  // print_r($donations);
} else {
  $events = [];
  $donations = [];
}
?>

<!-- login form -->


<!-- home bg -->
<div class="ps__home">
  <div class="ps__bg">
    <div class="ps__who-are-we">
      <div class="ps__who-are-we--content">
        <h1>Who are we?</h1>
        <p class="font-small">
          PrimeSewa will serve as a central
          hub for students and clubs, focusing on six unique clubs within the college community:
          Prime IT Club, Prime EMC, Prime Flair Club, Prime Social Innovation Club, Prime
          Sports Club, and Prime Esports Club.
        </p>
      </div>
      <a href="/">Read more</a>
    </div>
  </div>
</div>
<!-- 3 qualities -->
<div class="ps__quality">
  <div class="quality__overlay">
    <div class="container">
      <div class="quality__content">
        <div class="row g-0">
          <div class="col-md-4">
            <div class="quality01">
              <div class="font-large">01.</div>
              <div class="font-medium">User-Friendly Platform</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="quality02">
              <div class="font-large">02.</div>
              <div class="font-medium">Efficient Volunteer Management</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="quality03">
              <div class="font-large">03.</div>
              <div class="font-medium">
                Empowering Student Connections</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- upcoming events -->
<div class="ps__blog mt-5">
  <div class="container">
    <div class="ps__custom--row">
      <div class="row">
        <div class="col-md-12">
          <div class="ps__block font-small">Upcoming Events</div>
        </div>
      </div>
      <div class="ps__custom--wrapper">
        <div class="swiper ps_custom--row">
          <div class="swiper-wrapper">
            <?php foreach ($events as $index => $event) :
            ?>

              <div class="swiper-slide">
                <div class="ps__std-club">
                  <div class="ps__std-img-box position-relative">
                    <div class="ps__std-club--img">
                      <img src=<?php echo $event['event_img']; ?> alt="" class="img-fluid" />
                    </div>
                    <?=
                    $event['event_priority'] == 1 ?

                      ' <div class="ps__std-urgent position-absolute">
                      
                     <span> URGENT </span>
                    </div>'
                      : '';
                    ?>
                  </div>
                  <div class="ps_meta--body d-flex align-items-center justify-content-between">
                    <div class="ps__meta font-small fw-medium">
                      <span class=""><?php $date =  date("M jS", strtotime($event['event_date']));
                                      $formatted_date = strtoupper(substr($date, 0, 3)) . '<div>' . substr($date, 3) . '</div>';
                                      echo $formatted_date;
                                      ?> </span>

                    </div>
                    <div class="ps__deadline font-xs">
                      <i class='bx bx-time-five'></i>
                      <!-- Jan 8th - Jan 9th -->
                      <?php
                      $current_date = date('M jS');
                      $event_deadline = date('M jS', strtotime($event['event_deadline']));
                      echo $current_date . '-' . $event_deadline;
                      ?>
                    </div>
                  </div>
                  <div class="ps__std-club__content">
                    <div class="ps__std-club__title font-small my-1">
                      <?= $event['event_title'] ?>
                    </div>
                    <div class="club_name font-xs fw-medium ">
                      <span>By</span>
                      <?= $event['club_name'] ?>
                    </div>

                    <div class="ps__std-club-bottom d-flex align-items-center justify-content-between">
                      <div class="font-xs fw-medium">Requirements
                        <div class="font-xxs text-left d-inline-block  mt-2"><?= $event['seat_limit'] ?></div>
                      </div>
                      <div class="ps__std-btn">
                        <a href="event-detail.php?id=<?= $event['id'] ?>" class="font-xs">Read More</a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            <?php endforeach ?>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- about-us -->
<div class="ps__about sectionPadding">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ps__block font-small">About Us</div>
      </div>
      <div class="col-md-6">
        <div class="ps_about--body">
          <div class="ps__about--heading font-xm mb-5">How We Work?</div>
          <div class="ps__about--feature-wrapper">
            <div class="ps__about--feature d-flex mb-3">
              <div class="ps__about-icon">
                <span class="material-symbols-outlined">
                  volunteer_activism
                </span>
              </div>
              <div class="ms-3">
                <div class="ps__about--title font-small mb-1">
                  Student Volunteer Empowerment
                </div>
                <div class="ps__about--content font-xs">
                  To create an easy-to-use platform for students to discover
                  and engage in volunteer opportunities.
                </div>
              </div>
            </div>
            <div class="ps__about--feature d-flex mb-3">
              <div class="ps__about-icon">
                <span class="material-symbols-outlined"> handshake </span>
              </div>
              <div class="ms-3">
                <div class="ps__about--title font-small mb-1">
                  Streamlined Volunteer Management
                </div>
                <div class="ps__about--content font-xs">
                  To implement standardized processes to reduce manual
                  workload for club organizers.
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="ps__about--img">
          <img src="../assets/quality.jpg" alt="" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</div>

<!-- upcoming events -->
<div class="ps__overlay--img">
  <div class="ps__overlay">
    <div class="container">
      <div class="ps__upcoming-events sectionPadding">
        <div class="row">
          <div class="col-md-12">
            <div class="ps__block font-small">Make A Donation</div>
          </div>
          <?php foreach ($donations as $index => $donation) :
          ?>
            <div class="col-md-4">
              <div class="ps__ue--container position-relative">
                <div class="ps__ue--img position-relative">
                  <img src="<?= $donation['donation_img'] ?>" alt="" class="img-fluid" />

                  <div class="ps__ue--content position-absolute">
                    <div class="font-small">
                      <a href="donation-detail.php?id=<?= $donation['id'] ?>">Donate</a>
                    </div>
                  </div>
                  <div class="ps__ue--body mt-2">
                    <div class="ps__ue--title font-small mb-2">
                      <?= $donation['donation_title'] ?>
                    </div>
                    <div class="donation_org 
                    d-flex justify-content-between align-items-center
                    fw-medium font-xs">
                      <div>
                        <span>By</span>
                        <?= $donation['organization_name'] ?>
                      </div>
                      <div class="d-flex justify-content-center   align-items-center">
                        <span class="material-symbols-outlined">
                          location_on
                        </span>
                        <?= $donation['organization_location'] ?>
                      </div>
                    </div>
                    <div class="donation-info d-flex ">
                      <div>Collected NRS </div>
                      <div class="donation-amount"><?= $donation['total_amount'] ? $donation['total_amount'] : '0' ?></div>
                    </div>
                  </div>
                  <!-- <div class="ps__ue--right-meta d-flex justify-content-between font-xs"> -->
                  <!-- <div class="ps__ue--right-time d-flex">
                            <span class="material-symbols-outlined me-1">
                              schedule
                            </span>
                            1:00 pm -1:00pm
                          </div>
                          <div class="ps__ue--right-location d-flex">
                            <span class="material-symbols-outlined me-1">
                              location_on
                            </span>
                            Sitapaila
                          </div>
                        </div> -->
                </div>
              </div>
            </div>
          <?php endforeach ?>
          <!-- <div class="col-md-6">
                  <div class="row d-block">
                    <div class="font-xm ps__ue--headline mb-5">
                      Upcoming events
                    </div>

                    <div class="col-md-12 mt-3">
                      <div class="ps__ue--content">
                        <div class="font-medium">
                          01
                          <div class="ps__ue--meta">JAN</div>
                        </div>
                        <div class="ps__ue--body my-4">
                          <div class="ps__ue--title font-small mb-2">
                            Charity Meetup - The Future of Charity
                          </div>
                          <div class="ps__ue--right-meta d-flex justify-content-between font-xs">
                            <div class="ps__ue--right-time d-flex">
                              <span class="material-symbols-outlined me-1">
                                schedule
                              </span>
                              1:00 pm -1:00pm
                            </div>
                            <div class="ps__ue--right-location d-flex">
                              <span class="material-symbols-outlined me-1">
                                location_on
                              </span>
                              Sitapaila
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 mt-3">
                      <div class="ps__ue--content">
                        <div class="font-medium">
                          01
                          <div class="ps__ue--meta">JAN</div>
                        </div>
                        <div class="ps__ue--body my-4">
                          <div class="ps__ue--title font-small mb-2">
                            Charity Meetup - The Future of Charity
                          </div>
                          <div class="ps__ue--right-meta d-flex justify-content-between font-xs">
                            <div class="ps__ue--right-time d-flex">
                              <span class="material-symbols-outlined me-1">
                                schedule
                              </span>
                              1:00 pm -1:00pm
                            </div>
                            <div class="ps__ue--right-location d-flex">
                              <span class="material-symbols-outlined me-1">
                                location_on
                              </span>
                              Sitapaila
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
  </div>
</div>
<?= isset($_SESSION['status']) ? '<p id="status">' . $_SESSION['status'] . '</p>' : ''; ?>
<?php unset($_SESSION['status']); ?>

<?= isset($_SESSION['payment_status']) ? '<p id="status">' . $_SESSION['payment_status'] . '</p>' : ''; ?>
<?php unset($_SESSION['payment_status']); ?>


<?php include('./footer.php')
?>