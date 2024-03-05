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
    <link rel="stylesheet" href="./css/styles.css">
    <title>Index</title>
</head>

<body>
    <?php
    include_once("./credentialscheck.php");
    include_once("./connectdb.php");

    $conn = getConn();
    
    checkSessionCredentials($conn);

    $table = $_POST["table"];
    $pkvalue = $_POST["pkvalue"];
    $pk = $_POST["pk"];

    $lastpage = isValid($table) ? "show.php?select=$table" : "index.php";

    if(!isValid($table) || !isValid($pk) || !isValid($pkvalue))
        redirect($lastpage);

    $lastpage = "show.php?select=$table";

    $oldvalues = [];

    $sql = "select * from $table where $pk = '$pkvalue'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        foreach ($row as $key => $value) {
            if(strtolower($key) == strtolower($pk))
                continue;
            $oldvalues[strtolower($key)] = $value;
        }
    }
    else{
        redirect($lastpage);
    }

    $form = "";
    $header = "UPDATE FORM";

    switch ($table) {
        case 'attori':
            $nome = $oldvalues["nome"];
            $annonascita = $oldvalues["annonascita"]; 
            $nazionalita = $oldvalues["nazionalita"];
            
            $form = "<label for='nome' class='label'>Nome</label>
                    <input type='text' name='nome' class='input' value='$nome' required>
                    <label for='annonascita' class='label'>Anno di Nascita</label>
                    <input type='text' name='annonascita' min='1900' max='2100' class='input' value='$annonascita' required>
                    <label for='nazionalita' class='label'>Nazionalità</label>
                    <input type='text' name='nazionalita' class='input' value='$nazionalita' required>
                    <input type='hidden' name='codattore' class='d-none' value='$pkvalue' required>";
            $header = "ATTORI " . $header;
            break;
        case 'film':
            $titolo = $oldvalues["titolo"];
            $annoproduzione = $oldvalues["annoproduzione"];
            $nazionalita = $oldvalues["nazionalita"];
            $regista = $oldvalues["regista"];
            $genere = $oldvalues["genere"];
            
            $form = "<label for='titolo' class='label'>Titolo</label>
                    <input type='text' name='titolo' class='input' value='$titolo' required>
                    <label for='annoproduzione' class='label'>Anno di Produzione</label>
                    <input type='number' min='1900' max='2100' name='annoproduzione' class='input' value='$annoproduzione' required>
                    <label for='nazionalita' class='label'>Nazionalita</label>
                    <input type='text' name='nazionalita' class='input' value='$nazionalita' required>
                    <label for='regista' class='label'>Regista</label>
                    <input type='text' name='regista' class='input' value='$regista' required>
                    <label for='genere' class='label'>Genere</label>
                    <input type='text' name='genere' class='input' value='$genere' required>
                    <input type='hidden' name='codfilm' class='d-none' value='$pkvalue' required>";
            $header = "FILM " . $header;
            break;
        case 'recensioni':
            
            $voto = $oldvalues["voto"];
            $codfilm = $oldvalues["codfilm"];

            $lastpage = "show.php?select=film";

            $result = $conn->query("select titolo from film where codfilm = '$codfilm'");
            $title = "";

            if($result->num_rows > 0){
                    $title = $result->fetch_assoc()["titolo"];
            }
            else{
                redirect($lastpage);
            }

            $form = "<label for='voto' class='label'>Voto</label>
                    <select name='voto' class='input' required>";

            for ($i=1; $i <= 5 ; $i++) { 
                $form .= $i == intval($oldvalues["voto"])
                ? "<option value='$i' selected='selected'>$i</option>"
                : "<option value='$i'>$i</option>";
            }

            $form .="</select>
                    <input type='text' name='codfilm' class='d-none' value='$codfilm'>
                    <input type='hidden' name='idrecensione' class='d-none' value='$pkvalue' required>";
            $header = "RECENSIONE PER $title";
            break;
        case 'sale':
            $nome = $oldvalues["nome"];
            $posti = $oldvalues["posti"];
            $citta = $oldvalues["citta"];
            $dataapertura = $oldvalues["dataapertura"];
            
            $form = "<label for='nome' class='label'>Nome</label>
                    <input type='text' name='nome' class='input' value='$nome' required>
                    <label for='posti' class='label'>Posti</label>
                    <input type='number' min='0' name='posti' class='input' value='$posti' required>
                    <label for='citta' class='label'>Città</label>
                    <input type='text' name='citta' class='input' value='$citta' required>
                    <label for='dataapertura' class='label'>Data di Apertura</label>
                    <input type='text' name='dataapertura' class='input' value='$dataapertura' required>
                    <input type='hidden' name='codsala' class='d-none' value='$pkvalue' required>";
            $header = "SALA " . $header;
            break;
        case 'proiezioni':

            $codsala = $oldvalues["codsala"];
            $codfilm = $oldvalues["codfilm"];
            $incasso = $oldvalues["incasso"];
            $oraproiezione = $oldvalues["oraproiezione"];
            $titolo = "";

            $form = "<label for='codfilm' class='label'>Film</label>
                    <select name='codfilm' class='input' required>";

            $result = $conn->query("select codfilm,titolo from film");

            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $title = $row["titolo"];
                    $film = $row["codfilm"];
                    $titolo = $film == $codfilm ? $title : $titolo;
                    $form.= $film == $codfilm
                    ? "<option value='$film' style='text-transform:capitalized;' selected='selected'>$title</option>"
                    : "<option value='$film' style='text-transform:capitalized;'>$title</option>";
                }
            }
            else{
                redirect($lastpage);
            }
                    
            $form .="</select>";
            $form .= "<label for='codsala' class='label'>Sala</label>
                    <select name='codsala' class='input' value='' required>";

            $result = $conn->query("select codsala,nome from sale");

            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $name = $row["nome"];
                    $sala = $row["codsala"];
                    $titolo = $sala == $codsala ? $name : $titolo;
                    $form.= $sala == $codsala
                    ? "<option value='$sala' style='text-transform:capitalized;' selected='selected'>$name</option>"
                    : "<option value='$sala' style='text-transform:capitalized;'>$name</option>";
                }
            }
            else{
                redirect($lastpage);
            }
                    
            $form .="</select>
                    <label for='incasso' class='label'>Incasso</label>
                    <input type='number' name='incasso' min='0' value='$incasso' class='input' required>
                    <label for='oraproiezione' class='label'>Ora di Proiezione</label>
                    <input type='time' name='oraproiezione' class='input' value='$oraproiezione' required>
                    <input type='hidden' name='codproiezione' class='d-none' value='$pkvalue' required>";
            
            $header = "PROIEZIONE PER " . $titolo;
            break;
        default:
            redirect($lastpage);
            break;
    }
    ?>
    <div id="update-form" class="text-center">
        <div class="h-100 pb-5 ps-5 pe-5">
            <form action="update.php" method="post" class="h-100 d-flex flex-column justify-content-around pt-4">
                <h3 class="pb-2"><?php echo strtoupper($header);?></h3>
                <?php
                    echo $form;
                ?>
                <br>
                <input type="hidden" name="table" class="d-none" value="<?php echo $table?>">
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