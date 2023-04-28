<?php
session_start();
include('header1.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>read change password</title>
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head>

<body>
<div class="container">
<br>
    <hr>
    <br>
    <header>
        <h1>Change Password</h1>
    </header>
    <article>
<br>
        <hr>
        <br>
        <div class="container">
            <form method="post" action="forgot-password.php">
                    <input type="text" id="data" placeholder="Email address" class="" name="data">
                <br>
                <br>
                <button type="submit" class="btn btn-outline-warning">Enter</button>
            </form>
        </div>
<br>
        <hr>
        <br>
    </article>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script
</body>
</html>
