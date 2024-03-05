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

<body>
    <?php

    include_once("./credentialscheck.php");
    include_once("./connectdb.php");

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
            <button type="submit" class="btn btn-warning rounded-top-0 rounded-end-0 rounded-3">logout</button>
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

    <div class="card-displayer">
        <div class="table-card">
            <div>
                <h1>ATTORE</h1>
            <form action="insertform.php" method="post">
                <input type="hidden" name="table" value="attori">
                <button type="submit">AGGIUNGI</button>
            </form>
            </div>
        </div>
        <div class="table-card">
            <div>
                <h1>FILM</h1>
            <form action="insertform.php" method="post">
                <input type="hidden" name="table" value="film">
                <button type="submit">AGGIUNGI</button>
            </form>
            </div>
        </div>
        <div class="table-card">
            <div>
                <h1>RECENSIONE</h1>
            <form action="insertform.php" method="post">
                <input type="hidden" name="table" value="recensioni">
                <button type="submit">AGGIUNGI</button>
            </form>
            </div>
        </div>
        <div class="table-card">
            <div>
                <h1>SALA</h1>
            <form action="insertform.php" method="post">
                <input type="hidden" name="table" value="sale">
                <button type="submit">AGGIUNGI</button>
            </form>
            </div>
        </div>
        <div class="table-card">
            <div>
                <h1>PROIEZIONE</h1>
            <form action="insertform.php" method="post">
                <input type="hidden" name="table" value="proiezioni">
                <button type="submit">AGGIUNGI</button>
            </form>
            </div>
        </div>
    </div>

    <?php
        if(array_key_exists("insert_error",$_SESSION))
            echo $_SESSION["insert_error"];
        if(array_key_exists("sql",$_GET)){
            echo "<br><br><br>".($_GET["sql"]);
        }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>