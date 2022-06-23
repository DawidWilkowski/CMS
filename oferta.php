<?php
session_start();


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
    <script src="/6_Semestr/z9/ckeditor/ckeditor.js"></script>
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

        if ($isadmin == true) {
            echo "<a href='index.php' class='btn btn-mybutton btn btn-dark' role='button'>Wyloguj</a>";
        ?>

        <?php } else {
            echo  "<form method='post' action='admin.php'>Login:<input type='text' name='user' maxlength='15' size='15'><br>Hasło:<input type='password' name='pass' maxlength='15' size='15'><input type='hidden' name='url' value= '" . $str2 . "'><br><input type='submit' value='Zaloguj'/></br></form></div>";
        }
        ?>

    </div>
    <div id='right'>
        <h1>
            <?php
            include 'dbConn.php';
            if ($isadmin == true) {
                echo   "<form id='edit' action='save.php' method='post' >";
                echo "<input type='hidden' name='url' value= '" . $str2 . "'> ";
                echo "<textarea name='editor1' id='editor1' rows='10' cols='80'>";




                $output = '';
                $sql = "SELECT text FROM textOferta ORDER BY id DESC";
                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($query);
                echo $result['text'];

                echo " </textarea>";

                echo " <script>";

                echo "CKEDITOR.replace( 'editor1' );";
                echo "</script>";

                echo " </form>";
                echo " <p>";
                echo "   <button type='submit' form='edit' >Submit</button>";

                echo " </p>";
            } else {


                $output = '';
                $sql = "SELECT text FROM textOferta ORDER BY id DESC";
                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($query);
                echo $result['text'];
            }
            ?>

        </h1>

    </div>




</body>

</html>