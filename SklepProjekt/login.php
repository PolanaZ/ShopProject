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
        <h1>Zaloguj się</h1>
        <form action='login.php' method='post'>
            Nazwa konta <input type='text' name='nazwa'><br><br>
            Hasło <input type='password' name='haslo'><br><br><br><br>
            <input type='submit' value='Zaloguj'>
            <input type='reset' value='Wyczyść'><br><br>
            <p id='anwser'></p>
        </form>
        <a href = 'registration.php'>Zarejestruj się</a>
        <a href = 'home.php'>Powrót</a>
    </div>
<?php
    if(empty($_POST['haslo'])){
        echo "zaloguj się";
    } else{
        $mysqli = mysqli_connect("localhost","root","","music_shop");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        } else {
            global $login, $haslo;
            $login = $_POST["nazwa"];
			$haslo = $_POST["haslo"];
			$zapytanie = "SELECT * FROM konta";
			$wynik = mysqli_query($mysqli,$zapytanie);
			while ($wiersz = mysqli_fetch_row($wynik))
			{
				if ($wiersz[1] == $login) {
					if ($wiersz[2] == $haslo) {
                        session_start();
                        $_SESSION['userName'] = $login;
						header("Location: home.php");
                        mysqli_close($mysqli);
						exit();
					}
				}
			};
        } 
        mysqli_close($mysqli);
    }

?>
</body>
</html>