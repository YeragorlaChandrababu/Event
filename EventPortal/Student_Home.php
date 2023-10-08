<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Student</title>
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

        img {
            float: right;
        }
    </style>
</head>
<?php
include('Nav_Home.php');
?>
<?php
session_start();
include 'Db_Con.php';
if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "student")) {
    echo "<script>window.location.replace('Login.php')</script>";
} else {
    $email = $_SESSION['uid'];
    $sql1 = "select Reg_no,name,photo,college from student where email='$email'";
    $query = mysqli_query($con, $sql1);
    $r = mysqli_fetch_array($query);
    $name = $r['name'];
    $college = $r['college'];
    ?>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Welcome
            <?php echo $name; ?>
        </h2>
        <div class="container mt-3 p-5 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
            <h3 class='text-secondary'>Student Dashboard</h3><img src="<?php echo $r['photo'] ?>" width="140" height="150">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Enroll for Events</h5>
                            <p class="card-text border p-2 rounded">You can View and apply for event participation approval.
                            </p>
                            <a class="btn btn-primary" href="Enroll_Event.php">Enroll</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Event Results</h5>
                            <p class="card-text border p-2 rounded">You can check status of your event enrollments and Event
                                Results.
                            </p>
                            <a class="btn btn-primary" href="Result_View.php">View Results</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
include('Footer.php')
    ?>

</html>
</body>

</html>