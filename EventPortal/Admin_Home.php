<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Admin</title>
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
<?php
include('Nav_Home.php');
?>
<?php
session_start();
include 'Db_Con.php';
if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "admin")) {
    echo "<script>window.location.replace('Login.php')</script>";
} else {
    $email = $_SESSION['uid'];
    $sql1 = "select admin_Name from admin where email='$email'";
    $query = mysqli_query($con, $sql1);
    $r = mysqli_fetch_array($query);
    $name = $r['admin_Name'];
    ?>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Welcome
            <?php echo $name; ?>
        </h2>
        <div class="container mt-3 p-5 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
            <h3 class='text-secondary'>Admin Dashboard</h3>
            <hr>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Co-Ordinators</h5>
                            <p class="card-text border p-2 rounded">You can View, Add, Update, Delete the Event Co-Ordinators.
                            </p>
                            <a class="dropdown-toggle btn btn-primary" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">Manage Co-Ordinators</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="View.php?view=event_coordinator">View Co-Ordinators</a></li>
                                    <li><a class="dropdown-item" href="Add_Coor.php">Add New Co-Ordinator</a></li>
                                    <li><a class="dropdown-item" href="Update_Coor.php">Update Co-Ordinator</a></li>
                                    <li><a class="dropdown-item" href="Delete_Coor.php">Delete Co-Ordinator</a></li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Events</h5>
                            <p class="card-text border p-2 rounded">You can View, Add, Update, Delete the Events.</p>
                            <a class="dropdown-toggle btn btn-primary" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">Manage Events</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="View.php?view=events">View Events</a></li>
                                    <li><a class="dropdown-item" href="Add_Event.php">Add New Event</a></li>
                                    <li><a class="dropdown-item" href="Update_Event.php">Update Event</a></li>
                                    <li><a class="dropdown-item" href="Delete_Event.php">Delete Event</a></li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Participants</h5>
                            <p class="card-text border p-2 rounded">You can View, Update, Delete the Participent Detils.
                            </p>
                            <a class="dropdown-toggle btn btn-primary" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">Manage Participents</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="View.php?view=student">View Participents</a></li>
                                    <li><a class="dropdown-item" href="Update_Stu.php">Update Participent</a></li>
                                    <li><a class="dropdown-item" href="Delete_Stu.php">Delete Participent</a></li>
                                </ul>
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

</body>

</html>