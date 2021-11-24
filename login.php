<!doctype html>
    <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	
            <!-- My CSS -->
            <link rel="stylesheet" href="css/custom.css">

            <!-- title -->
            <title>eCar</title>

        </head>
        <body>
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #18454d;">
            <a class="navbar-brand" href="index.html"><img class="logo" src="img/Logo.png" width="100"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>         
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="about_us.php">About us</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="login.php">Sign in</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                  </ul>
              </form>
            </div>
          </nav>
          <!-- End of Navigation -->

  <?php


  /* The $errors array will only be set by the PHP
handler script after the form has been submitted
Display any error messages if present.*/

  if (isset($errors) && !empty($errors)) {
    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<p id="err_msg">Oops! There was a problem:<br>';
    foreach ($errors as $msg) {
      echo " - $msg<br>";
    }
    echo 'Please try again or <a href="register.php"><strong>Register</strong></a></p>
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  ?>

<div class="container">
    <h1 class="text-center display-4">Sign Up</h1>
    <div class="col-sm d-flex justify-content-center">
      <div class="card text-center">

        <div class="card-body">
          <!-- Display body section with sticky form. -->
          <form action="register.php" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="forename" name="forename" placeholder="First Name" size="20" required value="<?php if (isset($_POST['forename'])) echo $_POST['forename']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Last Name" size="20" required value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>">
              </div>
            </div>
        </div>
        <div class="card-footer text-muted">
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-dark btn-block">Sign Up Now</button>
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