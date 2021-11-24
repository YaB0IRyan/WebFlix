<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- admin_edit_user.php -->

<!-- this page handles the code to allow an admin to edit a user -->

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
    <?php
    if (isset($_GET['currentID'])) $currentID = $_GET['currentID'];

    # Get all current info for user.            

    ?>


    <h1 class="text-center display-4">User ID - <?php echo $currentID; ?></h1>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h4 class="text-center">Current Information</h4>
                <?php

                $q = "SELECT * FROM users WHERE userID='$currentID'";
                $r = mysqli_query($link, $q);
                if (mysqli_num_rows($r) > 0) {
                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

                        $currentEmail = $row['email'];
                        $currentForename = $row['forename'];
                        $currentSurname = $row['surname'];
                        $currentBirthDate = $row['birthDate'];
                        $currentCountry = $row['country'];
                        $currentJoinDate = $row['joinDate'];
                        $currentContactNumber = $row['contactNumber'];
                        $currentPassword = $row['userPassword'];
                        $currentSecurityKey = $row['securityKey'];
                        $currentUserStatus = $row['userStatus'];


                        echo '<hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">ID</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['userID'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['email'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Forename</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['forename'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Surname</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['surname'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">D.O.B</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['birthDate'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Contact Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['contactNumber'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Country</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['country'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Member Since </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['joinDate'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['userStatus'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><small>' . $row['userPassword'] . '</small></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Security Key</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['securityKey'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Admin Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['isAdmin'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Paid Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['isPaid'] . '</div>
                </div>
                <hr>
                
                ';
                    }
                } ?>
            </div>
            <div class="col-sm-12 col-md-6">
                <h4 class="text-center">WARNING - PLEASE READ</h4>
                <hr>
                <p class="text-center text-secondary">Any changes made to the data can cause errors in the database, please make sure that the data matches up with the current data, and that the format is the same</p>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">

            </div>
            <div class="col-sm-12 col-md-6">

            </div>
        </div>
    </div>
    <br>
    <br>

    <?php
    # DISPLAY COMPLETE REGISTRATION PAGE.
    # Check form submitted.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # Connect to the database.
        require('includes/connect_db.php');

        # Initialize an error array.
        $errors = array();

        #calls guid function
        $id = $currentID;

        # Check for an email address: 
        if (empty($_POST['email'])) {
            $errors[] = 'Error updating Email';
        } else {
            $email = mysqli_real_escape_string($link, trim($_POST['email']));
        }

        # Check for a first name.
        if (empty($_POST['forename'])) {
            $errors[] = 'Error updating Forename';
        } else {
            $forename = mysqli_real_escape_string($link, trim($_POST['forename']));
        }

        # Check for a last name.
        if (empty($_POST['surname'])) {
            $errors[] = 'Error updating Surname';
        } else {
            $surname = mysqli_real_escape_string($link, trim($_POST['surname']));
        }

        # Check for a date of birth.
        if (empty($_POST['birthDate'])) {
            $errors[] = 'Error updating Birth Date';
        } else {
            $dob = mysqli_real_escape_string($link, trim($_POST['birthDate']));
        }

        # Check for a phone number.
        if (empty($_POST['contactNumber'])) {
            $errors[] = 'Error updating Contact Number';
        } else {
            $phone = mysqli_real_escape_string($link, trim($_POST['contactNumber']));
        }

        # Check for a country.
        if (empty($_POST['country'])) {
            $errors[] = 'Error updating Country';
        } else {
            $country = mysqli_real_escape_string($link, trim($_POST['country']));
        }


        # Check for a securityKey.
        if (empty($_POST['securityKey'])) {
            $errors[] = 'Error updating Security Key';
        } else {
            $key = mysqli_real_escape_string($link, trim($_POST['securityKey']));
        }


        # Check for a password and matching input passwords.
        if (empty($_POST['password'])) {
            $errors[] = 'Error updating Password';
        } else {
            $password = mysqli_real_escape_string($link, trim($_POST['password']));
        }


        # Check for a password and matching input passwords.
        if (empty($_POST['joinDate'])) {
            $errors[] = 'Error updating Join Date';
        } else {
            $joinDate = mysqli_real_escape_string($link, trim($_POST['joinDate']));
        }


        # Check for a securityKey.
        if (empty($_POST['userStatus'])) {
            $errors[] = 'Error updating userStatus';
        } else {
            $userStatus = mysqli_real_escape_string($link, trim($_POST['userStatus']));
        }


        if (empty($errors)) {
            $q = "UPDATE users SET userID='$id', email='$email', forename='$forename', surname='$surname', birthDate='$dob', contactNumber='$phone', country='$country', joinDate='$joinDate', userStatus='$userStatus', userPassword='$password', securityKey='$key' WHERE userID='$currentID'";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<h1 class="text-center">Success!</h1><br><p class="text-center">Please click <a href="admin_view_users.php">here</a> to update on site</p>';
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
        <h4 class="text-center">Update Information</h4>
        <div class="col-sm d-flex justify-content-center">
            <div class="card text-center">
                <div class="card-body">
                    <!-- Display body section with sticky form. -->
                    <form action="admin_edit_user.php?currentID=<?php echo $currentID ?>" method="post">
                        <div class="form-row">
                            <!-- Left Half - Forename -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="forename" name="forename" placeholder="First Name" value="<?php echo $currentForename ?>" size="20" required value="<?php if (isset($_POST['forename'])) echo $_POST['forename']; ?>">
                            </div>
                            <!-- Right Half - Surname -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Last Name" value="<?php echo $currentSurname ?>" size="20" required value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>">
                            </div>
                            <!-- Full - Email -->
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $currentEmail ?>" size="50" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                            </div>
                            <!-- Left Half - Birth Date -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="birthDate" name="birthDate" placeholder="Birthday YYYY-MM-DD" value="<?php echo $currentBirthDate  ?>" size="20" required value="<?php if (isset($_POST['birthDate'])) echo $_POST['birthDate']; ?>">
                            </div>
                            <!-- Right Half - Country -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="country" name="country" placeholder="country" value="<?php echo $currentCountry ?>" size="20" required value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>">
                            </div>
                            <!-- Left Half - Join Date -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="joinDate" name="joinDate" placeholder="Join DateYYYY-MM-DD" value="<?php echo $currentJoinDate ?>" size="20" required value="<?php if (isset($_POST['joinDate'])) echo $_POST['joinDate']; ?>">
                            </div>
                            <!-- Right Half - Phone Number -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="phone number" value="<?php echo $currentContactNumber ?>" size="50" required value="<?php if (isset($_POST['contactNumber'])) echo $_POST['contactNumber']; ?>">
                            </div>
                            <!-- Full - Password -->
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $currentPassword ?>" size="50" required value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
                            </div>
                            <!-- Left Half - Security Key -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="securityKey" name="securityKey" placeholder="Security Key" value="<?php echo $currentSecurityKey ?>" size="50" required value="<?php if (isset($_POST['securityKey'])) echo $_POST['securityKey']; ?>">
                            </div>
                            <!-- Right Half - Status -->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="userStatus" name="userStatus" placeholder="userStatus" value="<?php echo $currentUserStatus ?>" size="50" required value="<?php if (isset($_POST['userStatus'])) echo $_POST['userStatus']; ?>">
                            </div>
                            <p class="text-center lead">WARNING - be careful when changing data, if any mistakes are made the entry will need to be removed from the database and recreated</p>
                        </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-dark btn-block">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end of container-->
    <br>
    <br>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>