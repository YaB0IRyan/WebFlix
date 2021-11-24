<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- admin_add_show.php -->

<!-- thsis page handles the code to allow an admin to add a new show -->

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
        $showId = require("includes/guid.php");

        $mediaID = require("includes/guid.php");
        $episodeNumber = 1;

        $mediaGenreID = require("includes/guid.php");

        $mediaTypeID = require("includes/guid.php");
        $mediaTypeName = "Show";

        $seasonID = require("includes/guid.php");
        $seasonNumber = 1;


        # Check for an email address:
        if (empty($_POST['showTitle'])) {
            $errors[] = 'no title entered';
        } else {
            $showTitle = mysqli_real_escape_string($link, trim($_POST['showTitle']));
        }

        # Check for an email address:
        if (empty($_POST['showReleseDate'])) {
            $errors[] = 'no date entered';
        } else {
            $showReleseDate = mysqli_real_escape_string($link, trim($_POST['showReleseDate']));
        }

        # Check for an email address:
        if (empty($_POST['showLanguage'])) {
            $errors[] = 'no language entered';
        } else {
            $showLanguage = mysqli_real_escape_string($link, trim($_POST['showLanguage']));
        }

        # Check for an email address:
        if (empty($_POST['showGenreID'])) {
            $errors[] = 'no genre entered';
        } else {
            $showGenreID = mysqli_real_escape_string($link, trim($_POST['showGenreID']));
        }

        # Check for an email address:
        if (empty($_POST['showImageLink'])) {
            $errors[] = 'no image link entered';
        } else {
            $showImageLink = mysqli_real_escape_string($link, trim($_POST['showImageLink']));
        }

        # Check for an email address:
        if (empty($_POST['showTrailerLink'])) {
            $errors[] = 'no trailer link entered';
        } else {
            $showTrailerLink = mysqli_real_escape_string($link, trim($_POST['showTrailerLink']));
        }

        # Check for an email address:
        if (empty($_POST['showMediaLink'])) {
            $errors[] = 'no media link entered';
        } else {
            $showMediaLink = mysqli_real_escape_string($link, trim($_POST['showMediaLink']));
        }

        if (empty($_POST['showDescription'])) {
            $errors[] = 'no trailer link entered';
        } else {
            $showDescription = mysqli_real_escape_string($link, trim($_POST['showDescription']));
        }


        # Check if email address already registered.
        if (empty($errors)) {
            $q = "SELECT * FROM genre WHERE genreID='$showGenreID'";
            $r = @mysqli_query($link, $q);
            if (mysqli_num_rows($r) == 0) $errors[] = 'genre does not exist</a>';
        }

        # On success register user inserting into 'users' database table.
        if (empty($errors)) {

            $q = "INSERT INTO mediaInfo (mediaInfoID, title, image, description, releaseDate, language, trailerLink) VALUES ('$showId', '$showTitle', '$showImageLink', '$showDescription', '$showReleseDate', '$showLanguage', '$showTrailerLink' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<p>1/5</p>';
            }

            $q = "INSERT INTO mediaType (typeID, mediaInfoID, name) VALUES ('$mediaTypeID', '$showId', '$mediaTypeName' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<p>2/5</p>';
            }

            $q = "INSERT INTO mediaGenre (mediaGenreID, mediaInfoID, genreID) VALUES ('$mediaGenreID', '$showId', '$showGenreID' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<p>3/5</p>';
            }

            $q = "INSERT INTO seasons (seasonID, mediaInfoID, number) VALUES ('$seasonID', '$showId', '$seasonNumber' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<p>4/5</p>';
            }

            $q = "INSERT INTO media (mediaID, seasonID, episodeNumber, link) VALUES ('$mediaID', '$seasonID', '$episodeNumber', '$showMediaLink' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<p>5/5</p><br><P>Success! show has been added, please click <a href="admin_view_show.php">here</a></P>';
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
        <h1 class="text-center display-4">Add Show</h1>
        <div class="col-sm d-flex justify-content-center">
            <div class="card text-center">

                <div class="card-body">
                    <!-- Display body section with sticky form. -->
                    <form action="admin_add_show.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="test" class="form-control" id="showTitle" name="showTitle" placeholder="Show Title" size="20" required value="<?php if (isset($_POST['showTitle'])) echo $_POST['showTitle']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="showReleseDate" name="showReleseDate" placeholder="Relese Date" size="20" required value="<?php if (isset($_POST['showReleseDate'])) echo $_POST['showReleseDate']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="showLanguage" name="showLanguage" placeholder="Language" size="20" required value="<?php if (isset($_POST['showLanguage'])) echo $_POST['showLanguage']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="showGenreID" name="showGenreID" placeholder="Genre ID" size="20" required value="<?php if (isset($_POST['showGenreID'])) echo $_POST['showGenreID']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="showImageLink" name="showImageLink" placeholder="Image Link" size="50" required value="<?php if (isset($_POST['showImageLink'])) echo $_POST['showImageLink']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="showTrailerLink" name="showTrailerLink" placeholder="Trailer Link" size="50" required value="<?php if (isset($_POST['showTrailerLink'])) echo $_POST['showTrailerLink']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="showMediaLink" name="showMediaLink" placeholder="Show Link" size="50" required value="<?php if (isset($_POST['showMediaLink'])) echo $_POST['showMediaLink']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea type="text" class="form-control" id="showDescription" name="showDescription" placeholder="Show Description" size="500" rows="10" required value="<?php if (isset($_POST['showDescription'])) echo $_POST['showDescription']; ?>"></textarea>
                                <p class="text-center lead">Please make sure the genre already exists BEFORE adding the show
                                <p>
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