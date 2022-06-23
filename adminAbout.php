<?php
session_start();
if (isset($_SESSION['admin']) == false) {
    header('Location:http://wilkowskidawid.pl/6_Semestr/z9/index.php');
    exit();
}
if ($_SESSION['ok'] == true) {
    $_SESSION['ok'] = false;
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
    <script src="../ckeditor.js"></script>
</head>




<body id='body'>

    <div id='top'> </div>
    <div id='left'>
        <a href='about.php'>O firmie</a><br><br>
        <a href='kontakt.php'>Kontakt</a><br><br>
        <a href='mapa.php'>Jak do nas dotrzeć</a><br><br>
        <a href='oferta.php'>Oferta</a><br><br>
        <a href='chatbot.php'>Chatbot</a><br><br>
        <a href="index.php" class="btn btn-mybutton btn btn-dark" role="button">Wyloguj</a>
    </div>
    <div id='right'>

        <form id="editor1" action="save.php" method="post">
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                <?php
                include 'dbConn.php';

                $output = '';
                $sql = "SELECT text FROM textAbout ORDER BY id DESC";
                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($query);
                echo $result['textarea'];
                ?>
            </textarea>
            <p>
                <input type="submit" value="Submit">
            </p>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
            </script>
        </form>
    </div>




</body>

</html>