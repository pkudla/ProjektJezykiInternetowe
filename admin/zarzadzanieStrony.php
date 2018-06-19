<?php
require("../config/config.php");
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'])
{
	header("Location: panel.php");
	exit;
}
require("inc/zaloguj.php");
?>