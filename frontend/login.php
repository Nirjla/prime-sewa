<?php
session_start();
$page_title = 'Login Form';
 ?>
<div class="popup" id="loginPopup">
      <div class="login-form d-flex justify-content-center align-items-center">
      <div class="container">
            <div class="form-card d-flex justify-content-center align-items-center">
                  <div class="form-body">
                        <div class="row ">
                           

                              <div class="col-lg-12">
                                    <div class="form-title mb-4 d-flex justify-content-between">
                                          <span class="q-icon on-left" aria-hidden="true" role="presentation"><svg viewBox="0 0 512 512">
                                                      <path d="M416 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c17.67 0 32 14.33 32 32v256c0 17.67-14.33 32-32 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c53.02 0 96-42.98 96-96V128C512 74.98 469 32 416 32zM342.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L242.8 224H32C14.31 224 0 238.3 0 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C355.1 266.1 355.1 245.9 342.6 233.4z"></path>
                                                </svg></span>
                                          <div>Login Form</div>
                                          <div class="closeBtn" onclick="closeLoginPopup()"><span class="material-symbols-outlined">
                                                close
                                          </span>
                                    </div>
                                    </div>
                                    
                                    <form class="" action="user-verify.php" method="post">
                                    <?php
                              // if (isset($_SESSION['status']) && !empty($_SESSION['status'])) {
                              //       echo '<div class="alert" role="alert">' . $_SESSION['status'] . '</div>';
                              //       unset($_SESSION['status']);
                              // }
                              // ?>
                                        <div class="mb-4">
                                                <input required="" type="email" class="form-control" placeholder="Email Address" name="verify-email" 
                                                id='verify-email'
                                                onchange="checkEmail()"/>
                                                <span id="emailExists" class="error"></span>

                                           
                                          </div>
                                          <div class="mb-4">
                                                <input required="" type="password" class="form-control" placeholder="Password" name="password"/>
                                          </div>



                                          <div class="common-btn mt-4">
                                                <button type="submit" class="btn">
                                                      Login Now
                                                </button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      </div>
</div>