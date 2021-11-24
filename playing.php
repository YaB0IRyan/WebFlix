<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- playing.php -->

<!-- this page displays the selected movie by the user -->

<?php # DISPLAY COMPLETE REGISTRATION PAGE.
$page_title = 'User Area ';
?>

<?php

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


  <?php

  # Get passed product id and assign it to a variable.
  if (isset($_GET['id'])) $id = $_GET['id'];

  # Open database connection.
  require('includes/connect_db.php');

  # Retrieve selective item data from 'movie' database table. 
  $q = "SELECT mediaInfo.mediaInfoID,
	mediaInfo.title, 
	mediaInfo.image,
	mediaInfo.description,
	mediaInfo.releaseDate,
	mediaInfo.language,
	mediaInfo.trailerLink,
	mediaType.name AS type,
	group_concat(DISTINCT genre.name) AS genres,

	media.link AS data

	FROM mediaInfo
	RIGHT JOIN mediaType ON mediaInfo.mediaInfoID = mediaType.mediaInfoID
	RIGHT JOIN mediaGenre ON mediaInfo.mediaInfoID = mediaGenre.mediaInfoID
	RIGHT JOIN seasons ON mediaInfo.mediaInfoID = seasons.mediaInfoID
	RIGHT JOIN media ON seasons.seasonID = media.seasonID
	RIGHT JOIN genre ON genre.genreID = mediaGenre.genreID
	WHERE genre.genreID = mediaGenre.genreID AND mediaGenre.mediaInfoID = mediaInfo.mediaInfoID AND mediaInfo.mediaInfoID = '$id'
	GROUP BY mediaInfo.mediaInfoID LIMIT 1";

  $r = mysqli_query($link, $q);
  if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($_SESSION['isPaid'] == 1) {
      echo '<div class="container">
		<h1 class="text-center display-4">' . $row['title'] . '</h1>
		<hr>
		<div class="row">
			<div class="col-sm-12 col-md-4">
                <h4>Other Info</h4>
				<hr>
				<p>Relese Date - ' . $row['releaseDate'] . '</p>
				<p>Language - ' . $row['language'] . '</p>
				<p>Genre - ' . $row['genres'] . '</p>
			</div>
			<div class="col-sm-12 col-md-4">
                <h4>Watch</h4>
				<hr>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="' . $row['data'] . '" title="YouTube video player" 
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
			</div>
			<div class="col-sm-12 col-md-4">
				<h4>Description</h4>
				<hr>
				<p>' . $row['description'] . '</p>
			</div>
		</div>
    </div>';
    }
    if ($_SESSION['isPaid'] == 0) {
      echo '<div class="container">
		<h1 class="text-center display-4">' . $row['title'] . '</h1>
		<hr>
		<div class="row">
			<div class="col-sm-12 col-md-4">
                <h4>Other Info</h4>
				<hr>
				<p>Relese Date - ' . $row['releaseDate'] . '</p>
				<p>Language - ' . $row['language'] . '</p>
				<p>Genre - ' . $row['genres'] . '</p>
			</div>
			<div class="col-sm-12 col-md-4">
                <h4>Trailer</h4>
				<hr>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="' . $row['trailerLink'] . '" title="YouTube video player" 
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
			</div>
			<div class="col-sm-12 col-md-4">
				<h4>Description</h4>
				<hr>
				<p>' . $row['description'] . '</p>
			</div>
		</div>
    </div>';
    }
  } else {
    $temp = mysqli_num_rows($r);
    echo ($temp);
  }

  # Close database connection.
  mysqli_close($link);
  ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>