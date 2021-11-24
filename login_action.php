<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- login_action.php -->

<!-- this page handles creating the session when the user logges in -->

<?php # PROCESS LOGIN ATTEMPT.

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Open database connection.
  require ( 'includes/connect_db.php' ) ;

  # Get connection, load, and validate functions.
  require ( 'login_tools.php' ) ;

  # Check login.
  list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;

  # On success set session data and display logged in page.
  if ( $check )  
  {
    # Access session.
    session_start();
    $_SESSION[ 'userID' ] = $data[ 'userID' ] ;
    $_SESSION[ 'email' ] = $data[ 'email' ] ;
    $_SESSION[ 'forename' ] = $data[ 'forename' ] ;
    $_SESSION[ 'surname' ] = $data[ 'surname' ] ;
    $_SESSION[ 'birthDate' ] = $data[ 'birthDate' ] ;
    $_SESSION[ 'contactNumber' ] = $data[ 'contactNumber' ] ;
    $_SESSION[ 'country' ] = $data[ 'country' ] ;
    $_SESSION[ 'joinDate' ] = $data[ 'joinDate' ] ;
    $_SESSION[ 'userStatus' ] = $data[ 'userStatus' ] ;
    $_SESSION[ 'userPassword' ] = $data[ 'userPassword' ] ;
    $_SESSION[ 'securityKey' ] = $data[ 'securityKey' ] ;
    $_SESSION[ 'isAdmin' ] = $data[ 'isAdmin' ] ;
    $_SESSION[ 'isPaid' ] = $data[ 'isPaid' ] ;

    load ( 'user_login.php' ) ;
  }
  # Or on failure set errors.
  else { $errors = $data; } 

  # Close database connection.
  mysqli_close( $link) ; 
}

# Continue to display login page on failure.
include ( 'login.php' ) ;

?>