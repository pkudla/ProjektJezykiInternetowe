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

// sprawdzam czy jest przekazany identyfikator produktu (odpowiadajacy strona_id w bazie danych)
if(
	isset($_GET['id_product'])
	&&
	(int)$_GET['id_product'] > 0
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
	$sql = "SELECT * FROM product WHERE id_product = '" . $_GET['id_product'] . "'";

	$result = $polaczenie->query($sql);	
	$site = $result->fetch_assoc();
	
	if(!isset($site))
	{
		header("Location: zarzadzanieProdukty.php");
		exit;
	}

	if($_GET['akcja'] == "edytuj")
	{
		if(isset($_POST) && !empty($_POST))
		{		
			$bledy = array();
	
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
				UPDATE
					product
				SET
					nazwa = '" . $_POST['product_nazwa'] . "',
					rozmiar = '" . $_POST['product_rozmiar'] . "',
					material = '" . $_POST['product_material'] . "',
					opis = '" . $_POST['product_tresc'] . "',
					sciezka = '" . $zdjecie . "'
				WHERE
					id_product = '" . $_GET['id_product'] . "'
				";
	
				$result = $polaczenie->query($sql);		
				
				/*
				$site['nazwa'] = $_POST['product_nazwa'];
				$site['rozmiar'] = $_POST['product_rozmiar'];
				$site['material'] = $_POST['product_material'];
				$site['opis'] = $_POST['product_tresc'];
				*/
				
				header('Location: zarzadzanieProdukty.php');
				exit;			
			}
		}
	}
	else if($_GET['akcja'] == "usun")
	{
		$sql = "DELETE FROM product WHERE id_product = '" . $_GET ['id_product'] . "'";
		
		$result = $polaczenie->query($sql);
		header('Location: zarzadzanieProdukty.php');
		exit;		
	}
}
else
{
	// nie ma - pobieram wszystkie strony
	$sql = "SELECT * FROM product";
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
    <link rel="stylesheet" href="css/style-panel.css" type="text/css" />
    <link rel="stylesheet" href="css/fontello.css" type="text/css" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <script src="js/ckeditor/ckeditor.js"></script>    
    <title>Panel logowania</title>
</head>
 	<body>
 		<?php
 		require_once 'inc/menu.php';
 		?>

	    <div class="right">
	    	<?php 
	    	if(
    			isset($_GET['id_product'])
    			&&
    			(int)$_GET['id_product'] > 0
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
	    		<a class="back" href="zarzadzanieProdukty.php"><i class="icon-level-up"></i>Powrót do listy produktów</a>
	    		<form class="formularz" method="post" action="zarzadzanieProdukty.php?id_product=<?php echo $site['id_product']; ?>&akcja=edytuj" enctype="multipart/form-data">
	    			<label>Nazwa produktu:</label>
	    			<input type="text" name="product_nazwa" value="<?php echo $site['nazwa']; ?>" /></br>
	    			<?php
	    			if(isset($bledy['product_nazwa']))
	    				echo "<span class='error'>" . $bledy['product_nazwa'] . "</span><br />";
	    			?>	    	    			
	    			<label>Rozmiar produktu:</label>
	    			<input type="text" name="product_rozmiar" value="<?php echo $site['rozmiar']; ?>" /></br>
	    			<label>Materiał z którego został wykonany produktu:</label>
	    			<input type="text" name="product_material" value="<?php echo $site['material']; ?>" />
					<textarea name="product_tresc" ><?php echo $site['opis']; ?></textarea>
					<script type="text/javascript">
	                //<![CDATA[
	                CKEDITOR.replace( 'product_tresc', {

	                    }
	                );
	                //]]>
	                </script>	  
	                <?php
	                if($site['sciezka'] != "")
	                {
	                	?>
	                	Aktualne zdjęcie:</br> <img src="../upload/<?php echo $site['sciezka']; ?>" alt="" /></br>
	                	<?php 	
	                }
	                ?>    	
	                
	                <label>Załaduj nowe zdjęcie</label></br>
	                <input type="file" name="zdjecie"><br />
	    			<?php
	    			if(isset($bledy['product_zdjecie']))
	    				echo "<span class='error'>" . $bledy['product_zdjecie'] . "<br />";
	    			?>	  	             	                		
	    			<input type="submit" />
	    		</form>
	    		<?php
	    	}
	    	else
	    	{
		    	?>
                <a class="new" href="dodawanieProduktu.php"><i class="icon-plus-circled"></i>Dodaj nowy produkt</a>    
			   	<div class="information">
		   		<?php 
		   		for($i=0; $i<count($rows); $i++)
		   		{
			   		?>
			   		<div class="box">
			   			<h1><?php echo $rows[$i]['nazwa']?></h1>
			   			<div class="choice">
			   				<a class="edit" href="zarzadzanieProdukty.php?id_product=<?php echo $rows[$i]['id_product']; ?>&akcja=edytuj">edytuj</a>
			   				<a class="delete" href="zarzadzanieProdukty.php?id_product=<?php echo $rows[$i]['id_product']; ?>&akcja=usun">usuń</a>
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