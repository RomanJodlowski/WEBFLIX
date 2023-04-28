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

    # Check for a movie title input.
    if ( !empty($_POST[ 'movie_title' ] ) )
    {
        $mov_t = mysqli_real_escape_string( $link, trim( $_POST[ 'movie_title' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie title.' ; }

    # Check for a movie further info input.
    if ( !empty($_POST[ 'further_info' ] ) )
    {
        $fi = mysqli_real_escape_string( $link, trim( $_POST[ 'further_info' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie info.' ; }

    # Check for a movie poster input.
    if ( !empty($_POST[ 'img' ] ) )
    {
        $img = mysqli_real_escape_string( $link, trim( $_POST[ 'img' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie poster.' ; }

    # Check for a movie preview input.
    if ( !empty($_POST[ 'preview' ] ) )
    {
        $prev = mysqli_real_escape_string( $link, trim( $_POST[ 'preview' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie preview.' ; }

    # Check for a movie release input.
    if ( !empty($_POST[ 'release_date' ] ) )
    {
        $re = mysqli_real_escape_string( $link, trim( $_POST[ 'release_date' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie release date.' ; }

    # Check for a movie language input.
    if ( !empty($_POST[ 'mlanguage' ] ) )
    {
        $lan = mysqli_real_escape_string( $link, trim( $_POST[ 'mlanguage' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie language.' ; }

    # Check for a movie duration input.
    if ( !empty($_POST[ 'duration' ] ) )
    {
        $dur = mysqli_real_escape_string( $link, trim( $_POST[ 'duration' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie duration.' ; }

    # Check for a season/episode input.
    if ( !empty($_POST[ 'season_episode' ] ) )
    {
        $se = mysqli_real_escape_string( $link, trim( $_POST[ 'season_episode' ] ) ) ;
    }
    else { $errors[] = 'Enter your season/episode.' ; }

    # Check for a category input.
    if ( !empty($_POST[ 'cat' ] ) )
    {
        $cat = mysqli_real_escape_string( $link, trim( $_POST[ 'cat' ] ) ) ;
    }
    else { $errors[] = 'Enter your movie category.' ; }

# Check if ID already registered.
    if ( empty( $errors ) )
    {
        $q = "SELECT * FROM movie WHERE id='$e'" ;
        $r = @mysqli_query ( $link, $q ) ;
        if (mysqli_num_rows($r) != 0) $errors[] = 'Movie ID already exist.';
    }
# On success new movie into 'movie' database table.
    if ( empty( $errors ) )
    {
        $q = "INSERT INTO movie (id, movie_title, further_info, img, preview, release_date, mlanguage, duration, season_episode, cat)
 VALUES ('$e', '$mov_t', '$fi', '$img', '$prev', '$re', '$lan', '$dur', '$se', '$cat')";
        $r = @mysqli_query ( $link, $q ) ;
        if ($r)
        {
            header("Location: addMovieAdmin.php");
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


