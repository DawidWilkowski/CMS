<?php 
session_start();

include 'dbConn.php';
$dir = htmlentities ($_POST['url'], ENT_QUOTES, "UTF-8");
     $text = $_POST['editor1'];

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $link = mysqli_connect( $dbhost, $dbuser, $dbpassword, $dbname);
    if($dir == "about.php"){
        mysqli_query($link,"INSERT INTO textAbout (text) VALUES ('" . mysqli_real_escape_string($link,$text) . "')");
    }
    else if ($dir == "kontakt.php")
    {
        mysqli_query($link,"INSERT INTO textKontakt (text) VALUES ('" . mysqli_real_escape_string($link,$text) . "')");
    }
    else if ($dir == "mapa.php")
    {
        mysqli_query($link,"INSERT INTO textDojazd (text) VALUES ('" . mysqli_real_escape_string($link,$text) . "')");
    }
    else if ($dir == "oferta.php")
    {
        mysqli_query($link,"INSERT INTO textOferta (text) VALUES ('" . mysqli_real_escape_string($link,$text) . "')");
    }
    $_SESSION ['ok']= true;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
