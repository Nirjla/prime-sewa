<?php
session_start();


//       echo '<div class="alert" role="alert">' . $_SESSION['status'] . '</div>';
//       unset($_SESSION['status']); // Optionally unset the session status after displaying it
// }

?>
<?php
$page_title = 'Registration Form';
include('./header.php') ?>
<div class="career-form">
      <div class="container">
            <div class="form-card d-flex justify-content-center align-items-center">
                  <div class="form-body">
                        <div class="row ">



                              <div class="col-lg-12">
                                    <div class="form-title mb-4">
                                          <svg viewBox="0 0 640 512">
                                                <path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM616 200h-48v-48C568 138.8 557.3 128 544 128s-24 10.75-24 24v48h-48C458.8 200 448 210.8 448 224s10.75 24 24 24h48v48C520 309.3 530.8 320 544 320s24-10.75 24-24v-48h48C629.3 248 640 237.3 640 224S629.3 200 616 200z"></path>
                                          </svg>
                                          Sign Up as <span>Volunteers</span>
                                    </div>
                                    <form class="" action="insert.php" method="post">

                                          <div class="mb-4">
                                                <input required="" type="text" class="form-control" placeholder="Name" name="name" id="name" onchange="validateForm('name')" />
                                                <span id="nameError" class="error"></span>
                                          </div>
                                          <div class="mb-4">
                                                <input required="" type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone" onchange="validateForm('phone')" />
                                                <span id="phoneError" class="error"></span>
                                          </div>
                                          <div class="mb-4">
                                                <input required="" type="email" class="form-control" placeholder="Email Address" name="email" id="email" onchange="validateForm('email')" />
                                                <!-- " -->
                                                <span id="emailError" class="error"></span>

                                          </div>
                                          <div class="mb-4">
                                                <input required="" type="password" class="form-control" placeholder="Password" name="password" id="password" onchange="validateForm('password')" />
                                                <span id="passwordError" class="error"></span>
                                          </div>
                                          <div class="">
                                                <input required="" type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" onchange="validateForm('confirmPassword')" />
                                                <span id="confirmPasswordError" class="error"></span>

                                          </div>


                                          <div class="common-btn mt-4">
                                                <button type="submit" class="btn">
                                                      Register Now
                                                </button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
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
<script>
      function validateForm(value) {
            // // Reset error messages
            // document.getElementById('nameError').innerHTML = '';
            // document.getElementById('phoneError').innerHTML = '';
            // document.getElementById('emailError').innerHTML = '';
            // document.getElementById('passwordError').innerHTML = '';
            // document.getElementById('confirmPasswordError').innerHTML = '';
            if (value) {
                  var name = document.getElementById(value).value;
                  document.getElementById(value + 'Error').innerHTML = ''
            }
            var password = document.getElementById('password').value;

            if (value === "name") {
                  if (!name.trim()) {
                        document.getElementById('nameError').innerHTML = 'Name is required';
                        return false;
                  }
            }
            if (value === "phone") {
                  console.log(isNaN(name))
                  if (!name.trim() || isNaN(name)) {
                        document.getElementById('phoneError').innerHTML = 'Phone must be a number';
                        return false;
                  }
                  if (name.length < 10 || name.length > 10) {
                        document.getElementById('phoneError').innerHTML = 'Phone must be 10 digits';
                        return false;
                  }
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var validDomain = /@prime\.edu\.np$/;
            if (value === "email") {
                  if (!emailRegex.test(name) || !validDomain.test(name)) {
                        document.getElementById('emailError').innerHTML = 'Invalid email address or not from prime.edu.np domain';
                        return false;
                  }
                  checkEmailExists(name, value)
            }
            checkEmailExists
            if (value === 'password') {
                  if (name.length < 8) {
                        document.getElementById('passwordError').innerHTML = 'Password must be at least 8 characters';
                        return false;
                  }
            }
            if (value == 'confirmPassword') {
                  if (name !== password) {
                        document.getElementById('passwordError').innerHTML = "Passwords didn't match";
                        return false;
                  }
            }

            // Form is valid
            return true;

      }
      // check email using ajax
      function checkEmailExists(email, value) {
            $.ajax({
                  type: 'POST',
                  url: 'check_email.php',
                  data: {
                        email: email
                  },
                  success: function(response) {
                        console.log(response)
                        if (response === '1') {
                              // console.log(true);
                              document.getElementById(value + 'Error').innerHTML = 'Email already exists';
                        } else {
                              document.getElementById('emailError').innerHTML = ''
                        }
                  }
            })
      }
</script>


<?php
include('./footer.php') ?>