<html>

<head>
  <title>BCU Event Protal - Home</title>
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
?>
  <div id="carouselExampleAutoplaying" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner mt-5">
      <div class="carousel-item active">
        <img src="images/build.jpg" class="d-block w-100 img-thumbnail" style="height:70%" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/inag.jpeg" class="d-block w-100 img-thumbnail" style="height:70%" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/buildview.jpeg" class="d-block w-100 img-thumbnail" style="height:70%" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="container mt-5">
    <h2 class='text-primary text-center'><span class='text-warning'>Bengalure City University</span> Sports Club</h2>
    <p class='text-center'>Registrations are open for below events, Participate and Win big! </p>
    <div class="row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">100 Meters</h5>
            <p class="card-text border p-2">The 100-meter run is a sprinting race where athletes run as fast as they can
              over a distance of 100 meters. It is one of the shortest and quickest events in track and field, requiring
              explosive speed and power.</p>
            <a href="Student_Reg.php" class="btn btn-primary">Register</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Chess</h5>
            <p class="card-text border p-2">Chess is a two-player strategy board game played on an 8x8 grid known as a
              chessboard. Each player controls an army of different pieces, including a king, queen, rooks, knights,
              bishops, and pawns. The objective is to checkmate your opponent's king, meaning the king is in a position
              to be captured (in check) with no legal moves to escape.</p>
            <a href="Student_Reg.php" class="btn btn-primary">Register</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cricket</h5>
            <p class="card-text border p-2">Cricket is a team sport played with a bat and a ball. Two teams take turns
              to bat and bowl, with the batting team trying to score runs by hitting the ball and the fielding team
              attempting to dismiss the batsmen. The game is played on an oval-shaped field with wickets at each end. It
              is a popular sport in many countries, especially in India, England, and Australia.</p>
            <a href="Student_Reg.php" class="btn btn-primary">Register</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">FootBall</h5>
            <p class="card-text border p-2"> Football, often referred to as soccer in some countries, is a team sport
              played with a round ball on a rectangular field. Two teams compete to score goals by getting the ball into
              the opposing team's goal post. Players use their feet, head, or any part of their body except their hands
              and arms (goalkeepers are an exception) to move the ball. It is the world's most popular sport and is
              played by millions of people worldwide.</p>
            <a href="Student_Reg.php" class="btn btn-primary">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php
include('Footer.php');
?>
</body>

</html>