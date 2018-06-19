<?php
// zalaczenie pliku konfiguracyjnego
require_once("../config/config.php");

// polaczenie z baza danych
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

// zapytanie do bazy zwiazane ze zmiana kodowania
$polaczenie->query('SET character_set_connection=utf8');
$polaczenie->query('SET character_set_client=utf8');
$polaczenie->query('SET character_set_results=utf8');

// sprawdzenie czy uzytkownik zalogowany
if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany'])
{
	header("Location: index.php");
	exit;
}

// sprawdzam czy jest przekazany identyfikator strony (odpowiadajacy strona_id w bazie danych)
if(
	isset($_GET['id'])
    &&
    (int)$_GET['id'] > 0
    &&
    isset($_GET['akcja'])
    &&
    (
    	$_GET['akcja'] == "usun"
    	||
    	$_GET['akcja'] == "edytuj"
	)
)
{
	// jest
	// pobieram jedną, wybraną stronę
	$sql = "SELECT * FROM strony WHERE strona_id = '" .$_GET['id'] . "'";
	$result = $polaczenie->query($sql);	
	$site = $result->fetch_assoc();

	if(!isset($site))
	{
		header("Location: strony.php");
		exit;
	}	
	
	if($_GET['akcja'] == "edytuj")
	{
		if(isset($_POST) && !empty($_POST))
		{	
			$sql = "
			UPDATE
				strony
			SET
				strona_nazwa = '" . $_POST['strona_nazwa'] . "',
				strona_tresc = '" . $_POST['strona_tresc'] . "'
			WHERE
				strona_id = '" . $_GET['id'] . "'
			";
			$result = $polaczenie->query($sql);		
			
			$site['strona_nazwa'] = $_POST['strona_nazwa'];
			$site['strona_tresc'] = $_POST['strona_tresc'];
		}
	}
	else if($_GET['akcja'] == "usun")
	{
		$sql = "DELETE FROM strony WHERE strona_id = '" . $_GET ['id'] . "'";
		$result = $polaczenie->query($sql);
		header('Location: strony.php');
		
	}
}
else
{
	// nie ma - pobieram wszystkie strony
	$sql = "SELECT * FROM strony";
	$result = $polaczenie->query($sql);
	
	$rows = array();
	while($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
}
?>
<html lang="pl">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style-panel.css" type="text/css" />
    <link rel="stylesheet" href="css/fontello.css" type="text/css" />
    <title>Panel logowania</title>
    <script src="js/ckeditor/ckeditor.js"></script>    
</head>
    <body>
 		<?php
 		require_once 'inc/menu.php';
 		?>
	    <div class="right">
	    	<?php 
	    	if(
    			isset($_GET['id'])
    			&&
    			(int)$_GET['id'] > 0
    			&&
    			isset($_GET['akcja'])
    			&&
    			(
    				$_GET['akcja'] == "usun"
    				||
    				$_GET['akcja'] == "edytuj"
	    		)
	    	)
	    	{
	    		?>
	    		<a class="back" href="strony.php"><i class="icon-level-up"></i>Powrót do listy stron</a>
	    		<form class="formularz" method="post" action="strony.php?id=<?php echo $site['strona_id']; ?>&akcja=edytuj">
	    			<label>Nagłówek</label></br>
	    			<input type="text" name="strona_nazwa" value="<?php echo $site['strona_nazwa']; ?>" />
					<textarea name="strona_tresc" ><?php echo $site['strona_tresc']; ?></textarea>
	                <script type="text/javascript">
	                //<![CDATA[
	                CKEDITOR.replace( 'strona_tresc', {

	                    }
	                );
	                //]]>
	                </script>    				    			
	    			<input type="submit" />
	    		</form>
	    		<?php
	    	}
	    	else
	    	{
		    	?>
			   	<div class="information">
		   		<?php 
		   		for($i=0; $i<count($rows); $i++)
		   		{
			   		?>
			   		<div class="box">
			   			<h1><?php echo $rows[$i]['strona_nazwa']?></h1>
			   			<div class="choice">
				   			<a href="strony.php?id=<?php echo $rows[$i]['strona_id']; ?>&akcja=edytuj">edytuj</a>
				   			<a href="strony.php?id=<?php echo $rows[$i]['strona_id']; ?>&akcja=usun">usuń</a>
			   			</div>
			   		</div>
			   		<?php 
		   		}
		   		?>
		   		</div>
		   		<?php 
	    	}
		   	?>
	    </div>
    </body>
</html>