<?php
#check form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    #connect to database
    require ('connect_db.php');
    $errors = array();
    #check for first name
    if (empty($_POST['first_name'])) {
        $errors[] = 'Enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
    }
    #check for last name
    if (empty($_POST['last_name'])) {
        $errors[] = 'Enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
    }
    #check for an email
    if (empty($_POST['email'])) {
        $errors[] = 'Enter your email';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }
    #check for DOB
    if (empty($_POST['d_o_b'])) {
        $errors[] = 'Enter your D.O.B.';
    } else {
        $dob = mysqli_real_escape_string($link, trim($_POST['d_o_b']));
    }
    #check for contact number
    if (empty($_POST['c_num'])) {
        $errors[] = 'Enter your Contact Number.';
    } else {
        $cn = mysqli_real_escape_string($link, trim($_POST['c_num']));
    }
    #check for country
    if (empty($_POST['country'])) {
        $errors[] = 'Enter your Country.';
    } else {
        $co = mysqli_real_escape_string($link, trim($_POST['country']));
    }
    #check for status
    if (empty($_POST['status'])) {
        $errors[] = 'Enter your Status.';
    } else {
        $st = mysqli_real_escape_string($link, trim($_POST['status']));
    }
    #check for a password and matching input password
    if (!empty($_POST['pass1']))
    {
        if ($_POST['pass1'] != $_POST['pass2'])
        {
            $errors[] = 'Password do not match.';
        }
        else
        {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
    }

    #check if email address already registered
    if (empty($errors))
    {
        $q = "SELECT user_id FROM admin WHERE email='$e'";
        $r = @mysqli_query($link, $q);
        if (mysqli_num_rows($r) != 0) $errors[] = 'Email address already registered.';
    }
    #on success register user inserting into 'user' database table
    if (empty($errors))
    {
        $q = "INSERT INTO admin (first_name, last_name, email, pass, reg_date, d_o_b, c_num, country, status)
 VALUES ('$fn', '$ln', '$e', SHA2('$p', 256), NOW(), '$dob', '$cn', '$co', '$st')";
        $r = @mysqli_query($link, $q);
        if ($r)
        {
//            echo '<p>You are now registered.</p>';
            include("addMovieAdmin.php");
        }
        #close database connection
        mysqli_close($link);
        exit();

    }
    #or report errors
    else
    {
        echo '<h1>Error!</h1><p id="error_msg">The following error (s) occurred:<br>';
        foreach ($errors as $msg)
            {
                echo "-$msg<br>";
            }
            echo 'Please try again.</p></div>';
            #close database connection
            mysqli_close($link);
    }
}
?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
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

<form action="" method="post">
    <div class="container">
        <br>
    <h1>Create Admin Account</h1>
    <br>
    <div class="form-row">
        <div class="form-group col-md-6">
                <input type="text"
                       class="form-control"
                       placeholder="First name"
                       name="first_name"
                       required size="20"
                       value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
        </div>
        <br>
        <hr>
        <div class="form-group col-md-6">
                <input type="text"
                       class="form-control"
                       placeholder="Last name"
                       name="last_name"
                       required size="20"
                       value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
        </div>
        </div>
        <div class="form-row">
        <br>
        <hr>
        <div class="form-group col-md-6">
            <input type="text"
                   class="form-control"
                   placeholder="Date Of Birth"
                   name="d_o_b"
                   required size="20"
                   value="<?php if (isset($_POST['d_o_b'])) echo $_POST['d_o_b']; ?>">
        </div>
        <br>
        <hr>
        <div class="form-group col-md-6">
            <input type="text"
                   class="form-control"
                   placeholder="Contact Number"
                   name="c_num"
                   required size="20"
                   value="<?php if (isset($_POST['c_num'])) echo $_POST['c_num']; ?>">
        </div>
        </div>
        <div class="form-row">
        <br>
        <hr>
        <div class="form-group col-md-6">
            <input type="text"
                   class="form-control"
                   placeholder="Country"
                   name="country"
                   required size="20"
                   value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>">
        </div>
        <br>
        <hr>
        <div class="form-group col-md-6">
                <input type="text"
                       class="form-control"
                       placeholder="Email"
                       name="email"
                       required size="20"
                       value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
        </div>
    </div>
        <div class="form-auto">
            <br>
            <hr>
            <div class="form-group col">
                <input type="text"
                       class="form-control"
                       placeholder="Status"
                       name="country"
                       required size="20"
                       value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>">
            </div>
        <div class="form-row">
    <br>
    <hr>
    <div class="form-group col-md-6">
            <input type="password"
                   class="form-control"
                   placeholder="Create Password"
                   name="pass1"
                   required size="20"
                   value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
    </div>
    <br>
    <hr>
    <div class="form-group col-md-6">
            <input type="password"
                   class="form-control"
                   placeholder="Confirm Password"
                   name="pass2"
                   required size="20"
                   value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
    </div>
    </div>
    <br>
    <hr>
    <br>
        <!-- submission button -->
        <input class="btn btn-outline-success btn-lg btn-block" type="submit" value="Create Account">
        <br>
        <br>
        <a href="addMovieAdmin.php" type="button" class="btn btn-outline-light">Go Back</a>
    </div>
</form>
<br>
</body>
</html>