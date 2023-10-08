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
                    <input id="stu_id" name="stu_id" type="text" placeholder="Collage Registration No"
                        class="form-control" required="">
                    <div id="emailHelp" class="form-text">Your collage Registration No</div>
                </div>
                <div class="mb-3">
                    <label for="stu_name" class="form-label">Name</label>
                    <input id="stu_name" name="stu_name" type="text" placeholder="Type your Full Name"
                        class="form-control" required="">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" name="email" type="text" placeholder="Type your Email Id" class="form-control"
                        required="">
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="password" class="form-label">Type New Password</label>
                        <input id="password" name="password" type="password" placeholder="Create new password"
                            class="form-control" required="" minlength=8>
                        <div id="emailHelp" class="form-text">*Remember password for future login</div>
                    </div>
                    <div class="form-group" style="text-align:center">
                        <label class="control-label" for="passreset"></label>
                        <div class="col-md-12">
                            <button id="passreset" name="passreset" class="btn btn-primary">Reset Password</button>
                            <a class="btn btn-primary" href="Login.php">Login</a>
                            <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['passreset'])) {
        include 'Db_Con.php';
        $stu_id = $_POST['stu_id'];
        $email = $_POST['email'];
        $name = $_POST['stu_name'];
        $password = $_POST['password'];
        $sql = "select * from student where reg_no='$stu_id' and email='$email'and name='$name'and password='$password'";
        $result = mysqli_query($con, $sql);
        $no_of_rows = mysqli_num_rows($result);
        $sql1 = "select * from student where reg_no='$stu_id' and email='$email'and name='$name'";
        $result1 = mysqli_query($con, $sql1);
        $no_of_rows1 = mysqli_num_rows($result1);
        if ($no_of_rows > 0) {
            echo ("<script>alert(\"Your password same as what you have set before...\")</script>");
        } else if ($no_of_rows1 > 0) {
            $sql = "UPDATE student SET password='$password' WHERE reg_no='$stu_id' and email='$email'and name='$name'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo ("<script>alert(\"Password Changed Successfully..!\")</script>");
            } else {
                echo ("<script>alert(\"Update Failed..!\n\n Try Again\")</script>");
            }
        }else{
            echo ("<script>alert(\"Your Registration No (or) Name (or) Email not matching, Try again with valid details.\")</script>");
        }
    }
    ?>
    <?php
    include('Footer.php')
        ?>
</body>

</html>