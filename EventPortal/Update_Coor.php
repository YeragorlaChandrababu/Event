<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Update Co-Ordinator</title>
    <link rel="shortcut icon" type="image" href="images/bcu_1.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <div class="container mt-3 w-50 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded">
                <h2 class="text-center text-primary">Update Co-Ordinator</h2>
                <hr>

                <div class="mb-3 row">
                    <label for="id" class="form-label">Coordinator Id</label>
                    <div class="col-sm-9">
                        <input id="id" name="id" type="number" placeholder="Co-ordinator Id" class="form-control" required>
                    </div>
                    <div class="col-sm-3">
                        <button id="retrieveData" name="retrieveData" class="btn btn-primary">Retrieve</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Coordinator Name</label>
                    <input id="name" name="name" type="text" placeholder="Co-ordinator Name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input id="email" name="email" type="email" placeholder="Email Address" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone No</label>
                    <input id="phone" name="phone" type="phone" placeholder="Phone No" class="form-control">
                </div>

                <div class="form-group" style="text-align:center">
                    <label class="control-label" for="register"></label>
                    <div class="col-md-12">
                        <button id="register" name="register" class="w-50 btn btn-primary">Update</button>
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
if (isset($_POST['retrieveData'])) {
    if (isset($_POST['id'])) {
        $coordinatorId = mysqli_real_escape_string($con, $_POST['id']);
        $sql1 = "SELECT coor_name, email, phoneno FROM event_coordinator WHERE coor_id='$coordinatorId'";
        $result1 = mysqli_query($con, $sql1);

        if (!$result1) {
            echo "Database query error: " . mysqli_error($con);
        } else {
            if (mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $data = array(
                    'name' => $row['coor_name'],
                    'email' => $row['email'],
                    'phone' => $row['phoneno'],
                );

                echo "<script>";
                echo "document.getElementById('id').value = '" . $coordinatorId . "';";
                echo "document.getElementById('name').value = '" . $data['name'] . "';";
                echo "document.getElementById('email').value = '" . $data['email'] . "';";
                echo "document.getElementById('phone').value = '" . $data['phone'] . "';";
                echo "</script>";
            } else {
                echo "<script>alert('Coordinator Not Present with Id: " . $coordinatorId . "');</script>";
            }
        }
    }
}
?>

<?php
if (isset($_POST['register'])) {
    include 'Db_Con.php';
    $coordinatorId = $_POST['id']; // Coordinator ID to identify the record to be updated

    // Check if a coordinator with the provided ID exists
    $checkSql = "SELECT * FROM event_coordinator WHERE coor_id='$coordinatorId'";
    $checkResult = mysqli_query($con, $checkSql);
    
    if (mysqli_num_rows($checkResult) > 0) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Use the UPDATE statement to modify the existing data based on Coordinator ID
        $sql = "UPDATE event_coordinator SET coor_name='$name', email='$email', phoneno='$phone' WHERE coor_id='$coordinatorId'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo ("<script>alert(\"Event Co-ordinator Updated Successfully...\")</script>");
        } else {
            echo ("<script>alert(\"Update Failed...!\n\n Try Again\")</script>");
        }
    } else {
        echo ("<script>alert(\"Coordinator with ID " . $coordinatorId . " does not exist\")</script>");
    }
}

?>