<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- forgot_password.php -->

<!-- this page handles the code for displaying the login with security key screen -->

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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img class="logo" src="img/Logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="login.php">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Sign Up</a>
          </li>
        </ul>
      </form>
    </div>
  </nav><!-- end primary navigation -->

  <?php # DISPLAY COMPLETE LOGIN PAGE.

  # Set page title and display header section.
  $page_title = 'Forgot password';
  # Reads the navigation before reading the rest of the page

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

  <!-- Display body section. 
Clicking the login button before the PHP handler 
script has been created will simply produce an HTTP404 page Not Found error
-->

  <h1 class="text-center display-4">Forgot Password</h1>
  <p class="text-center">You may now sign into your account with your security key, after you sign in will be asked to change your password</p>
  <div class="col-flex justify-content-center">
    <div class="card text-center">

      <div class="card-body">
        <div class="row">
          <div class="col-sm col-md">
            <form action="forgot_password_action.php" method="post">
              <input type="text" class="form-control" name="email" placeholder="Email" required>
          </div>
          <div class="col-sm col-md">
            <input type="text" class="form-control" name="key" placeholder="Security Key" required></p>
          </div>

        </div>
        <div class="card-footer text-muted">
          <input type="submit" class="btn btn-dark btn-block" value="Sign In Now">
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