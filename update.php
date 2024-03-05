<?php

    session_start();
    include_once("./connectdb.php");
    include_once("./credentialscheck.php");
    
    $conn = getConn();

    $username = checkSessionCredentials($conn);

    $table = $_POST["table"];

    $lastpage = isValid($table) ? "show.php?select=$table" : "index.php";

    if(!isValid($table))
        redirect($lastpage);


    $sql = "";
    switch ($table) {
        case 'attori':
            $nome = $_POST["nome"];
            $annonascita = $_POST["annonascita"];
            $nazionalita = $_POST["nazionalita"];
            $codattore = $_POST["codattore"];

            $sql = "update attori set
                    nome = '$nome',
                    annonascita = '$annonascita',
                    nazionalita = '$nazionalita'
                    where codattore = '$codattore'";
            break;
        case 'film':
            $titolo = $_POST["titolo"];
            $annoproduzione = $_POST["annoproduzione"];
            $nazionalita = $_POST["nazionalita"];
            $regista = $_POST["regista"];
            $genere = $_POST["genere"];
            $codfilm = $_POST["codfilm"];

            $sql = "update film set
                    titolo = '$titolo',
                    annoproduzione = '$annoproduzione',
                    nazionalita = '$nazionalita',
                    regista = '$regista',
                    genere = '$genere'
                    where codfilm = '$codfilm'";
            break;
        case 'recensioni':
            $voto = $_POST["voto"];
            $idrecensione = $_POST["idrecensione"];

            $sql = "update recensioni set
                    voto = '$voto'
                    where idrecensione = '$idrecensione'";
            break;
        case 'sale':
            $nome = $_POST["nome"];
            $posti = $_POST["posti"];
            $citta = $_POST["citta"];
            $dataapertura = $_POST["dataapertura"];
            $codsala = $_POST["codsala"];

            $sql = "update sale set
                    nome = '$nome',
                    posti = '$posti',
                    citta = '$citta',
                    dataapertura = '$dataapertura'
                    where codsala = '$codsala'";
            break;
        case 'proiezioni':
            $codfilm = $_POST["codfilm"];
            $incasso = $_POST["incasso"];
            $oraproiezione = $_POST["oraproiezione"];
            $codproiezione = $_POST["codproiezione"];

            $sql = "update proiezioni set
                    codfilm = '$codfilm',
                    incasso = '$incasso',
                    oraproiezione = '$oraproiezione'
                    where codproiezione = '$codproiezione'";
            break;
        default:
            redirect($lastpage);
            break;
    }

    $_SESSION["query_status"] = $sql;

    $conn->query($sql);

    redirect("index.php?sql=".urlencode($sql));
?>