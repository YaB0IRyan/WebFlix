<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- index_login.php -->

<!-- copy of the index page, to be used when a user is logged in so their session is still active -->

<?php # DISPLAY COMPLETE REGISTRATION PAGE.

$isPaid = 0;
?>

<?php
require('includes/connect_db.php');
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['userID'])) {
  require('login_tools.php');
  load();
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <!--mystylesheet-->
  <title>WebFlix</title>
</head>

<body>
  <!-- start primary navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index_login.php"><img class="logo" src="img/Logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="user_login.php"><?php echo "{$_SESSION['forename']}"; ?> <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="movies.php">Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shows.php">Shows</a>
        </li>
        <?php
                if ($_SESSION['isAdmin'] == 1) {
                    echo '<li class="nav-item">
                  <a class="nav-link" href="admin_view_users.php">View Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_view_movie.php">Add/Remove Movie</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_view_show.php">Add/Remove Show</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_view_genre.php">Add/Remove Genre</a>
                </li>';
                }
                ?>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="logout.php">Sign Out</a>
          </li>
        </ul>
      </form>
    </div>
  </nav>
  <!-- end primary navigation -->


  <div class="container">
    <h1 class="text-center display-4">Welcome to</h1>
    <img src="img/Logo.png" class="rounded mx-auto d-block" alt="logo" width="500">
    <br>
    <p class="text-center lead">Watch your faverioute shows and movies from your phone, pc, tablet or any other connected device</p>
    <br>
    <p class="text-center lead">Paid users will have access to our full collection, and our free users will be able to prieview this collection</p>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>