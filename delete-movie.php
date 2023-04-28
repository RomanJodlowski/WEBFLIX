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

    # Check for a movie ID:
    if ( empty( $_POST[ 'id' ] ) )
    { $errors[] = 'Enter movie ID.'; }
    else
    { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'id' ] ) ) ; }

# Check if ID already registered.
    if ( empty( $errors ) )
    {
        $q = "SELECT * FROM movie WHERE id='$e'" ;
        $r = @mysqli_query ( $link, $q ) ;
    }
# On success new changes into 'movie' database table.
    if ( empty( $errors ) )
    {
        $q = "DELETE FROM movie WHERE id = '$e'";
        $r = @mysqli_query ( $link, $q ) ;
        if ($r)
        {
            header("Location: deleteMovieAdmin.php");
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


