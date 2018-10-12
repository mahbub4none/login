<?php
session_start();
include('dbcon.php');
if (isset($_POST['username'])) {
  $select = "SELECT users.*, departments.dept_name FROM users JOIN departments ON users.dept_id = departments.id WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";
  $result =  mysqli_query($dbcon, $select);
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $user;
    if($user['role'] == "Admin"){
      header('location:admin.php');
    } elseif($user['role'] == "Implimentation Executive"){
      header('location:implimentation-pending.php');
    } elseif($user['role'] == "user"){
      header('location:index.php');
    } else {
      header('location:pending.php');
    }
  } else {
    $msg = "Wrong Username / Password";
    exit;
  }
} elseif (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    echo "You have logged out!";
}
?>
<style media="screen">
  .form-container {
    height: 400px;width: 600px;border: 3px solid #21246D;border-radius: 220px;background-color: #21246D; margin: 150px auto;
  }
  .logo {
    width: 48%;
    /* position: absolute; */
    float: left;
    background-color: #fff;
    /* margin-top: 128px; */
    height: inherit;
    border-radius: 220px 0 0 220px;
  }
  .logo img {
    margin-top: 50%;
    margin-left: 10%;
  }
  .form {
    width:50%;
    float: left;
  }
  .form form {
    text-align: center;
    margin-top: 40%;
    /* margin-right: 10%; */
  }
  .form-input {
    width: 75%;
    height: 40px;
    border-radius: 10px;
    margin: 5px;
    border: 1px solid #21246D;
    text-align: center;
  }
</style>
<div class="form-container" style="">
  <div class="logo" style="">
    <img src="images/logo.png" alt="" style="">
  </div>
  <div class="form" style="">
    <form class="" action="" method="post" style="">
      <input class="form-input" type="text" name="username" value="" placeholder="User ID">
      <input class="form-input" type="password" name="password" value="" placeholder="Password">
      <input class="form-input" type="submit" name="" value="LOGIN">
    </form>
  </div>
</div>
