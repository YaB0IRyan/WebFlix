<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- admin_add_genre.php -->

<!-- this page handles the code to allow an admin to add a new genre -->

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

    <!--mystylesheet-->
    <link rel="stylesheet" href="css/custom.css">


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



    <?php # DISPLAY COMPLETE REGISTRATION PAGE.

    # Check form submitted.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # Connect to the database.
        require('includes/connect_db.php');

        # Initialize an error array.
        $errors = array();

        #calls guid function
        $id = require("includes/guid.php");

        # Check for an email address:
        if (empty($_POST['name'])) {
            $errors[] = 'no name entered';
        } else {
            $name = mysqli_real_escape_string($link, trim($_POST['name']));
        }

        # Check if email address already registered.
        if (empty($errors)) {
            $q = "SELECT name FROM genre WHERE name='$name'";
            $r = @mysqli_query($link, $q);
            if (mysqli_num_rows($r) != 0) $errors[] = 'Genre already exists</a>';
        }

        # On success register user inserting into 'users' database table.
        if (empty($errors)) {
            $q = "INSERT INTO genre (genreID, name) VALUES ('$id', '$name' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<h1>Added!</h1><p>Genre added, please click <a href="admin_view_genre.php">here</a></p>';
            }

            # Close database connection.
            mysqli_close($link);

            exit();
        }
        # Or report errors.
        else {
            echo 'post didnt work';
            echo '<div class="container">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <h1>Error!</h1>
          <p id="err_msg">The following error(s) occurred:<br>';
            foreach ($errors as $msg) {
                echo " - $msg<br>";
            }
            echo '<hr>
          <p class="mb-0">Please try again.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
         </div>
        </div>';
            # Close database connection.
            mysqli_close($link);
        }
    }
    ?>



    <div class="container">
        <h1 class="text-center display-4">Add Genre</h1>
        <div class="col-sm d-flex justify-content-center">
            <div class="card text-center">

                <div class="card-body">
                    <!-- Display body section with sticky form. -->
                    <form action="admin_add_genre.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="name" class="form-control" id="name" name="name" placeholder="Genre name" size="50" required value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                            </div>
                        </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-dark btn-block">Add</button>
                    </div>
                    </form>

                </div>
            </div>
        </div><!-- end of container-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>