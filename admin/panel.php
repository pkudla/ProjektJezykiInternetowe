<?php
require("../config/config.php");
if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany'])
{
	header("Location: index.php");
	exit;
}
?>
<html lang="pl">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style-panel.css" type="text/css" />
    <link rel="stylesheet" href="css/fontello.css" type="text/css" />
    
    <title>Panel logowania</title>
</head>
    <body>
 		<?php
 		require_once 'inc/menu.php';
 		?>	
 		<div class="right" style="float:left; width:500px; height:100vh;">
            <p style="margin:20px">Witaj w panelu CMS, który został stworzony na potrzeby projektu. <br> Autor <strong>Patryk Kudła</strong></p>
 		</div>
    </body>
</html>