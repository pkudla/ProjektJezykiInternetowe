<?php
if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'])
{
	header("Location: panel.php");
	exit;
}
?>