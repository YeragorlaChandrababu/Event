<!DOCTYPE html>
<html lang="en">

<head>
  <title>BCU Event Portal - Add Co-Ordinator</title>
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
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
  <script>
    function check_usn(str) {
      alert("usn=>" + str);
      x = new XMLHttpRequest();
      x.open("POST", "check_usn.php?d=" + str, true);
      x.send();
      x.onreadystatechange = function () {
        if (x.readyState == 4 && x.status == 200) {
          document.getElementById("usn_info").innerHTML = x.responseText;
        }
      };
    }
  </script>
</head>

<body>
  <?php
  include('Nav_Home.php');
  ?>
  <?php
  session_start();
  include 'Db_Con.php';
  if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "dc")) {
    echo "<script>window.location.replace('Login.php')</script>";
  } else {
    ?>
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
      enctype="multipart/form-data">
      <div class="container mt-3 w-50 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
        <h2 class="text-center text-primary">Add Event Co-Ordinator</h2>
        <hr>

        <div class="mb-3">
          <label for="name" class="form-label">Coordinator Name</label>
          <input id="name" name="name" type="text" placeholder="Co-ordinator Name" class="form-control" required="">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input id="email" name="email" type="email" placeholder="Email Address" class="form-control" required="">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone No</label>
          <input id="phone" name="phone" type="phone" placeholder="Phone No" class="form-control" required="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input id="password" name="password" type="password" placeholder="Password" class="form-control" required="">
          <div id="emailHelp" class="form-text">Use at least 5 characters.</div>
        </div>

        <div class="form-group" style="text-align:center">
          <label class="control-label" for="register"></label>
          <div class="col-md-12">
            <button id="register" name="register" class="btn btn-primary">Add Event Co-ordinator</button>
            <a class="btn btn-primary" href="Admin_Home.php">Back</a>
            <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
          </div>
        </div>
      </div>
    </form>
    <?php include('Footer.php') ?>
  </body>

  </html>

  <?php

  }
  ?>

<?php

if (isset($_POST['register'])) {
  include 'Db_Con.php';
  $email = $_POST['email'];
  $sql = "select * from event_coordinator where email='$email'";
  $result = mysqli_query($con, $sql);
  $no_of_rows = mysqli_num_rows($result);
  if ($no_of_rows > 0) {
    echo ("<script>alert(\"You are an existing Co-Ordinator, Login with your credentials.\")</script>");
  } else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $status = 0;
    $sql = "insert into event_coordinator(coor_name,email,password,phoneno,status) values('$name','$email','$password','$phone','$status')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo ("<script>alert(\"Event Co-ordinator Added Successfully...\")</script>");
    } else {
      echo ("<script>alert(\"Registration Failed...\n\n Try Again\")</script>");
    }

  }
}

?>