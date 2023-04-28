<?php
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_toolsAdmin.php' ) ; load() ; }

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    # Connect to the database.
    require ('connect_db.php');
# Initialize an error array.
    $errors = array();

    # Check for a user id:
    if ( empty( $_POST[ 'user_id' ] ) )
    { $errors[] = 'Enter user ID.'; }
    else
    { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'user_id' ] ) ) ; }
# Check for a card number input.
//    if ( !empty($_POST[ 'card_number' ] ) )
//    {
//         $card_no = mysqli_real_escape_string( $link, trim( $_POST[ 'card_number' ] ) ) ;
//    }
//    else { $errors[] = 'Enter your card number.' ; }
//    # Check for a month expired input.
//    if ( !empty($_POST[ 'exp_month' ] ) )
//    {
//        $exp_m = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_month' ] ) ) ;
//    }
//    else { $errors[] = 'Enter your expired month.' ; }
//    # Check for a year expired input.
//    if ( !empty($_POST[ 'exp_year' ] ) )
//    {
//        $exp_y = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_year' ] ) ) ;
//    }
//    else { $errors[] = 'Enter user category.' ; }
//    # Check for a status input.
//    if ( !empty($_POST[ 'status' ] ) )
//    {
//        $st = mysqli_real_escape_string( $link, trim( $_POST[ 'status' ] ) ) ;
//    }
//    else { $errors[] = 'Enter user status.' ; }

# Check if email address already registered.
    if ( empty( $errors ) )
    {
        $q = "SELECT * FROM users WHERE email='$e'" ;
        $r = @mysqli_query ( $link, $q ) ;
    }
# On success new password into 'users' database table.
    if ( empty( $errors ) )
    {
        $q = "DELETE FROM users WHERE user_id = '$e'";
        $r = @mysqli_query ( $link, $q ) ;
        if ($r)
        {
            header("Location: editUserAdmin.php");
        } else {
            echo "Error updating record: " . $link->error;
        }
# Close database connection.

        mysqli_close($link);
        exit();
    }
# Or report errors.
    else
    {
        echo ' <div class="container"><div class="alert alert-dark alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
	<h1><strong>Error!</strong></h1><p>The following error(s) occurred:<br>' ;
        foreach ( $errors as $msg )
        { echo " - $msg<br>" ; }
        echo 'Please try again.</div></div>';
        # Close database connection.
        mysqli_close( $link );
    }
}


