<?php 
if(isset($_POST) && !empty($_POST))
{
	$login = $_POST['login'];
	$haslo = $_POST['pass'];
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error ".$polaczenie->connect_errno;
	}
	else
	{
		$sql = "SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";
		
		if ($rezultat = $polaczenie->query($sql))
		{
			$ilu_userow = $rezultat->num_rows;
					
			if($ilu_userow > 0) {
				$_SESSION['zalogowany'] = true;
				$wiersz = $rezultat->fetch_assoc();
				$_SESSION['user'] = $wiersz['user'];
				// unset($_SESSION['badpass']);
	
				$rezultat->free_result();
				header('Location: panel.php');
				exit;
			} else {
				$_SESSION['badpass'] = '<span style="color: red; margin-bottom: 10px; display: block;">Nieprawidłowy login lub hasło! </span>';
				// header('Location: index.php');
			}
		}
		$polaczenie->close();
	}
}
?>