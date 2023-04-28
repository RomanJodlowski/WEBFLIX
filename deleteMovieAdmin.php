<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="style/style.css">-->
    <title>indexAdmin</title>

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

</head>
<body>

<?php
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_toolsAdmin.php' ) ; load() ; }

include('headerAdmin.php');

# Open database connection.
require ( 'connect_db.php' ) ;

$q = "SELECT * FROM movie" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
    echo '<div class="container"><span style="color:white">
			<div class="table-responsive">
				<table class="table table-hover table-dark">
				<thead style="background-color: darkred">
				<tr>
				<h3>Delete Movies Panel</h3>
				<button type="button" class="btn btn-warring btn-outline-danger btn-block" data-toggle="modal" data-target="#deleteMovie">
		<i class="fa fa-edit"></i>  Delete Movie </button>
				<th scope="col">Movie ID.</th>
				<th scope="col">Movie Title</th>
				<!--<th scope="col">Info</th>
				<th scope="col">Poster</th>
				<th scope="col">Preview</th>
				<th scope="col">Release Date</th>
				<th scope="col">Language</th>
				<th scope="col">Duration</th>
				<th scope="col">Season/Episode</th>-->
				<th scope="col">Category</th>
				</tr>
				</thead>
				</span>';

    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
    {
        echo '	<tbody><span style="color:white ">
			<tr>
			<td>' . $row['id'] . '</td>
			<td>' . $row['movie_title'] . '</td>
			<!--<td>' . $row['further_info'] . '</td>
			<td>' . $row['img'] . '</td>
			<td>' . $row['preview'] . '</td>
			<td>' . $row['release_date'] . '</td>
			<td>' . $row['mlanguage'] . '</td>
			<td>' . $row['duration'] . '</td>
			<td>' . $row['season_episode'] . '</td>-->
			<td>' . $row['cat'] . '</td>

';
    }
    echo '</tr>
  </tbody>
  </table></div></div> ';
    # Close database connection.
    mysqli_close( $link ) ;
}

?>

<!--#MODAL window add new movie-->
<div class="modal fade" id="deleteMovie" tabindex="-1" role="dialog" aria-labelledby="deleteMovie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalCenterTitle">Delete Movie</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="delete-movie.php" method="post">
                    <div class="form-group">
                        <label>
                            <input type="number"
                                   name="id"
                                   class="form-control"
                                   placeholder="Confirm movie ID"
                                   value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"
                                   required>
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit"
                           name="btnChangeCard"
                           class="btn btn-dark btn-lg btn-block" value="Delete Movie"/>
                </div>
            </div>
        </div><!--Close body-->
    </div><!--Close modal-body-->
</div><!-- Close modal-fade-->

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
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