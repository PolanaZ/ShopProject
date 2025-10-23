<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body style = 'background-color:#c8d2ce;'>
    <div class = 'login'>
        <h1>Koszyk</h1>
        <?php

        session_start();
        $produkty = $_SESSION['Cart'];
        $cena = 0;

        $mysqli = mysqli_connect("localhost","root","","music_shop");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        } else {
			$zapytanie = "SELECT * FROM musicsale";
			$wynik = mysqli_query($mysqli,$zapytanie);
			while ($wiersz = mysqli_fetch_row($wynik)){
                if(isset($_POST["object".$wiersz[0]])){
                    array_splice($_SESSION['Cart'], $wiersz[0], 1);
                }
                $produkty = $_SESSION['Cart'];
                foreach ($produkty as $check){
                    if($check == $wiersz[0]){
                        echo "<p>".$wiersz[1].", cena: ".$wiersz[7]." zł <form method='post'><input type='submit' name='object".$wiersz[0]."'value='Do koszyka'/></form></p>";
                        $cena+=(float) $wiersz[7];
                    }
                }
			};
        } 


        echo "<p> suma: ".$cena." </p>";
        mysqli_close($mysqli);

        ?>
        <a href = 'home.php'>Powrót</a>
    </div>
</body>
</html>