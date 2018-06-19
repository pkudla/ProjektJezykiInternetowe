<?php
require("../config/config.php");
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'])
{
	header("Location: panel.php");
	exit;
}
require("inc/zaloguj.php");
?>
<html lang="pl">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:300,400,700,800,900&amp;subset=latin-ext" rel="stylesheet">
    <title>Panel logowania</title>
</head>
    <body>
        <div class="logo"><a href="#"><picture><img src="img/footer-logo.svg" alt=""/></picture></a></div>
        <div class="panel">
                <h1>Zaloguj</h1>
            <div class="logowanie">
		        <form method="post" action="index.php">
                 <fieldset>
                 	 <input type="text" name="login" placeholder="Login" />
                     <input type="password" name="pass" placeholder="Hasło" />
                     <?php
                     if(isset($_SESSION['badpass']))
                         echo $_SESSION['badpass'];
                     ?>
                     <input type="submit" value="Zaloguj" /><br>
               	 </fieldset>
		        </form>
            </div>
        </div>
    </body>
</html>