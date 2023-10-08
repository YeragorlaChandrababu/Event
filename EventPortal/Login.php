<?php

session_start();
include 'Db_Con.php';
?>


<!DOCTYPE html>
<html>

<head>
  <title>BCU Event Protal - Login</title>
  <link rel="shortcut icon" type="image" href="images/bcu_1.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <style>
    body {
      background: linear-gradient(to bottom, rgba(144, 238, 144, 1), rgba(144, 238, 144, 0));
    }
  </style>
</head>
<?php
include('Nav.php');
?>
<div class="container mt-3 p-5 w-50 border border-primary rounded-3 shadow p-3 mb-5 bg-body-tertiary rounded">
  <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
    enctype="multipart/form-data">
    <h1 class="text-center text-primary" style="font-family:Times">Login</h1>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input id="email" name="email" type="email" placeholder="Type your email address..." class="form-control"
        required="" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="password" name="password" class="form-label" placeholder="Type password..." required="">
        Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <div>
      <button id="Login" name="Login" class="btn w-50 btn-primary text-center">Login</button>
      <a class="btn btn-primary" href="Student_Reg.php">Register</a>
    </div>
    
    <?php
    if (isset($_POST['Login'])) {
      include 'Db_Con.php';
      $flag = 0;
      $email = $_POST['email'];
      $password = $_POST['password'];
      if ($flag == 0) {
        $sql = "select admin_id,email from admin where email='$email' and password='$password'";

        $query = mysqli_query($con, $sql);

        if (mysqli_num_rows($query) == 1) {
          $r = mysqli_fetch_array($query);
          $adminid = $r['admin_id'];
          $email = $r['email'];

          $_SESSION['uid'] = $email;
          $_SESSION['utype'] = "admin";
          $_SESSION['loggedin'] = true;
          $flag = 1;
          header('location:Admin_Home.php');
        } else {
          $sql = "select coor_id,email from event_coordinator where email='$email' and password='$password'";
          $query = mysqli_query($con, $sql);
          if (mysqli_num_rows($query) == 1) {

            $r = mysqli_fetch_array($query);
            $event_cid = $r['event_cid'];
            $email = $r['email'];

            $_SESSION['uid'] = $email;
            $_SESSION['utype'] = "ec";
            $flag = 1;
            header('location:CoOrdinator_Home.php');
          } else {
            $sql = "select * from student where email='$email' and password='$password'";
            $query = mysqli_query($con, $sql);
            if (mysqli_num_rows($query) == 1) {
              $row = mysqli_fetch_array($query);
              $Reg_no = $row['Reg_no'];
              $email = $row['email'];
              $_SESSION['Reg_no'] = $Reg_no;
              $_SESSION['uid'] = $email;
              $_SESSION['utype'] = "student";
              $flag = 1;
              echo "<script>window.location.replace('Student_Home.php')</script>";
            } else {
              echo '<script>alert("Invalid Username or Password...!\\nTry again with valid credentials");</script>';
              echo "<h6 class=' p-2 mt-2 border rounded-3 border-danger text-center text-danger'>Invalid Username or Password...! Try again with valid credentials</h6>";
            }
          }
        }

      }
    }
    ?>
    <br>
    <a class="btn btn-warning" href="Pass_Reset.php">Forgot Passowrd</a>
  </form>
</div>
<?php
include('Footer.php');
?>

</html>