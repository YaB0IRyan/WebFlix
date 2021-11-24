<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- admin_view_show.php -->

<!-- this page handles the code for the admin page when viewing all the shows -->

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
                <li class="nav-item active">
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
	<h1 class="text-center display-4">Shows</h1>
    <hr>
	
	<!--card 1 -->
	<div class="row ">

<?php
	 # Open database connection.
	require ( 'includes/connect_db.php' ) ;
	# Retrieve movies from 'movie' database table.
	$q = "SELECT mediaInfo.mediaInfoID,
  mediaInfo.title, 
  mediaInfo.image,
  mediaInfo.description,
  mediaInfo.releaseDate,
  mediaInfo.language,
  mediaInfo.trailerLink,
  mediaType.name AS type,
  MAX(seasons.number) as seasons,
  COUNT(media.episodeNumber) as episodes,
  group_concat(DISTINCT genre.name) AS genres,

  media.mediaID AS data

  FROM mediaInfo
  RIGHT JOIN mediaType ON mediaInfo.mediaInfoID = mediaType.mediaInfoID
  RIGHT JOIN mediaGenre ON mediaInfo.mediaInfoID = mediaGenre.mediaInfoID
  RIGHT JOIN seasons ON mediaInfo.mediaInfoID = seasons.mediaInfoID
  RIGHT JOIN media ON seasons.seasonID = media.seasonID
  RIGHT JOIN genre ON genre.genreID = mediaGenre.genreID
  WHERE genre.genreID = mediaGenre.genreID AND mediaGenre.mediaInfoID = mediaInfo.mediaInfoID AND mediaType.name = 'Show'
  GROUP BY mediaInfo.mediaInfoID";
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	{
	# Display body section.
 
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
	echo '
	<div class="col-sm d-flex justify-content-center">
		<div class="card shadow p-3 mb-5 bg-dark rounded" style="width: 18rem;">
		  <div class="card-body">
          <h2>'.$row['title'].'</h2>
          <hr class="light-line">
          <p class="text-light">Id = <small>'.$row['mediaInfoID'].'</small></p>
          <hr class="light-line">
          <p class="text-light">Seasons = <small>'.$row['seasons'].'</small></p>
          <hr class="light-line">
          <p class="text-light">Episodes = <small>'.$row['episodes'].'</small></p>
          <img src="'. $row['image'].'" class="card-img-top" alt="movie">
          <hr class="light-line">
            <a href="admin_edit_show.php?currentID='.$row['mediaInfoID'].'" class="btn btn-secondary btn-block">Edit Show</a>
            <a href="admin_delete_show.php?currentID='.$row['mediaInfoID'].'" class="btn btn-outline-danger btn-block">Delete</a>
			
		  </div>
		</div>
	</div>	
	
		
	';

			 }
  
  
	# Close database connection.
	mysqli_close( $link) ; 
	}
	# Or display message.
	else { echo '<p>There are currently no movies.</p>' ; }
			
	?>	
            <a href="admin_add_show.php?currentID='.$row['mediaInfoID'].'" class="btn btn-outline-danger btn-block">Add New Show</a>

	</div>
  <br>
  <br>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>