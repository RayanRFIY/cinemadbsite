<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Result</title>
</head>

<body class="position-relative" onload="createTable()">
    <?php

include_once("./connectdb.php");
include_once("./credentialscheck.php");

$conn = getConn();


    $username = checkSessionCredentials($conn);
    ?>

    <div id="account">
        <div role="button" class="pe-1 d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 pe-1 ps-1"></i>
            <?php echo $username ?>
        </div>
        <form action="process.php" method="post" class="logout">
            <input type="text" name="method" class="d-none" value="logout">
            <button type="submit" class="btn btn-warning rounded-0 rounded-3">logout</button>
        </form>
    </div>

    <div class="navbar justify-content-center position-fixed p-0 start-0 end-0">
        <div>
            <form action="select.php" method="post">
                <input type="text" name="select" class="d-none" value="attori">
                <button class="btn btn-warning rounded-end-0 rounded-top-0 rounded fs-1">Attori</button>
            </form>
        </div>
        <div>
            <form action="select.php" method="post">
                <input type="text" name="select" class="d-none" value="film">
                <button class="btn btn-warning rounded-0 fs-1">Films</button>
            </form>
        </div>
        <div>
            <form action="select.php" method="post">
                <input type="text" name="select" class="d-none" value="sale">
                <button class="btn btn-warning rounded-start-0 rounded-top-0 fs-1">Sale</button>
            </form>
        </div>
    </div>

    <?php

    include_once("./queries.php");

    if(!isValid($_GET))
        exit();
    
    if(!array_key_exists("select",$_GET))
        exit();

    $table = $_GET["select"];

    $content = "";

    $codsala = null;
    $codfilm = null;

    switch ($table) {
        case 'attori':
            $content = getAllAttori($conn);
            break;
        case 'film':
            if(array_key_exists("codattore",$_GET)){
                $codattore = $_GET["codattore"];
                $content = getAllFilmsByActor($conn,$codattore);
            }
            else
                $content = getAllFilms($conn);
            break;
        case 'sale':
            $content = getAllSale($conn);
            break;
        case 'recensioni':
            if(array_key_exists("codfilm",$_GET)){
                $codfilm = $_GET["codfilm"];
                $content = getAllRecensioniByFilm($conn,$codfilm);
            }
            else{
                redirect("index.php");
            }
            break;
        case 'proiezioni':
            if(array_key_exists("codsala",$_GET)){
                $codsala = $_GET["codsala"];
                $content = getAllProiezioniBySala($conn,$codsala);
            }
            else{
                redirect("index.php");
            }
            break;
            
        default:
            $content = array("title" => "", "table" => "");
            break;
    }

    $content = $content != "" && isValid($content) ? $content : "no content found";
    $title = isValid($content["title"]) ? $content["title"] : "";
    ?>

    <div class="select-table d-flex flex-column justify-content-center">
        <div class="select-title text-center">
            <h1>
                <?php
                    echo $title;
                ?>
            </h1>
        </div>
        <div class="add-element-table">
            <form action="./insertform.php" method="post" class="pb-5">
                <?php
                    echo "<input type='text' name='table' class='d-none' value='$table'>";
                    
                    switch ($table) {
                        case 'recensioni':
                            echo "<input type='text' name='codfilm' class='d-none' value='$codfilm'>";
                            break;
                        case 'proiezioni':
                            echo "<input type='text' name='codsala' class='d-none' value='$codsala'>";
                            break;
                        default:
                            break;
                    }
                ?>
                <button type="submit" class="fake-link">Aggiungi elemento a <?php echo "$table" ?> </button>
            </form>
        </div>
        <div class="d-flex flex-row justify-content-center">
            <div class="display">
                <table class="mx-auto" id="content-table">
                <?php
                        echo $content["table"];
                    ?>
                </table>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
</body>

</html>