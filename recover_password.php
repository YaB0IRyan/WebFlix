<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- recover_password.php -->

<!-- this page displays after the user has logged in with a security key, allowing them to change their password -->

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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img class="logo" src="img/Logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0">

      </form>
    </div>
  </nav><!-- end primary navigation -->

  <div class="card-body">
    <form action="change-password.php" method="post">
      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Confirm Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>

      </div>
      <div class="form-group">
        <input type="password" name="pass1" class="form-control" placeholder="New Password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" required>

      </div>
      <div class="form-group">
        <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required>

      </div>
      <div class="modal-footer">
        <div class="form-group">
          <input type="submit" name="btnChangePassword" class="btn btn-dark btn-block" value="Save Changes" />
        </div>
      </div>
    </form>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>