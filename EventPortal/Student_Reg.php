<?php
include('Db_Con.php');
?>
<html>

<head>
  <title>BCU Event Protal - Student Registration</title>
  <link rel="shortcut icon" type="image" href="images/bcu_1.jpg">
  <link rel="shortcut icon" type="image" href="images/mahadasara logo.jpg">
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

<body>
  <?php
  include('Nav.php');
  session_start();
  include 'Db_Con.php';
  ?>
  <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
    enctype="multipart/form-data">
    <div class="container mt-3 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded"
      style="width:60%">
      <h2 class="text-center text-primary">Student Registration</h2>
      <hr>
      <div class="container w-75">
        <div class="mb-3">
          <label for="stu_id" class="form-label">Registration No</label>
          <input id="stu_id" name="stu_id" type="text" placeholder="Collage Registration No" class="form-control"
            required="">
          <div id="emailHelp" class="form-text">Your collage Registration No</div>
        </div>
        <div class="mb-3">
          <label for="stu_name" class="form-label">Name</label>
          <input id="stu_name" name="stu_name" type="text" placeholder="Type your Full Name" class="form-control"
            required="">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input id="email" name="email" type="text" placeholder="Type your Email Id" class="form-control" required="">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone No</label>
          <input id="phone" name="phone" type="text" placeholder="Type your Phone No" class="form-control" required=""
            minlength=10 maxlength="
        10">
        </div>
        <div class="mb-3">
          <label for="collage" class="form-label">Collage Name</label>
          <input id="collage" name="collage" type="text" placeholder="Type your Collage Name" class="form-control"
            required="">
        </div>
        <div class="mb-3">
          <label for="course">Select Course:</label>
          <select class="form-control" id="course" name="course">
            <optgroup label="Postgraduate (PG)">
              <option value="PG Computer Science">PG Computer Science</option>
              <option value="PG Mathematics">PG Mathematics</option>
              <option value="PG Physics">PG Physics</option>
            </optgroup>
            <optgroup label="Undergraduate (UG)">
              <option value="BSc PMCS">BSc PMCS</option>
              <option value="BSc PCM">BSc PCM</option>
              <option value="BSc CBZ">BSc CBZ</option>
              <option value="Others">Others</option>
            </optgroup>
          </select>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input id="password" name="password" type="password" placeholder="Create your password" class="form-control"
            required="" minlength=8>
          <div id="emailHelp" class="form-text">*Remember password for future login</div>
        </div>

        <div class="mb-3">
          <label for="fileToUpload" class="form-label">Upload your Photo</label>
          <input id="fileToUpload" name="fileToUpload" class="form-control" type="file" id="formFile">
          <div id="emailHelp" class="form-text">*Max size should be below 100kb</div>
        </div>

        <div class="form-group" style="text-align:center">
          <label class="control-label" for="register"></label>
          <div class="col-md-12">
            <button id="register" name="register" class="w-50 btn btn-primary">Register</button>
            <a class="btn btn-primary" href="Login.php">Login</a>
            <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
          </div>
        </div>
      </div>
  </form>
<?php

if (isset($_POST['register'])) {
  include 'Db_Con.php';
  $stu_id = $_POST['stu_id'];
  $email = $_POST['email'];
  $sql = "select * from student where reg_no='$stu_id'|| email='$email'";
  $result = mysqli_query($con, $sql);
  $no_of_rows = mysqli_num_rows($result);
  if ($no_of_rows > 0) {
    echo ("<script>alert(\"You have already Registered...\")</script>");
  } else {
    $name = $_POST['stu_name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $collage = $_POST['collage'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $target_dir = "student_photos/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $newfilename = $target_dir;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $date = new DateTime();
    $newfilename .= $date->getTimestamp();
    $random = rand(10, 1000);
    $newfilename = $newfilename . "" . $random . "." . $imageFileType;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) {
        $sql = "insert into student(reg_no,name,email,password,cource,photo,college,phone) values('$stu_id','$name','$email','$password','$course','$newfilename','$collage','$phone')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '<script>alert("Register Successfull Remember Password and Username \\n Your Username: "+"' . $email . '"+"\\n Your Password: "+"' . $password . '")</script>';
          echo "<script>window.location.replace('login.php')</script>";
        } else {
          echo ("<script>alert(\"Registration Failed...\n\n Try Again\")</script>");
        }
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
}
?>
</div>
<?php
include('Footer.php')
?>
</body>
</html>