<?php
require_once("config/config.php");
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

$polaczenie->query('SET character_set_connection=utf8');
$polaczenie->query('SET character_set_client=utf8');
$polaczenie->query('SET character_set_results=utf8');

$sql = "SELECT * FROM product WHERE id_product = " . $_GET['id'] . " ";

$result = $polaczenie->query($sql);
$rowProduct = $result->fetch_assoc();

/*
$sql2 = "SELECT * FROM image WHERE id_product = " . $_GET['id'] . " ";
$result = $polaczenie->query($sql2);

while($row = $result->fetch_assoc())
{
	$images[] = $row;
}
*/
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Stalowe JL</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/siatka.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:300,400,700,800,900&amp;subset=latin-ext" rel="stylesheet">
    <link rel="Shortcut icon" href="#" />
    <script>var stronaAdres = '';</script>
</head>
<body>
<header class="topbar">
    <div class="container">
        <a href="index.php" class="logo transitionopacity"><picture><img src="img/svg/footer-logo.svg" alt=""></picture></a>
        <div class="burgermenu"></div>
        <nav class="navbar">
            <ul><li><a class="transitionopacity" href="index.php">O Firmie</a></li><li><a class="transitionopacity active" href="products.php">Produkty</a></li><li><a class="transitionopacity" href="index.php#contact">Kontakt</a></li></ul>
        </nav>
    </div>
</header>
<section class="header gray">
    <div class="container">
        <h1><?php echo $rowProduct['nazwa']; ?></h1>
    </div>
</section>
<?php 


?>
<?php 
 		$sql = "
			SELECT
				*
			FROM
				product
			ORDER BY
				id_product desc
		";
 		
        $result = $polaczenie->query($sql);
        
        $rows = array();
		while($row = $result->fetch_array())
		{
			$rows[] = $row;
		}
        ?>
<section class="main">
    <div class="container">
    	<?php 
    	/*
    	?>
        <div class="row row100">
        	<?php 
        	for($i=0; $i<count($images); $i++)
        	{
        	?>
            <div class="col col3">
                <picture><a href="#"><img class="transitionopacity" src="img/<?php echo $images[$i]['sciezka']; ?>" alt="" /></a></picture>
            </div>
            <?php 
        	}
        	?>
            <div class="col col3">
                <figure><a href="#"><img class="active" src="img/svg/nav-icon-right.svg" alt="" /></a></figure>
                <figure><a href="#"><img src="img/svg/nav-icon-left.svg" alt="" /></a></figure>
            </div>
        </div>
        */
    	?>
        <div class="row row50">
            <div class="col col6">
                <picture><a href="#"><img class="transitionopacity" src="upload/<?php echo $rowProduct['sciezka']; ?>" alt=""/></a></picture>
            </div>
            <div class="col col6">
                <h2><?php echo $rowProduct['nazwa']; ?></h2>
                <span><?php echo $rowProduct['rozmiar'];?></span>
                <p><?php echo $rowProduct['opis'];?></p>
                <div class="button"><a class="transitionopacity" href="index.php?id=<?php echo $rowProduct['id_product']; ?>#contact"><span>Zamów</span>online</a></div>
            </div>
        </div>
    </div>
</section>
<section class="partners">
    <div class="container">
        <div class="row row50">
            <div class="col col3">
                <picture><a href="#"><img class="transitionopacity" src="img/footer-ue-1.png" alt="" /></a></picture>
            </div>
            <div class="col col3">
                <picture><a href="#"><img class="transitionopacity" src="img/footer-ue-2.png" alt="" /></a></picture>
            </div>
            <div class="col col3">
                <picture><a href="#"><img class="transitionopacity" src="img/footer-ue-3.png" alt="" /></a></picture>
            </div>
            <div class="col col3">
                <picture><a href="#"><img class="transitionopacity" src="img/footer-ue-4.png" alt="" /></a></picture>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row row5">
            <div class="col col6">
                <p>Stalowe JL &copy; 2018</p>
            </div>
            <div class="col col6 right">
                <p>Realizacja: <a href="#" class="transitionopacity" title="Patryk Kudła">Kudla</a></div>
        </div>
    </div>
</footer>
</body>
</html>