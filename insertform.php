<?php
session_start();
include_once("./credentialscheck.php");
include_once("./connectdb.php");

$conn = getConn();

$username = checkSessionCredentials($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Index</title>
</head>

<body>
    <?php
    $table = $_POST["table"];
    
    $lastpage = "show.php?select=$table";

    if(!isValid($table))
        redirect($lastpage);

    $form = "";
    $header = "INSERT FORM";
    switch ($table) {
        case 'attori':
            $form = "<label for='nome' class='label'>Nome</label>
                    <input type='text' name='nome' class='input' required>
                    <label for='annonascita' class='label'>Anno di Nascita</label>
                    <input type='text' name='annonascita' class='input' required>
                    <label for='nazionalita' class='label'>Nazionalità</label>
                    <input type='text' name='nazionalita' class='input' required>";
            $header = "ATTORI " . $header;
            break;
        case 'film':
            $form = "<label for='titolo' class='label'>Titolo</label>
                    <input type='text' name='titolo' class='input' required>
                    <label for='annoproduzione' class='label'>Anno di Produzione</label>
                    <input type='number' min='1900' max='2100' name='annoproduzione' class='input' required>
                    <label for='nazionalita' class='label'>Nazionalita</label>
                    <input type='text' name='nazionalita' class='input' required>
                    <label for='regista' class='label'>Regista</label>
                    <input type='text' name='regista' class='input' required>
                    <label for='genere' class='label'>Genere</label>
                    <input type='text' name='genere' class='input' required>";
            $header = "FILM " . $header;
            break;
        case 'recensioni':
            
            $codfilm = isset($_POST["codfilm"]) ? $_POST["codfilm"] : "";

            $lastpage = "show.php?select=film";
            $title = "";

            $form = "";

            if(!isValid($codfilm)){
                $form = "<label for='codfilm' class='label'>Film</label>
                    <select name='codfilm' class='input' required>";

                $result = $conn->query("select codfilm,titolo from film");

                if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $title = $row["titolo"];
                        $codfilm = $row["codfilm"];
                        $form .= "<option value='$codfilm' style='text-transform:capitalized;'>$title</option>";
                    }
                    $title = "";
                }
                else{
                    redirect($lastpage);
                }
                        
                $form .="</select>";
            }
            else{
                $form .= "<input type='hidden' name='codfilm' class='d-none' value='$codfilm'>";
                
                $result = $conn->query("select codfilm,titolo from film where codfilm = '$codfilm'");

                if($result->num_rows > 0){
                    $title = "PER " . $result->fetch_assoc()["titolo"];
                }
                else{
                    redirect($lastpage);
                }
            }

            $form .= "<label for='voto' class='label'>Voto</label>
                    <select name='voto' class='input' required>
                    <option value ='1'>1</option>
                    <option value ='2'>2</option>
                    <option value ='3'>3</option>
                    <option value ='4'>4</option>
                    <option value ='5'>5</option>
                    </select>
                    ";
            $header = "RECENSIONE $title";
            break;
        case 'sale':
            $form = "<label for='nome' class='label'>Nome</label>
                    <input type='text' name='nome' class='input' required>
                    <label for='posti' class='label'>Numero di Posti</label>
                    <input type='number' min='0' name='posti' min='0' class='input' required>
                    <label for='citta' class='label'>Città</label>
                    <input type='text' name='citta' class='input' required>
                    <label for='dataapertura' class='label'>Data di Apertura</label>
                    <input type='date' name='dataapertura' class='input' required>";
            $header = "SALA " . $header;
            break;
        case 'proiezioni':

            $codsala = isset($_POST["codsala"]) ? $_POST["codsala"] : "";
            $name = "";

            if(!isValid($codsala)){
                $form = "<label for='codsala' class='label'>Sala</label>
                    <select name='codsala' class='input' required>";

                $result = $conn->query("select codsala,nome from sale");

                if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["nome"];
                        $codsala = $row["codsala"];
                        $form .= "<option value='$codsala' style='text-transform:capitalized;'>$name</option>";
                    }
                    $name = "";
                }
                else{
                    redirect($lastpage);
                }
                        
                $form .="</select>";
            }
            else{
                $form .= "<input type='hidden' name='codsala' class='d-none' value='$codsala'>";
                $result = $conn->query("select nome from sale where codsala = '$codsala'");
    
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $name = "PER " . $row["nome"];
                }
                else{
                    redirect($lastpage);
                }
            }

            $form .= "<label for='codfilm' class='label'>Film</label>
                    <select name='codfilm' class='input' required>";

            $result = $conn->query("select codfilm,titolo from film");

            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $title = $row["titolo"];
                    $codfilm = $row["codfilm"];
                    $form .= "<option value='$codfilm' style='text-transform:capitalized;'>$title</option>";
                }
                $title = "";
            }
            else{
                redirect($lastpage);
            }
                    
            $form .="</select>
                    <label for='incasso' class='label'>Incasso</label>
                    <input type='number' name='incasso' min='0' class='input' required>
                    <label for='oraproiezione' class='label'>Ora di Proiezione</label>
                    <input type='time' name='oraproiezione' value='00:00' class='input' required>";
            $header = "PROIEZIONE " . $name;
            break;
        default:
            redirect($lastpage);
            break;
    }
    ?>
    <div id="insert-form" class="text-center">
        <div class="h-100 pb-5 ps-5 pe-5">
            <form action="insert.php" method="post" class="h-100 d-flex flex-column justify-content-around pt-4">
                <h3 class="pb-2"><?php echo strtoupper($header) . " "?></h3>
                <?php
                    echo $form;
                ?>
                <?php
                echo "<input type='text' name='table' class='d-none' value='$table'>";
                ?>
                <br>
                <input type="text" name="method" class="d-none" value="update">
                <button class="btn btn-primary" type="submit">INVIA</button>
            </form>
        </div>
        <?php
        $emessage = !isset($_SESSION["register_error"]) || empty($_SESSION["register_error"]) ? "" : "
        <p class='text-danger'>{$_SESSION['register_error']}</p>";
        echo $emessage;
        ?>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>