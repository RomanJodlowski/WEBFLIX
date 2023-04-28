<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>newsletterindex</title>
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head>

<body>
    <div class="container">

        <header>
            <h1>NEWSLETTER!</h1>
        </header>
            <article>
			
<!--				<div class="partL">-->
<!--					-->
<!--					<img class="cover" src="image/logo.jpg" alt="">-->
<!--					-->
<!--				</div>-->
				
				<div class="partR">
				
					<p class="content">Have newsletter!</p>
					
					<form method="post" action="newsletter.php">
					
						<label>Enter an email address:
							<input type="email" name="email" <?= isset($_SESSION['given_email']) ? 'value="' . $_SESSION['given_email'] . '"' : '' ?>>
						</label>
						<input type="submit" value="Excellent send me!">
						
						<?php

						if (isset($_SESSION['given_email'])) {
							echo '<p>Enter correct an email address!</p>';
							unset($_SESSION['given_email']);
						}
						?>
					
					</form>

				</div>	

				<div style="clear:both"></div>
				
            </article>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script
</body>
</html>