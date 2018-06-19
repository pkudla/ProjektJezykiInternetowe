<?php
require_once("config/config.php");
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

$polaczenie->query('SET character_set_connection=utf8');
$polaczenie->query('SET character_set_client=utf8');
$polaczenie->query('SET character_set_results=utf8');

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Stalowe</title>
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
            <ul>
            <li><a class="transitionopacity" href="index.php">O Firmie</a></li><li><a class="transitionopacity active" href="products.php">Produkty</a></li><li><a class="transitionopacity" href="index.php#contact">Kontakt</a></li>
            </ul>
        </nav>
    </div>
</header>
<section class="header gray">
    <div class="container">
        <h1>Produkty</h1>
    </div>
</section><?php 
 		$sql = "SELECT * FROM product ORDER BY id_product desc";
        $result = $polaczenie->query($sql);
        
        $rows = array();
		while($row = $result->fetch_array())
		{
			$rows[] = $row;
		}
        ?>
<section class="offer">
    <div class="container">
        <div class="row row120">
        	<?php
        	for($i=0; $i<count($rows); $i++)
        	{
        		?>
	            <div class="col col4">
	                <div class="product transitionbackground">
	                <picture><img src="upload/<?php echo $rows[$i]['sciezka']; ?>" alt=""></picture>
	                    <div class="description">
	                        <span><?php echo $rows[$i]['nazwa']; ?></span>
	                        <p><?php echo $rows[$i]['rozmiar']; ?></p>
	                        <span><?php echo $rows[$i]['material']; ?></span>
	                        <span class="show">Zobacz</span>
	                    </div>
	                    <a href="product.php?id=<?php echo $rows[$i]['id_product']; ?>"></a>
	                </div>
	            </div>        		
        		<?php         		
        	}
        	?>
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
                <p>Realizacja: <a href="#" class="transitionopacity" title="Kudła">Kudla</a></div>        </div>
    </div>
</footer>
</body>
</html>