<?php
session_start();
// if(isset($_SESSION['AdminLogin']) || isset($_SESSION['UserAdmin'])){
//       session_unset();
//       // echo($_SESSION['UserLogin']);
    
//       header('Location:index.php');
//       exit();
// }
if(isset($_SESSION['AdminLogin'])){
      // unset($_SESSION['AdminLogin']);
      session_destroy();
      // $_SESSION['logged_out'] = "Logged Out Successfully";
      header('Location:index.php?status=loggedout');
      exit();

}
if(isset($_SESSION['UserLogin'])){
      session_destroy();
      // unset($_SESSION['UserLogin']);
      // $_SESSION['logged_out'] = "Logged Out Successfully";
      header('Location:index.php?status=loggedout');
      exit();

}

?>