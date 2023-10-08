<!DOCTYPE html>
<html lang="en">

<head>
    <title>BCU Event Portal - Enroll</title>
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
    if (!isset($_SESSION['uid']) && ($_SESSION['utype'] == "student")) {
        echo "<script>window.location.replace('Login.php')</script>";
    } else {
        ?>
        <div>
            <?php
            $sql1 = "SELECT sid, reg_no,name, college FROM student WHERE email='" . $_SESSION['uid'] . "'";
            $result1 = mysqli_query($con, $sql1);
            if (!$result1) {
                echo "Database query error: " . mysqli_error($con);
            } else {
                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $reg_no = $row['reg_no'];
                    $sql3 = "SELECT id, Reg_no, eventid, status FROM participant WHERE Reg_no='" . $reg_no . "'";
                    $result3 = mysqli_query($con, $sql3);
                    if (!$result3) {
                        echo "Database query error: " . mysqli_error($con);
                    } else {
                        echo '<div class="container mt-3 p-4 border border-primary rounded-3 shadow mb-5 bg-body-tertiary rounded"><h5 class="text-center test-success">Results</h5><hr>';
                        echo '<table class="table table-bordered ">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Registration ID</th>';
                        echo '<th>Regtration No</th>';
                        echo '<th>Event ID</th>';
                        echo '<th>Status</th>';
                        echo '<th>Result</th>';
                        echo '<th>Certificate</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            if ($row3['status'] == 0) {
                                $status = "<span class='text-danger'>Applied</span>";
                            } else {
                                $status = "<span class='text-success'>Approved</span>";
                            }
                            echo '<tr>';
                            echo '<td>' . $row3['id'] . '</td>';
                            echo '<td>' . $row3['Reg_no'] . '</td>';
                            $sql6 = "select ename,winner_regno, runner_regno from events where eventid=" . $row3['eventid'];
                            $query6 = mysqli_query($con, $sql6);
                            if (mysqli_num_rows($query6) > 0) {
                                $row6 = mysqli_fetch_assoc($query6);
                                echo '<td>' . $row3['eventid'] . ' - ' . $row6['ename'] . '</td>';
                            } else {
                                echo '<td>' . $row3['eventid'] . '</td>';
                            }
                            echo '<td>' . $status . '</td>';
                            if($row6['winner_regno']==$row3['Reg_no']){
                                echo '<td><span class="text-success">Winner</span></td>';
                            }else if($row6['runner_regno']==$row3['Reg_no']){
                                echo '<td><span class="text-warning">Runner</span></td>';
                            }else{
                                echo '<td></td>';
                            }
                            if($row6['winner_regno']==$row3['Reg_no']){
                                echo '<td><a href="dynamicPHPCertificate/Index.php?name='.$row['name'].'&ename='.$row6['ename'].'&collage='.$row['college'].'&res=1st" class="btn btn-primary">Winner Certificate</a></td>';
                            }else if($row6['runner_regno']==$row3['Reg_no']){
                                echo '<td><a href="dynamicPHPCertificate/Index.php?name='.$row['name'].'&ename='.$row6['ename'].'&collage='.$row['college'].'&res=2nd" class="btn btn-warning">Runner Certificate</a></td>';
                            }else{
                                echo '<td></td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '<a class="btn btn-primary" href="Student_Home.php">Back</a>';
                    }
                }
                else{
                    echo "<h3>No Enrollmets found!</h3>";
                }
            }
        }
            ?>
        </div>
        </div>
        <?php include('Footer.php') ?>
    </body>

    </html>

</body>

</html>