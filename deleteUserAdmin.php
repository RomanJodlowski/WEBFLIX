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



# Retrieve items from 'users' database table.
$q = "SELECT * FROM users";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

        echo '<div class="container"><span style="color:white">
			<div class="table-responsive">
				<table class="table table-hover table-dark">
				<thead style="background-color: darkred">
				<tr>
				<h3>Delete User Panel</h3>
				<button type="button" class="btn btn-warring btn-outline-danger btn-block" data-toggle="modal" data-target="#deleteUser">
		<i class="fa fa-edit"></i>  Delete User </button>
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
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalCenterTitle">Delete User</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="delete-user.php" method="post">
                    <div class="form-group">
                        <label>
                            <input type="number"  name="user_id"
                                   class="form-control"
                                   placeholder="Confirm User ID"
                                   value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>"
                                   required>
                        </label>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="submit"
                           name="btnChangeCard"
                           class="btn btn-dark btn-lg btn-block" value="Delete User"/>
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