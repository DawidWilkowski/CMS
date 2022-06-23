<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$directory = $_SERVER['REQUEST_URI'];
$dirr = strstr($directory, "z9/");
$str2 = substr($dirr, 3);

$_SESSION['link'] = $str2;
$directory = $_SESSION['link'];
$isadmin = $_SESSION['admin'];
if ($_SESSION['ok'] == 1) {
    $_SESSION['ok'] = 0;
    echo '<script language="javascript">';
    echo 'alert("Edycja pomyślna")';
    echo '</script>';
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Script-Type" content="text/javascript">

    <title>Wilkowski</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="main.css">
</head>




<body id='body'>

    <div id='top'> </div>
    <div id='left'>
        <a href='about.php'>O firmie</a><br><br>
        <a href='kontakt.php'>Kontakt</a><br><br>
        <a href='mapa.php'>Jak do nas dotrzeć</a><br><br>
        <a href='oferta.php'>Oferta</a><br><br>
        <a href='chatbot.php'>Chatbot</a><br><br>
        <?php
        include 'dbConn.php';
        if ($isadmin == true) {
            echo "<a href='index.php' class='btn btn-mybutton btn btn-dark' role='button'>Wyloguj</a>";
        ?>

        <?php } else {
            echo  "<form method='post' action='admin.php'>Login:<input type='text' name='user' maxlength='15' size='15'><br>Hasło:<input type='password' name='pass' maxlength='15' size='15'><input type='hidden' name='url' value= '" . $str2 . "'><br><input type='submit' value='Zaloguj'/></br></form></div>";
        }
        ?>

    </div>
    <div id='right'>


        <div class='table'>
            <?php

            if ($isadmin == true) {
                $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
                $sql = "SELECT data,pytanie,odpowiedz FROM chat";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {


                        echo "<table class='table table-striped table-dark table-sm'>";
                        echo "<tr>";
                        echo "<th>data</th>";
                        echo "<th>pytanie</th>";
                        echo "<th>odpowiedz</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['data'] . "</td>";
                            echo "<td>" . $row['pytanie'] . "</td>";
                            echo "<td>" . $row['odpowiedz'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo "No records matching your query were found.";
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            } else {
                echo "<div id = 'robot'>";
                echo " <img src='robot.png' width='400' height='400'><br>";

                echo "<h2>Zadaj pytanie:";

                echo  "<form method='post'><input type='text' name='pytanie'><input type='submit' value='Pytaj'/></br></form></h2>";
                $odpowiedz = "";
                if (!empty($_POST['pytanie'])) {

                    $pytanie = $_POST['pytanie'];
                    $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
                    if ($pytanie == "cześć" || $pytanie == "czesc" || $pytanie == "dzień dobry" || $pytanie == "hejka" || $pytanie == "siema" || $pytanie == "witaj" || $pytanie == "witam") {
                        $odpowiedz = "Witaj Szanowny Kliencie!";

                        mysqli_query($link, "INSERT INTO chat (id,data,pytanie,odpowiedz) VALUES (NULL,DEFAULT,'$pytanie','$odpowiedz')");
                    } else if ($pytanie == "kontakt" || $pytanie == "adres" || $pytanie == "telefon") {
                        $odpowiedz = "";
                        $sql = "SELECT text FROM textKontakt ORDER BY id DESC";
                        $query = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_assoc($query);
                        echo $result['text'];
                        $resultOdp = $result['text'];
                        mysqli_query($link, "INSERT INTO chat (id,data,pytanie,odpowiedz) VALUES (NULL,DEFAULT,'$pytanie','$resultOdp')");
                    } else if ($pytanie == "oferta") {
                        $odpowiedz = "";
                        $sql = "SELECT text FROM textOferta ORDER BY id DESC";
                        $query = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_assoc($query);
                        echo $result['text'];
                        $resultOdp = $result['text'];
                        mysqli_query($link, "INSERT INTO chat (id,data,pytanie,odpowiedz) VALUES (NULL,DEFAULT,'$pytanie','$resultOdp')");
                    } else if ($pytanie == "?" || ($pytanie == "h")) {
                        $odpowiedz = "Potrafie odpowiedziec na pytania: kontakt, adres, telefon, oferta";
                        mysqli_query($link, "INSERT INTO chat (id,data,pytanie,odpowiedz) VALUES (NULL,DEFAULT,'$pytanie','$odpowiedz')");
                    } else {
                        $odpowiedz = "Jestem tylko początkującym botem i nie znam odpowiedzi na to pytanie.";
                        mysqli_query($link, "INSERT INTO chat (id,data,pytanie,odpowiedz) VALUES (NULL,DEFAULT,'$pytanie','$odpowiedz')");
                    }
                }
                echo  $odpowiedz . "</div>";
            }
            ?>
        </div>

    </div>
    </div>




</body>

</html>