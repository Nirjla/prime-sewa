<?php
session_start();
include('header.php');
if (!isset($_SESSION['AdminLogin'])) {
      header('Location:login.php');
}
include('footer.php');
include('scripts.php');
// http://localhost/prime-sewa/dashboard/