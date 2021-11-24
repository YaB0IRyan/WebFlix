<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- user_login.php -->

<!-- this page handles the code for displaying account area of the user logged in -->

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
          <a class="nav-link active" href="user_login.php"><?php echo "{$_SESSION['forename']}"; ?> <span class="sr-only"></span></a>
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

    <h1 class="text-center display-4">User Area</h1>
    <h2 class="text-center">
      </h1>



      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h4 class="text-center">User Information</h4>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['email']}" ?></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Full Name</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['forename']} {$_SESSION['surname']}" ?></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">D.O.B</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['birthDate']}" ?></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Phone Number</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['contactNumber']}" ?></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Registerd Since</h6>
              </div>
              <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['joinDate']}" ?></div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="container">
              <h4 class="text-center">Change Password</h4>
              <hr>
              <h6>Characteristics of strong passwords: </h6>
              <ul>
                <li>At least 8 characters—the more characters, the better.</li>
                <li>A mixture of both uppercase and lowercase letters.</li>
                <li>A mixture of letters and numbers.</li>
                <li>Inclusion of at least one special character, e.g., ! @ # ? </li>
              </ul>
              <hr>
              <div class="d-grid gap-2 col-6 mx-auto">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#password">Change Password</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <br>
            <h4 class="text-center">Subscribe</h4>
            <hr>
            <!-- succesfull pay function -->
            <div id="paypal-button-container"></div>
            <script src="https://www.paypal.com/sdk/js?client-id=AaLvedXdZUtX7LLMW5CZ3tbj5CiFOBOHEE8S1SpSzW3CgjNQzkaOha1dX53LwNbNS4WD_e7mapZh5mb1&currency=GBP" data-sdk-integration-source="button-factory"></script>
            <script>
              function paid() {
                location.replace("payment_succsss.php");
              }

              paypal.Buttons({
                  style: {
                    color: "silver",
                    shape: "pill",
                  },
                  createOrder: function(data, actions) {
                    // Set up the transaction
                    return actions.order.create({
                      purchase_units: [{
                        amount: {
                          currency_code: "GBP",
                          value: "99",
                        },
                        description: "Webflix Premium",
                        custom_id: "64735",
                      }, ],
                    });
                  },
                  onApprove: function(data, actions) {
                    // Capture order after payment approved
                    return actions.order.capture().then(function(details) {
                      paid();
                    });
                  },
                  onError: function(err) {
                    errorText = err;
                    error = true;
                  },
                })
                .render("#paypal-button-container"); // Renders the PayPal button
            </script>
          </div>
          <div class="col-sm-12 col-md-6">
          </div>
        </div>
      </div>



      <!--  =============================
=====    Modal Change Password   =======
	=================================== -->


      <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
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
          </div>
        </div>
      </div>






      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>