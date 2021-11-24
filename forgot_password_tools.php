<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->
<!-- forgot_password_tools.php -->

<!-- this page handles the code for back-end of the login with a secuiry key -->

<?php # LOGIN HELPER FUNCTIONS.

# Function to load specified or default URL.
function load( $page = 'forgot_password.php' )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page ;

  # Execute redirect then quit. 
  header( "Location: $url" ) ; 
  exit() ;
}

# Function to check email address and password. 
function validate( $link, $email = '', $key = '')
{
  # Initialize errors array.
  $errors = array() ; 

  # Check email field.
  if ( empty( $email ) ) 
  { $errors[] = 'Enter your email address.' ; } 
  else  { $e = mysqli_real_escape_string( $link, trim( $email ) ) ; }

  # Check password field.
  if ( empty( $key ) ) 
  { $errors[] = 'Enter your security key.' ; } 
  else { $k = mysqli_real_escape_string( $link, trim( $key ) ) ; }

  # On success retrieve user_id, first_name, and last name from 'users' database.
  if ( empty( $errors ) ) 
  {
    $q = "SELECT userID, email, forename, surname, birthDate, contactNumber, country, joinDate, userStatus, userPassword, securityKey, isAdmin, isPaid FROM users WHERE email='$e' AND securityKey='$k'" ;  
    $r = mysqli_query ( $link, $q ) ;
    if ( @mysqli_num_rows( $r ) == 1 ) 
    {
      $row = mysqli_fetch_array ( $r, MYSQLI_ASSOC ) ;
      return array( true, $row ) ; 
    }
    # Or on failure set error message.
    else { $errors[] = 'Email address and security key not found.' ; }
  }
  # On failure retrieve error message/s.
  return array( false, $errors ) ; 
}
?>