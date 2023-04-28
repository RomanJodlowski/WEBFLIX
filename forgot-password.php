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
    <title>user</title>

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
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { load() ; }

include('header1.php');

# Open database connection.
require ( 'connect_db.php' ) ;

header('Location: readforgotpassword.php');
$data = $_POST['data'];

$q = "SELECT * FROM users WHERE email= '$data'" ;

$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 ) {
    echo '
	<div class="container">
	<br>
	  <div class="row">
  ';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
	<div class="col-sm">
	  <div class="alert alert-danger" alert-dismissible fade show" role="alert">
	  <p style="color: darkred"><strong> Email : </strong> ' . $row['email'] . ' </p>
	  <br>
	  <!-- Button trigger modal -->
	<button type="button" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#password">
		<i class="fa fa-edit"></i>  Change Password
	</button>
	<br>
	 </div>
	 <br>
    </div>
	';
    }
    #Close database connection.
    #mysqli_close($link);
}
else {
    echo '<h3>No user details.</h3>

';
}

# Display home section.


?>

<!--#MODAL window password-->
<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="change-forgotpassword.php" method="post">
                    <div class="form-group">
                        <label>
                            <input type="email"  name="email"
                                   class="form-control"
                                   placeholder="Confirm Email"
                                   value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
                                   required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="password"
                                   name="pass1"
                                   class="form-control"
                                   placeholder="New Password"
                                   value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"
                                   required>
                        </label>
                    </div>
                    <!--                    Now add a form group to confirm new password.-->
                    <div class="form-group">
                        <label>
                            <input type="password"
                                   name="pass2"
                                   class="form-control"
                                   placeholder="Confirm New Password"
                                   value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"
                                   required>
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit"
                           name="btnChangePassword"
                           class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
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

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
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