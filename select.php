<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
    
    function redirect($page){
        header("Location: ./$page");
        exit();
    }
    $page = "show.php";
    $select = $_POST["select"];
    if(isset($select) && !empty($select)){
        $page .= "?select=".urlencode($select);
        if($select === "recensioni"){
            $codfilm = $_POST["codfilm"];
            $page.="&codfilm=$codfilm";
        }
        else if($select === "proiezioni"){
            $codsala = $_POST["codsala"];
            $page.="&codsala=$codsala";
        }
        else if($select === "film"){    
            $codattore = $_POST["codattore"];
            if(!empty($codattore) && isset($codattore)){
                $page.="&codattore=$codattore";
            }
        }
    }
    redirect($page);
    ?>
</body>
</html>