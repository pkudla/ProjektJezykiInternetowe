<?php
require_once("config/config.php");
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

$polaczenie->query('SET character_set_connection=utf8');
$polaczenie->query('SET character_set_client=utf8');
$polaczenie->query('SET character_set_results=utf8');

if(isset($_GET['id']))
{
	$sql = "SELECT * FROM product WHERE id_product = " . $_GET['id'] . " order by id_product desc";
	$result = $polaczenie->query($sql);
	$rowProduct = $result->fetch_assoc();
}
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
            			<li><a class="transitionopacity active" href="index.php">O Firmie</a></li><li><a class="transitionopacity" href="products.php">Produkty</a></li><li><a class="transitionopacity" href="index.php#contact">Kontakt</a></li></ul>
                </nav>
            </div>
        </header>
        <section class="welcome">
            <div class="container">            
                <div class="slider">
                    <ul class="content">
                        <li>
                           <picture>
                                <img src="img/front-dummy-image.jpg" alt="" />
                            </picture>
                        </li>
                    </ul>
                    <div class="sliderText">
                        <h1>Nowoczesne Meble</h1>
                        <p>oraz inne obiekty do urządzania i wyposażania domu</p>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        $sql = "SELECT * FROM strony WHERE strona_id = 1";
        $result = $polaczenie->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <section class="aboutUs">
            <div class="container">
                <div class="row row100">
                    <div class="col col4">                   
                        <h2><?php echo $row['strona_nazwa']; ?></h2>
                    </div>
                    <div class="col col8">
                    	<?php echo $row['strona_tresc']?>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        $sql = "SELECT * FROM strony WHERE strona_id = 2";
        $result = $polaczenie->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <section class="aboutUs gray">
            <div class="container">
                <div class="row row100">
                    <div class="col col4">
                        <h2><?php echo $row['strona_nazwa']?></h2>
                    </div>
                    <div class="col col8">
						<?php echo $row['strona_tresc']?>
                    </div>
                </div>
            </div>
        </section>
        <?php 

        
        
        $sql2 = "SELECT * FROM product ORDER BY id_product DESC LIMIT 3";
        $result = $polaczenie->query($sql2);
                
        while($row = $result->fetch_assoc())
        {
        	$rowProducts[] = $row;
        }
        $sql = "SELECT * FROM strony WHERE strona_id = 3";
        $result = $polaczenie->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <section class="sectionProduct">
            <div class="container">
                <div class="row row120">
                    <div class="col col4">
                        <h2><?php echo $row['strona_nazwa'];?></h2>
                    </div>
                    <div class="col col8">
                        <div class="row row120">
                         <?php 
        					for($i=0; $i<count($rowProducts); $i++)
        					{
		        					?>
		                            <div class="col col6">
		                                <div class="product transitionbackground">
		                                    <picture><img src="upload/<?php echo $rowProducts[$i]['sciezka'];?>" alt=""></picture>
		                                    <div class="description">
		                                        <span><?php echo $rowProducts[$i]['nazwa'];?></span>
		                                        <p><?php echo $rowProducts[$i]['rozmiar'];?></p>
		                                        <span><?php echo $rowProducts[$i]['material']?></span>
		                                    </div>
                                            <a href="product.php?id=<?php echo $rowProducts[$i]['id_product']; ?>"></a>
		                                </div>
		                            </div>
		                            <?php 
        					}
                            ?>
                            <div class="col col6">
                                <div class="product transitionopacity">
                                    <div class="text">
                                        <p><span>Zobacz</span><br>wszystkie produkty</p>
                                    </div>
                                    <a href="products.php"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
         $sql = "SELECT * FROM strony WHERE strona_id = 4";
         $result = $polaczenie->query($sql);
         $row = $result->fetch_assoc();?>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row row100">
                <div class="col col4">
                    <h2><?php echo $row['strona_nazwa']?></h2>
                    <div class="information">
                        <?php echo $row['strona_tresc']?>
                    </div>
                </div>
                <div class="col col4">
                    <picture><img src="img/maps.png" alt=""></picture>
                </div>
                <div class="col col4">
                    <h3>Napisz do nas</h3>
                    <form>
                        <fieldset>
                            <input type="text" placeholder="Imię i nazwisko" />
                            <input type="text" placeholder="Telefon" />
                            <input type="text" placeholder="E-mail" />
                            <textarea rows="5"><?php if(isset($rowProduct)) echo "Zamawiam produkt " . $rowProduct['nazwa'];?></textarea>
                            <input class="transitionbackground" type="submit" value="Wyślij" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row row5">
                <div class="col col6">
                    <p>Kudla &copy; 2018</p>
                </div>
                <div class="col col6 right">
                    <p>Realizacja: <a href="#" class="transitionopacity" title="Patryk Kudła">Kudla</a></div>
            </div>
        </div>
    </footer>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/zdzislowicz-1.6.js"></script>
    <script src="/js/magnific.js"></script>
    </body>

</html>