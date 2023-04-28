<?php # DISPLAY COMPLETE LOGIN PAGE.
# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
    echo '<p id="err_msg">Oops! There was a problem:<br>' ;
    foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
    echo 'Please try again or <a href="register.php">Register</a></p>' ;
}
?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Register form</title>
</head>
<body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<form action="login_action.php" method="post">
    <div class="container">
        <br>
        <h1>Login</h1>
        <br>
        <div class="row align-items-start">
            <div class="col-sm">
                <input type="text"
                       class="form-control"
                       placeholder="Email address"
                       name="email"
                       required size="20"
                       value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            </div>
            <hr>
            <div class="col-sm">
                <input type="password"
                       class="form-control"
                       placeholder="Password"
                       name="pass"
                       required size="20"
                       value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
            </div>
        </div>
        <br>
        <hr>
        <br>
        <!-- submission button -->
        <input class="btn btn-outline-success btn-lg btn-block" type="submit" value="Login">
        <br>
        <h3>Or Register</h3>
        <br>
        <a href="register.php" role="button" type="button" class="btn btn-outline-warning btn-lg btn-block">Register</a>
           <br>
        <br>
        <a href="index1.php" type="button" class="btn btn-outline-light">Go Back</a>
        <a href="readforgotpassword.php" type="button" class="btn btn-outline-light">Forgot password</a>
    </div>
</form>
<br>
</body>
</html>