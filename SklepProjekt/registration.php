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
        <h1>Zarejestruj się</h1>
        <form action='registration.php' method='post'>
            Nazwa konta <input type='text' name='nazwa'><br><br>
            Hasło <input type='password' name='haslo'><br><br><br><br>
            <input type='submit' value='Zarejestruj'>
            <input type='reset' value='Wyczyść'><br><br>
            <p id='anwser'></p>
        </form>
        <a href = 'login.php'>Zaloguj się</a>
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
            $log = $_POST["nazwa"];
            echo $log;
			$haslo = $_POST["haslo"];
            if (isset($log) && $log = "" && isset($haslo) && $haslo = ""){
                exit();
            }
            else {
                $zapytanie = "INSERT INTO konta (login, haslo) VALUES ('".$_POST["nazwa"]."','".$haslo."')";
                if (mysqli_query($mysqli, $zapytanie)) {
                    echo "New record created successfully";
                    // header("Location: log.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($mysqli);
			    exit();
            }
        } 
        mysqli_close($mysqli);
    }

?>
</body>
</html>