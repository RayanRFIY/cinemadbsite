<?php

session_start();

include_once("./credentialscheck.php");
include_once("./connectdb.php");

$conn = getConn();

$username = checkSessionCredentials($conn);

$table = $_POST["table"];

$lastpage = "index.php";

if(isValid(!$table)){
    redirect($lastpage);
}

switch ($table) {
    case 'attori':
        $nome = $_POST["nome"];
        $annonascita = $_POST["annonascita"];
        $nazionalita = $_POST["nazionalita"];

        $errormessage = "$table : Errore nell'inserimento in $table, controllare i campi compilati!";

        if(!isValid($nome) || !isValid($annonascita) || !isValid($nazionalita)){
            $_SESSION["insert_error"] = $errormessage;
            redirect($lastpage);
        }

        $sql = "insert into attori(nome,annonascita,nazionalita)
                value('$nome','$annonascita','$nazionalita')";
        $conn->query($sql);

        if($conn->affected_rows < 0)
            $_SESSION["insert_error"] = $errormessage;
        else
            $_SESSION["inser_error"] = "";

        redirect($lastpage);

        break;
    case 'film':
        $titolo = $_POST["titolo"];
        $annoproduzione = $_POST["annoproduzione"];
        $nazionalita = $_POST["nazionalita"];
        $regista = $_POST["regista"];
        $genere = $_POST["genere"];

        $errormessage = "Errore nell'inserimento in $table";

        if(!isValid($titolo) || !isValid($annoproduzione) || !isValid($nazionalita) || !isValid($regista) || !isValid($genere)){
            $_SESSION["insert_error"] = $errormessage . ", controllare i campi compilati!";
            redirect($lastpage);
        }

        $sql = "insert into film(titolo,annoproduzione,nazionalita,regista,genere)
                value('$titolo','$annoproduzione','$nazionalita','$regista','$genere')";
        $conn->query($sql);

        if($conn->affected_rows < 0)
            $_SESSION["insert_error"] = $errormessage . ", errore nell'inserimento nel database!";
        else
            $_SESSION["inser_error"] = "";

        redirect($lastpage);
        break;
    case 'recensioni':
        $voto = $_POST["voto"];
        $codfilm = $_POST["codfilm"];

        $errormessage = "Errore nell'inserimento in $table, controllare i campi compilati!";

        if(!isValid($voto) || !isValid($codfilm)){
            $_SESSION["insert_error"] = $errormessage;
            redirect($lastpage);
        }

        $sql = "insert into recensioni(voto,codfilm,username)
                value('$voto','$codfilm','$username')";
        $conn->query($sql);

        if($conn->affected_rows < 0)
            $_SESSION["insert_error"] = $errormessage;
        else
            $_SESSION["inser_error"] = "";

        redirect($lastpage);
        break;
    case 'sale':
        $nome = $_POST["nome"];
        $posti = $_POST["posti"];
        $citta = $_POST["citta"];
        $dataapertura = $_POST["dataapertura"];

        $errormessage = "Errore nell'inserimento in $table, controllare i campi compilati!";

        if(!isValid($nome) || !isValid($posti) || !isValid($citta) || !isValid($dataapertura)){
            $_SESSION["insert_error"] = $errormessage;
            redirect($lastpage);
        }

        $sql = "insert into sale(nome,posti,citta,dataapertura)
                value('$nome','$posti','$citta','$dataapertura')";
        $conn->query($sql);

        if($conn->affected_rows < 0)
            $_SESSION["insert_error"] = $errormessage;
        else
            $_SESSION["inser_error"] = "";

        redirect($lastpage);
        break;
    case 'proiezioni':
        $codfilm = $_POST["codfilm"];
        $codsala = $_POST["codsala"];
        $incasso = $_POST["incasso"];
        $oraproiezione = $_POST["oraproiezione"];
        $errormessage = "Errore nell'inserimento in $table, controllare i campi compilati!";
        
        if(!isValid($codfilm) || !isValid($codsala) || !isValid($oraproiezione) || !isValid($incasso)){
            $_SESSION["insert_error"] = $errormessage;
            redirect($lastpage);
        }

        $sql = "insert into proiezioni(codfilm,codsala,incasso,oraproiezione)
                value('$codfilm','$codsala','$incasso','$oraproiezione')";
        $conn->query($sql);

        if($conn->affected_rows < 0)
            $_SESSION["insert_error"] = $errormessage;
        else
            $_SESSION["insert_error"] = "";
        
        redirect($lastpage);
        break;    
    
    default:
        redirect($lastpage);
        break;
}
    
?>