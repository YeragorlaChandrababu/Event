<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Delete Participant</title>
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
            <div class="container w-75 mt-3 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
                <h2 class="text-center text-primary">Delete Participant</h2>
                <hr>
                <div class="container w-75">
                    <div class="mb-3 row">
                        <label for="id" class="form-label">Participant Id</label>
                        <div class="col-sm-9">
                            <input id="id" name="id" type="number" placeholder="Event Id" class="form-control" required>
                        </div>
                        <div class="col-sm-3">
                            <button id="retrieveData" name="retrieveData" class="btn btn-primary">Retrieve</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="stu_id" class="form-label">Registration No</label>
                        <input id="stu_id" name="stu_id" type="text" placeholder="Collage Registration No"
                            class="form-control" course>
                        <div id="emailHelp" class="form-text">Your collage Registration No</div>
                    </div>
                    <div class="mb-3">
                        <label for="stu_name" class="form-label">Name</label>
                        <input id="stu_name" name="stu_name" type="text" placeholder="Type your Full Name"
                            class="form-control" course>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" name="email" type="text" placeholder="Type your Email Id" class="form-control"
                            course>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone No</label>
                        <input id="phone" name="phone" type="text" placeholder="Type your Phone No" class="form-control"
                            course minlength=10 maxlength="
        10">
                    </div>
                    <div class="mb-3">
                        <label for="collage" class="form-label">Collage Name</label>
                        <input id="collage" name="collage" type="text" placeholder="Type your Collage Name"
                            class="form-control" course>
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

                    <div class="form-group" style="text-align:center">
                        <div class="col-md-12">
                            <button id="delete" name="delete" class="w-50 btn btn-primary">Delete</button>
                            <?php
                            if (isset($_SERVER['HTTP_REFERER'])) {
                                $referrer = $_SERVER['HTTP_REFERER'];
                                echo '<a href="' . $referrer . '" class="btn btn-primary">Back</a>';
                            } else {
                                echo '<a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>';
                            }
                            ?>
                            <button id="clear" name="clear" class="btn btn-danger" type="reset">Clear</button>
                        </div>
                    </div>
        </form>
        </div>
        </div>
        <?php include('Footer.php') ?>
    </body>

    </html>
    <?php
    if (isset($_POST['retrieveData'])) {
        if (isset($_POST['id'])) {
            $s_id = mysqli_real_escape_string($con, $_POST['id']);
            $sql1 = "SELECT reg_no, name, email, phone, college, cource  FROM student WHERE sid='$s_id'";
            $result1 = mysqli_query($con, $sql1);
            if (!$result1) {
                echo "Database query error: " . mysqli_error($con);
            } else {
                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $data = array(
                        'reg_no' => $row['reg_no'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'phone' => $row['phone'],
                        'collage' => $row['college'],
                        'course' => $row['cource'],
                    );
                    echo "<script>";
                    echo "document.getElementById('id').value = '" . $s_id . "';";
                    echo "document.getElementById('stu_id').value = '" . $data['reg_no'] . "';";
                    echo "document.getElementById('stu_name').value = '" . $data['name'] . "';";
                    echo "document.getElementById('email').value = '" . $data['email'] . "';";
                    echo "document.getElementById('phone').value = '" . $data['phone'] . "';";
                    echo "document.getElementById('collage').value = '" . $data['collage'] . "';";
                    echo "document.getElementById('course').value = '" . $data['course'] . "';";
                    echo "</script>";
                } else {
                    echo "<script>alert('Participant Not Present with Id: " . $s_id . "');</script>";
                }
            }
        }
    }

    if (isset($_POST['delete'])) {
        include 'Db_Con.php';
        $s_id = $_POST['id'];
        $checkSql = "SELECT * FROM student WHERE sid='$s_id'";
        $checkResult = mysqli_query($con, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            $sql = "DELETE FROM student WHERE sid='$s_id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo ("<script>alert(\"Participant Deleted Successfully...\")</script>");
            } else {
                echo ("<script>alert(\"Participant Delete Failed...\n\n Try Again\")</script>");
            }
        } else {
            echo ("<script>alert(\"Participant with ID " . $eventid . " does not exist\")</script>");
        }
    }
    }
    ?>