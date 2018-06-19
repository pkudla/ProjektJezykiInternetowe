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

$bledy = array();
$zdjecie = "";

if(isset($_POST) && !empty($_POST))
{	
	if(!$_POST['product_nazwa'] != "")
		$bledy['product_nazwa'] = "To pole nie zostało uzupełnione.";

	if(isset($_FILES['zdjecie']) && $_FILES['zdjecie']['name'] != "")
	{
		$target_dir = "../upload/";
		$target_file = $target_dir . basename($_FILES["zdjecie"]["name"]);
		$uploadOk = 1;
		
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if (file_exists($target_file)) {
			$bledy['product_zdjecie'] = "Taki plik już istnieje.";
			$uploadOk = 0;
		}

		if ($uploadOk == 1) {
			if (!move_uploaded_file($_FILES["zdjecie"]["tmp_name"], $target_file)) {
				echo "Plik nie został załadowany.";
			}
			else
			$zdjecie = $_FILES["zdjecie"]["name"];
		}	
	}
		
	if(empty($bledy))
	{
		$sql = "
		INSERT INTO
			product
			(nazwa, rozmiar, material, opis, sciezka) 
		VALUES 
			(
				'" . $_POST['product_nazwa'] . "',
				'" . $_POST['product_rozmiar'] . "',
				'" . $_POST['product_material'] . "',
				'" . $_POST['product_tresc'] . "',
				'" . $zdjecie . "'				
			)
		";	
		$result = $polaczenie->query($sql);
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
	    		<a class="back" href="zarzadzanieProdukty.php"><i class="icon-level-up"></i>Anuluj dodawanie produktu</a>
	    		<form class="formularz" method="post" action="dodawanieProduktu.php" enctype="multipart/form-data">
	    			<label>Nazwa produktu:</label>
	    			<input type="text" name="product_nazwa" value="" /></br>
	    			<?php
	    			if(isset($bledy['product_nazwa']))
	    				echo "<span class='error'>" . $bledy['product_nazwa'] . "<br />";
	    			?>	    			
	    			<label>Rozmiar produktu:</label>
	    			<input type="text" name="product_rozmiar" value="" /></br>
                    <?php
                    if(isset($bledy['product_nazwa']))
                        echo "<span class='error'>" . $bledy['product_nazwa'] . "<br />";
                    ?>
                    <label>Materiał z którego został wykonany produktu:</label>
	    			<input type="text" name="product_material" value="" /></br>
                    <?php
                    if(isset($bledy['product_nazwa']))
                        echo "<span class='error'>" . $bledy['product_nazwa'] . "<br />";
                    ?>
                    <textarea name="product_tresc" ></textarea>
					<script type="text/javascript">
	                //<![CDATA[
	                CKEDITOR.replace( 'product_tresc', {

	                    }
	                );
	                //]]>
	                </script>	    
	                <label>Zdjęcie</label>
	                <input type="file" name="zdjecie"><br />
	    			<?php
	    			if(isset($bledy['product_zdjecie']))
	    				echo "<span class='error'>" . $bledy['product_zdjecie'] . "<br />";
	    			?>	  	                				    			
	    			<input type="submit" value="Dodaj" />
	    		</form>
			   	<div class="information">

		   		</div>
	    </div>
    </body>
</html>