<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- payment_success.php -->

<!-- this page updates the user so that they are a paid user after the paypal payment is succesfull -->

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

$id= $_SESSION['userID'];

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
        <a class="navbar-brand" href="#"><img class="logo" src="img/Logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
    <!-- end primary navigation -->





    <div class="container">
        <?php

        $q = "UPDATE users SET isPaid=1 WHERE userID='$id'";
        $r = @mysqli_query($link, $q);
        if ($r) {
            echo '<h1 class="text-center display-4">Success</h1>
                <p>Payment succesfull, you are now subscribed, please click <a href="logout.php">here</a> and then log back in</p>';
        }

        ?>

    </div>










    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>