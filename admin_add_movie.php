<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- admin_add_movie.php -->

<!-- this page handles the code to allow an admin to add a new movie -->

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
    $movieId = require("includes/guid.php");

    $mediaID = require("includes/guid.php");
    $episodeNumber = 1;

    $mediaGenreID = require("includes/guid.php");

    $mediaTypeID = require("includes/guid.php");
    $mediaTypeName = "Movie";

    $seasonID = require("includes/guid.php");
    $seasonNumber = 1;


    # Check for an email address:
    if (empty($_POST['movieTitle'])) {
        $errors[] = 'no title entered';
    } else {
        $movieTitle = mysqli_real_escape_string($link, trim($_POST['movieTitle']));
    }

    # Check for an email address:
    if (empty($_POST['movieReleseDate'])) {
        $errors[] = 'no date entered';
    } else {
        $movieReleseDate = mysqli_real_escape_string($link, trim($_POST['movieReleseDate']));
    }

    # Check for an email address:
    if (empty($_POST['movieLanguage'])) {
        $errors[] = 'no language entered';
    } else {
        $movieLanguage = mysqli_real_escape_string($link, trim($_POST['movieLanguage']));
    }

    # Check for an email address:
    if (empty($_POST['movieGenreID'])) {
        $errors[] = 'no genre entered';
    } else {
        $movieGenreID = mysqli_real_escape_string($link, trim($_POST['movieGenreID']));
    }

    # Check for an email address:
    if (empty($_POST['movieImageLink'])) {
        $errors[] = 'no image link entered';
    } else {
        $movieImageLink = mysqli_real_escape_string($link, trim($_POST['movieImageLink']));
    }

    # Check for an email address:
    if (empty($_POST['movieTrailerLink'])) {
        $errors[] = 'no trailer link entered';
    } else {
        $movieTrailerLink = mysqli_real_escape_string($link, trim($_POST['movieTrailerLink']));
    }

    # Check for an email address:
    if (empty($_POST['movieMediaLink'])) {
        $errors[] = 'no media link entered';
    } else {
        $movieMediaLink = mysqli_real_escape_string($link, trim($_POST['movieMediaLink']));
    }

    if (empty($_POST['movieDescription'])) {
        $errors[] = 'no trailer link entered';
    } else {
        $movieDescription = mysqli_real_escape_string($link, trim($_POST['movieDescription']));
    }


    # Check if email address already registered.
    if (empty($errors)) {
        $q = "SELECT * FROM genre WHERE genreID='$movieGenreID'";
        $r = @mysqli_query($link, $q);
        if (mysqli_num_rows($r) == 0) $errors[] = 'genre does not exist</a>';
    }

    # On success register user inserting into 'users' database table.
    if (empty($errors)) {

        $q = "INSERT INTO mediaInfo (mediaInfoID, title, image, description, releaseDate, language, trailerLink) VALUES ('$movieId', '$movieTitle', '$movieImageLink', '$movieDescription', '$movieReleseDate', '$movieLanguage', '$movieTrailerLink' )";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<p>1/5</p>';
        }

        $q = "INSERT INTO mediaType (typeID, mediaInfoID, name) VALUES ('$mediaTypeID', '$movieId', '$mediaTypeName' )";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<p>2/5</p>';
        }

        $q = "INSERT INTO mediaGenre (mediaGenreID, mediaInfoID, genreID) VALUES ('$mediaGenreID', '$movieId', '$movieGenreID' )";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<p>3/5</p>';
        }

        $q = "INSERT INTO seasons (seasonID, mediaInfoID, number) VALUES ('$seasonID', '$movieId', '$seasonNumber' )";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<p>4/5</p>';
        }

        $q = "INSERT INTO media (mediaID, seasonID, episodeNumber, link) VALUES ('$mediaID', '$seasonID', '$episodeNumber', '$movieMediaLink' )";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<p>5/5</p><br><P>Success! movie has been added, please click <a href="admin_view_movie.php">here</a></P>';
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
    <h1 class="text-center display-4">Add Movie</h1>
    <div class="col-sm d-flex justify-content-center">
        <div class="card text-center">

            <div class="card-body">
                <!-- Display body section with sticky form. -->
                <form action="admin_add_movie.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="test" class="form-control" id="movieTitle" name="movieTitle" placeholder="Movie Title" size="20" required value="<?php if (isset($_POST['movieTitle'])) echo $_POST['movieTitle']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="movieReleseDate" name="movieReleseDate" placeholder="Relese Date" size="20" required value="<?php if (isset($_POST['movieReleseDate'])) echo $_POST['movieReleseDate']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="movieLanguage" name="movieLanguage" placeholder="Language" size="20" required value="<?php if (isset($_POST['movieLanguage'])) echo $_POST['movieLanguage']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="movieGenreID" name="movieGenreID" placeholder="Genre ID" size="20" required value="<?php if (isset($_POST['movieGenreID'])) echo $_POST['movieGenreID']; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="movieImageLink" name="movieImageLink" placeholder="Image Link" size="50" required value="<?php if (isset($_POST['movieImageLink'])) echo $_POST['movieImageLink']; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="movieTrailerLink" name="movieTrailerLink" placeholder="Trailer Link" size="50" required value="<?php if (isset($_POST['movieTrailerLink'])) echo $_POST['movieTrailerLink']; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="movieMediaLink" name="movieMediaLink" placeholder="Movie Link" size="50" required value="<?php if (isset($_POST['movieMediaLink'])) echo $_POST['movieMediaLink']; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea type="text" class="form-control" id="movieDescription" name="movieDescription" placeholder="Movie Description" size="500" rows="10" required value="<?php if (isset($_POST['movieDescription'])) echo $_POST['movieDescription']; ?>"></textarea>
                            <p class="text-center lead">Please make sure the genre already exists BEFORE adding the movie<p>
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
        </div>
    </div><!-- end of container-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>