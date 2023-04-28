<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">

    <style>

        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropup {
            position: relative;
            display: inline-block;
        }

        .dropup-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            bottom: 50px;
            z-index: 1;
        }

        .dropup-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropup-content a:hover {background-color: #ccc}

        .dropup:hover .dropup-content {
            display: block;
        }

        .dropup:hover .dropbtn {
            background-color: #2980B9;
        }

         /*Style the div filters*/
        .filterDiv {
            float: left;
            width: 250px;
            line-height: 100px;
            text-align: center;
            margin: 10px;
            display: none;
        }

        .show {
            display: block;
        }

        .container {
            margin-top: 20px;
            overflow: hidden;
        }

    /* style the carousel*/
        * {box-sizing: border-box;}
        body {font-family: Verdana, sans-serif;}
        .mySlides {display: none;}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
            max-width: 300px;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            color: #8DA9F7;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #203775;
            border-radius: 50%;
            display: none;
            transition: background-color 0.6s ease;
        }

        .active {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 9.5s;
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .text {font-size: 11px}
        }

    </style>

    <title>index</title>

</head>
<body>

<?php
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'What\’s On' ;
include('header2.php');

# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve movies from 'movie' database table.
$q = "SELECT * FROM movie" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 ) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
# Display body section.

        echo '

<!-- Carousel -->

<div class="slideshow-container">

    <div class="mySlides fade">
        <img src=' . $row['img'] . ' style="width:100%">
    </div>

    <!--<div class="mySlides fade">
        <img src="image/now2.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
        <img src="image/now3.jpg" style="width:100%">
    </div>-->

</div>

<div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

';
    }
}
echo '
<div class="dropup">
<div class="container">
  <button class="dropbtn btn btn-outline-light btn-lg"> Filter Of The Content </button>
  <div class="dropup-content">
    <a type="button" onclick="filterSelection(\'all\')"> Show all </a>
    <a type="button" onclick="filterSelection(\'horror\')"> Horror </a>
    <a type="button" onclick="filterSelection(\'drama\')"> Drama </a>
    <a type="button" onclick="filterSelection(\'fantasy\')"> Fantasy </a>
    <a type="button" onclick="filterSelection(\'comedy\')"> Comedy </a>
    <a type="button" onclick="filterSelection(\'children\')"> Children </a>
    <a type="button" onclick="filterSelection(\'tv\')"> TV Show </a>
  </div>
</div>
</div>
<div class="container future-movie">
<br>
<hr class="bg-info">

<div class="card-body">
				<div class="row">
';
# Open database connection.
require ( 'connect_db.php' ) ;
# Retrieve horror movies from 'movie' database table.
$q = "SELECT * FROM movie WHERE cat='ah'" ;
$r = mysqli_query( $link, $q ) ;
# Retrieve comedy movies from 'movie' database table.
$qc = "SELECT * FROM movie WHERE cat='ac'" ;
$rc = mysqli_query( $link, $qc ) ;
# Retrieve fantasy movies from 'movie' database table.
$qf = "SELECT * FROM movie WHERE cat='af'" ;
$rf = mysqli_query( $link, $qf ) ;
# Retrieve drama movies from 'movie' database table.
$qd = "SELECT * FROM movie WHERE cat='ad'" ;
$rd = mysqli_query( $link, $qd ) ;
# Retrieve children movies from 'movie' database table.
$qch = "SELECT * FROM movie WHERE cat='c'" ;
$rch = mysqli_query( $link, $qch ) ;
# Retrieve TV shows from 'movie' database table.
$qtv = "SELECT * FROM movie WHERE cat='tv'" ;
$rtv = mysqli_query( $link, $qtv ) ;


#horror movies
if ( mysqli_num_rows( $r ) > 0 )
{
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC )) {
    echo '
    <div class="filterDiv horror"><a href="movie.php?id=' . $row['id'] . '"><img class="card-img-top" src=' . $row['img'] . ' alt="Movie"></a></div>
    
    ';
    # Open database connection.
}
    # Close database connection.
    mysqli_close( $link) ;
}

#comedy movies
if ( mysqli_num_rows( $rc ) > 0 )
{
    while ( $row = mysqli_fetch_array( $rc, MYSQLI_ASSOC ))
    {
    echo '
    <div class="filterDiv comedy"><a href="movie.php?id='.$row['id'].'"><img class="card-img-top" src='. $row['img'].' alt="Movie"></a></div>
';
}
# Close database connection.
mysqli_close( $link) ;
}

#fantasy movies
if ( mysqli_num_rows( $rf ) > 0 )
{
    while ( $row = mysqli_fetch_array( $rf, MYSQLI_ASSOC ))
    {
        echo '
    <div class="filterDiv fantasy"><a href="movie.php?id='.$row['id'].'"><img class="card-img-top" src='. $row['img'].' alt="Movie"></a></div>
';
    }
# Close database connection.
    mysqli_close( $link) ;
}

#drama movies
if ( mysqli_num_rows( $rd ) > 0 )
{
    while ( $row = mysqli_fetch_array( $rd, MYSQLI_ASSOC ))
    {
        echo '
    <div class="filterDiv drama"><a href="movie.php?id='.$row['id'].'"><img class="card-img-top" src='. $row['img'].' alt="Movie"></a></div>
';
    }
# Close database connection.
    mysqli_close( $link) ;
}

#children movies
if ( mysqli_num_rows( $rch ) > 0 )
{
    while ( $row = mysqli_fetch_array( $rch, MYSQLI_ASSOC ))
    {
        echo '
    <div class="filterDiv children"><a href="movie.php?id='.$row['id'].'"><img class="card-img-top" src='. $row['img'].' alt="Movie"></a></div>
';
    }
# Close database connection.
    mysqli_close( $link) ;
}

# tv
if ( mysqli_num_rows( $rtv ) > 0 )
{
    while ( $row = mysqli_fetch_array( $rtv, MYSQLI_ASSOC ))
    {
        echo '
    <div class="filterDiv tv"><a href="movie.php?id='.$row['id'].'"><img class="card-img-top" src='. $row['img'].' alt="Movie"></a></div>
';
    }
    echo'</div></div>';

# Close database connection.
    mysqli_close( $link) ;
}
?>

<script>
    filterSelection("all")
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c === "all") c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }

    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) === -1) {element.className += " " + arr2[i];}
        }
    }

    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    // Add active class to the current button (highlight it)
    // var btnContainer = document.getElementById("myBtnContainer");
    // var btns = btnContainer.getElementsByClassName("btn");
    // for (var i = 0; i < btns.length; i++) {
    //     btns[i].addEventListener("click", function(){
    //         var current = document.getElementsByClassName("active");
    //         current[0].className = current[0].className.replace(" active", "");
    //         this.className += " active";
    //     });
    // }
</script>


<script>
	let slideIndex = 0;
	showSlides();

	function showSlides() {
		let i;
		let slides = document.getElementsByClassName("mySlides");
		let dots = document.getElementsByClassName("dot");
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		slideIndex++;
		if (slideIndex > slides.length) {slideIndex = 1}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex-1].style.display = "block";
		dots[slideIndex-1].className += " active";
		setTimeout(showSlides, 5000); // Change image every 2 seconds
	}
</script>

<!-- Optional JavaScript; choose one of the two! -->
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