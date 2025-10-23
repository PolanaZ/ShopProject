<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
    <title>Sklep</title>
</head>
<body>
    <section id = 'topS'>
        <div>
            <?php
            session_start();
                if(empty($_SESSION['userName'])){
                    echo "<a href = 'login.php'>Zaloguj się</a>";
                } else {
                    echo "<a href = 'logout.php' onclick='session_destroy()'>Wyloguj się</a>";
                } 
            ?>
        </div>
        <div>
            <?php
                if(empty($_SESSION['userName'])){
                    echo "Nie zalogowano";
                } else {
                    echo $_SESSION['userName']." zalogowano";
                }  
            ?>
        </div>
        <div>
            <a href="cart.php">koszyk</a>
        <div>
    </section>
    <header>
        <h1>Music Shop</h1>
    </header>
    <nav>

    </nav>
    <main>
    <?php
    
        $mysqli = mysqli_connect("localhost","root","","music_shop");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        } else {
            
            $zapytanie = "SELECT * FROM musicsale";
			$wynik = mysqli_query($mysqli,$zapytanie);
            while ($wiersz = mysqli_fetch_row($wynik)){
                if($wiersz[4]!=null){
                    echo "<div class='product'><img src='".htmlspecialchars($wiersz[4])."'><div><h3>".htmlspecialchars($wiersz[1])."</h3><h5>".htmlspecialchars($wiersz[2])."</h5><p>Cena: ".htmlspecialchars($wiersz[7])."zł</p><br><button class='play' id='play".htmlspecialchars($wiersz[0])."' onclick='playPauseState(".json_encode($wiersz[3]).",".json_encode($wiersz[5]).",".json_encode($wiersz[6]).",this.id)'></button><form method='post'><input type='submit' name='tocart".$wiersz[0]."'value='Do koszyka'/></form></div></div>";
                } else {
                    echo "<div class='product'><img src='Images/default.png'><div><h3>".htmlspecialchars($wiersz[1])."</h3><h5>".htmlspecialchars($wiersz[2])."</h5><p>Cena: ".htmlspecialchars($wiersz[7])."zł</p><br><button class='play' id='play".htmlspecialchars($wiersz[0])."' onclick='playPauseState(".json_encode($wiersz[3]).",".json_encode($wiersz[5]).",".json_encode($wiersz[6]).",this.id)'></button><form method='post'><input type='submit' name='tocart".$wiersz[0]."'value='Do koszyka'/></form></div></div>";
                }
            }
        }
    ?>
    </main>
    <aside>

    </aside>
    <section id = 'downS'>

    </section>
    <footer>

    </footer>
    <?php
    if (empty($_SESSION['Cart'])){
        $produkty= array();
    } else {
        $produkty= $_SESSION['Cart'];
    }
    
    $zapytanie = "SELECT * FROM musicsale";
	$wynik = mysqli_query($mysqli,$zapytanie);
    while ($wiersz = mysqli_fetch_row($wynik)){
        if(isset($_POST["tocart".$wiersz[0]])){
            $produkty[] = $wiersz[0];
            echo "In";
        }
    }

    $_SESSION['Cart'] = $produkty;

    mysqli_close($mysqli);
    ?>
</body>
</html>