<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<style>
    iframe {
        border: 0;
    }
</style>
</head>
<body>

<?php
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ;

# Open database connection.
require ( 'connect_db.php' ) ;

include('header2.php');

# Retrieve selective item data from 'movie' database table.
$q = "SELECT * FROM movie WHERE id=$id" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

# Check if cart already contains one movie id.
    if (isset($_SESSION['cart'][$id]))
    {
# Add one more of this product.
        $_SESSION['cart'][$id]['quantity']++;
        echo '

<div class="container">
<div class="row">
	<div class="col-md-12 col-md-4">
	  <div class="embed-responsive embed-responsive-16by9">
	     <iframe class="embed-responsive-item" src=' . $row['preview'] . '   
    frameborder="0" allow="accelerometer; 
     autoplay; 
     encrypted-media; 
     gyroscope; 
     picture-in-picture"   allowfullscreen>
	        </iframe>
	     </div><!- - Close embed-responsive - - >
            </div>
            <div class="container mt-3">
            
  <h1 class="display-4">' . $row['movie_title'] . '</h1> 
  
  <!-- Button trigger modal -->
<button
    type="button"
    class="btn btn-outline-light btn-lg"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    Trailer ON/OFF 
</button>

<!-- Modal -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
        <iframe
            width="100%"
            height="200vh"
            src= ' . $row['preview'] . '
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
        </div>
    </div>
    </div>
</div>
     <br>
     <br>
  <p>' . $row['further_info'] . '</p>    
  <p>' . $row['release_date'] . '</p>    
  <p>' . $row['mlanguage'] . '</p>    
  <p>' . $row['duration'] . '</p>    
  <p>' . $row['season_episode'] . '</p>    
</div>
<a href="index2.php"><button type="button" class="btn btn-outline-primary">Back</button></a>
<br>
<br>
<hr class="bg-info">
<br>
</div>

 ';
    }
    else
    {
        # Or add one of this product to the cart.
        $_SESSION['cart'][$id] = array('quantity' => 1, 'price' => $row['mov_price']);
        echo '
<div class="container">
<div class="row">
	<div class="col-md-12 col-md-4">
	  <div class="embed-responsive embed-responsive-16by9">
	     <iframe class="embed-responsive-item" src=' . $row['preview'] . '
    frameborder="0" allow="accelerometer;
     autoplay;
     encrypted-media;
     gyroscope;
     picture-in-picture"   allowfullscreen>
	        </iframe>
	     </div><!- - Close embed-responsive - - >
            </div> <!- - Close column - - >
<div class="container mt-3">
  <h1 class="display-4">' . $row['movie_title'] . '</h1>   
  
   <!-- Button trailer modal -->
<button
    type="button"
    class="btn btn-outline-light btn-lg"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    Trailer ON/OFF 
</button>

<!-- Trailer Modal -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
        <iframe
            width="400"
            height="200"
            src= ' . $row['preview'] . '
            title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
        </div>
    </div>
    </div>
</div>
     <br>
     <br> 
  <p>' . $row['further_info'] . '</p>   
   <p>' . $row['release_date'] . '</p>    
  <p>' . $row['mlanguage'] . '</p>    
  <p>' . $row['duration'] . '</p>    
  <p>' . $row['season_episode'] . '</p> 
</div>
<a href="index2.php"><button type="button" class="btn btn-outline-primary">Back</button></a>
<br>
<br>
<hr class="bg-info">
<br>
</div>
';
    }
}
# Close database connection.
mysqli_close( $link ) ;
?>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>
</html>
