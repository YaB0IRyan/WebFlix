<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- logout.php -->

<!-- this page ends he session and redirects the user after they select logout -->

<?php # DISPLAY COMPLETE LOGGED OUT PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userID' ] ) ) { require ( 'login_tools.php' ) ; load() ; }


# Clear existing variables.
$_SESSION = array() ;
  
# Destroy the session.
session_destroy() ;


include ( 'index.php' ) ;
# Display body section.

?>

