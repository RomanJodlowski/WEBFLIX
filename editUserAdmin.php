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

<!--    <style>-->
<!--        body {font-family: Arial, Helvetica, sans-serif;-->
<!--        }-->
<!---->
<!--        /* The Modal (background) */-->
<!--        .modal {-->
<!--            display: none; /* Hidden by default */-->
<!--            position: fixed; /* Stay in place */-->
<!--            z-index: 1; /* Sit on top */-->
<!--            padding-top: 100px; /* Location of the box */-->
<!--            left: 0;-->
<!--            top: 0;-->
<!--            width: 100%; /* Full width */-->
<!--            height: 100%; /* Full height */-->
<!--            overflow: auto; /* Enable scroll if needed */-->
<!--            background-color: rgb(0,0,0); /* Fallback color */-->
<!--            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */-->
<!--        }-->
<!---->
<!--        /* Modal Content */-->
<!--        .modal-content {-->
<!--            background-color: #fefefe;-->
<!--            margin: auto;-->
<!--            padding: 20px;-->
<!--            border: 1px solid #888;-->
<!--            width: 80%;-->
<!--        }-->
<!---->
<!--        /* The Close Button */-->
<!--        .close {-->
<!--            color: #aaaaaa;-->
<!--            float: right;-->
<!--            font-size: 28px;-->
<!--            font-weight: bold;-->
<!--        }-->
<!---->
<!--        .close:hover,-->
<!--        .close:focus {-->
<!--            color: #000;-->
<!--            text-decoration: none;-->
<!--            cursor: pointer;-->
<!--        }-->
<!--    </style>-->

</head>
<body>

<?php
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_toolsAdmin.php' ) ; load() ; }
# Open database connection.
require ( 'connect_db.php' ) ;

include ('headerAdmin.php');

//$q = "SELECT * FROM users" ;
//$r = mysqli_query( $link, $q ) ;
//if ( mysqli_num_rows( $r ) > 0 ) {
//    echo '
//	<div class="container">
//	  <div class="row">
//  ';
//
//    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
//        echo '
//	<div class="col-sm">
//	  <div class="alert alert-danger" alert-dismissible fade show" role="alert">
//		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
//		  <span aria-hidden="true">&times;</span>
//		</button>
//	  <h1 style="color: darkred">' . $row['first_name'] . ' ' . $row['last_name'] . '<strong>  </h1>
//	  <hr>
//	  <p style="color: darkred"><strong> User ID : EC2021 ' . $row['user_id'] . ' </strong></p>
//	  <p style="color: darkred"><strong> Email : </strong> ' . $row['email'] . ' </p>
//	  <p style="color: darkred"><strong> Registration Date : </strong> ' . $row['reg_date'] . ' </p>
//	  <hr>
//	  <!-- Button trigger modal -->
//	<button type="button" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#password">
//		<i class="fa fa-edit"></i>  Change Password</button>
//	 </div>
//    </div>
//	';
//    }
//    #Close database connection.
//    #mysqli_close($link);
//}
//else {
//    echo '<h3>No user details.</h3>
//
//';
//}

# Retrieve items from 'users' database table.
$q = "SELECT * FROM users";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

        echo '<div class="container"><span style="color:white">
			<div class="table-responsive">
				<table class="table table-hover table-dark">
				<thead style="background-color: darkred">
				<tr>
				<h3>Edit User Panel</h3>
				<br>
				<p><em>Active user = subscribed</em></p>
				<p><em>Inactive user = unsubscribed</em></p>
				<p><em>Blocked user = blank field</em></p>
				<br>
				<button type="button" class="btn btn-warring btn-outline-danger btn-block" data-toggle="modal" data-target="#card">
		<i class="fa fa-edit"></i>  Change User Status </button>
				<th scope="col">User ID.</th>
				<th scope="col">User First Name</th>
				<th scope="col">User Last Name</th>
				<!--<th scope="col">Poster</th>
				<th scope="col">Preview</th>
				<th scope="col">Release Date</th>
				<th scope="col">Language</th>
				<th scope="col">Duration</th>
				<th scope="col">Season/Episode</th>-->
				<th scope="col">User Status</th>
				</tr>
				</thead>
				</span>';

        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
            echo '	<tbody><span style="color:white ">
			<tr>
			<td>' . $row['user_id'] . '</td>
			<td>' . $row['first_name'] . '</td>
			<td>' . $row['last_name'] . '</td>
			<!--<td>' . $row['img'] . '</td>
			<td>' . $row['preview'] . '</td>
			<td>' . $row['release_date'] . '</td>
			<td>' . $row['mlanguage'] . '</td>
			<td>' . $row['duration'] . '</td>
			<td>' . $row['season_episode'] . '</td>-->
			<td>' . $row['status'] . '</td>

';
        }
        echo '</tr>
  </tbody>
  </table></div></div> ';
        # Close database connection.
        mysqli_close( $link ) ;
    }

# Display home section.
?>

<!--#MODAL window card-->
<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="card" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle">Change User Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="change-user.php" method="post">
                    <div class="form-group">
                        <label>
                            <input type="number"  name="user_id"
                                   class="form-control"
                                   placeholder="Confirm User ID"
                                   value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>"
                                   required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="text"
                                   name="status"
                                   class="form-control"
                                   placeholder="User Status"
                                   value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>"
                                   required>
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit"
                           name="btnChangeCard"
                           class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
                </div>
            </div>
        </div><!--Close body-->
    </div><!--Close modal-body-->
</div><!-- Close modal-fade-->

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