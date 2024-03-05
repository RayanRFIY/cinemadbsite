<?php

function getAllAttori($conn){
    
        $table = "<tr class='header'><th onclick='orderBy(0)'>Codice Attore</th><th onclick='orderBy(1)'>Nome</th><th onclick='orderBy(2)'>Anno di Nascita</th><th onclick='orderBy(3)'>Nazionalità</th><th onclick='orderBy(4)'>Film</th></tr>";
        $empty = true;

        $sql = "select attori.codattore,attori.nome,attori.annonascita,attori.nazionalita, if(COUNT(recita.codfilm) > 0, 'TRUE','FALSE') as 'has_film'
                from attori
                left join recita on recita.codattore = attori.codattore
                group by attori.codattore";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $empty = false;
            $cont = 0;
            while($row = $result->fetch_assoc()) {
            $table .= "<tr id ='$cont'>";
            $pk = 1;
            foreach ($row as $key => $value) {
                if($key === "codattore")
                    $pk = $value;
                else if($key === "has_film"){
                    if($value === "TRUE"){
                        $table .= "
                        <td>
                            <form action='select.php' method='post'>
                                <input type='text' name='select' value='film' class='d-none'>
                                <input type='number' name='codattore' value='$pk' class='d-none'>
                                <button type='submit' class='fake-link'>Vedi Film</button>
                            </form>
                        </td>";
                    }
                    else
                        $table .= "<td>
                                    none
                                </td>";
                    continue;
                }
                $table .= "<td >" . $value. "</td>";
            }
            $table.="
                <td>
                    <form action='delete.php' method='post'>
                        <input type='text' name='table' value='attori' class='d-none'>
                        <input type='text' name='pk' value='codattore' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-trash3'></i><button class='fake-link'>elimina</button>
                    </form>
                </td>
                <td>
                    <form action='updateform.php' method='post'>
                        <input type='text' name='table' value='attori' class='d-none'>
                        <input type='text' name='pk' value='codattore' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-pencil-square'></i><button class='fake-link'>modifica</button>
                    </form>
                </td>
            ";
            $table .= "</tr>";
            $cont++;
            }
        }

        $response = array("title" => "", "table" => $table);
        
        if($empty)
            return array("title" => "", "table" => "");
        else
            return $response;
}

function getAllFilmsByActor($conn,$codattore){
    $table = "<tr class='header'><th onclick='orderBy(0)'>Codice Film</th><th onclick='orderBy(1)'>Titolo</th><th onclick='orderBy(2)'>Anno di Produzione</th><th onclick='orderBy(3)'>Nazionalità</th><th onclick='orderBy(4)'>Regista</th><th onclick='orderBy(5)'>Genere</th><th onclick='orderBy(6)'>Media recensioni</th></tr>";

    $empty = true;

    $sql = "select film.codfilm as codicefilm,film.titolo,film.annoproduzione,film.nazionalita,film.regista,film.genere,ROUND(AVG(recensioni.voto),1) as media
            from film
            join recita on recita.codfilm = film.codfilm
            join attori on recita.codattore = attori.codattore
            left join recensioni on recensioni.codfilm = film.codfilm
            where attori.codattore = '$codattore'
            group by film.codfilm";

    $title = $conn->query("select nome from attori where codattore = '$codattore'");

    if($title->num_rows < 1)
        return array("title" => "", "table" => "");

    $r = $title->fetch_assoc();
    $title = $r["nome"];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $empty = false;
        $cont = 0;
        while($row = $result->fetch_assoc()) {
        $table .= "<tr id ='$cont'>";
        $pk = 1;
        foreach ($row as $key => $value) {
            if($key === "codicefilm")
                $pk = $value;
            else if($key === "media"){
                $value = empty($value) || !isset($value) ? "none" : $value . "<br>
                <form action='select.php' method='post'>
                    <input type='text' name='select' value='recensioni' class='d-none'>
                    <input type='number' name='codfilm' value='$pk' class='d-none'>
                    <button type='submit' class='fake-link'>Vedi Recensioni</button>
                </form>";

            }
                
            $table .= "<td>" . $value. "</td>";
        
        }
        $table.="
                <td>
                    <form action='delete.php' method='post'>
                        <input type='text' name='table' value='film' class='d-none'>
                        <input type='text' name='pk' value='codfilm' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-trash3'></i><button class='fake-link'>elimina</button>
                    </form>
                </td>
                <td>
                    <form action='updateform.php' method='post'>
                        <input type='text' name='table' value='film' class='d-none'>
                        <input type='text' name='pk' value='codfilm' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-pencil-square'></i><button class='fake-link'>modifica</button>
                    </form>
                </td>
            ";
        $table .= "</tr>";
        $cont++;
        }
    }

    $response = array("title" => $title, "table" => $table);

    if($empty)
        return array("title" => "", "table" => "");
    else
        return $response;
}

function getAllFilms($conn){
    
    $table = "<tr class='header'><th onclick='orderBy(0)'>Codice Film</th><th onclick='orderBy(1)'>Titolo</th><th onclick='orderBy(2)'>Anno di Produzione</th><th onclick='orderBy(3)'>Nazionalità</th><th onclick='orderBy(4)'>Regista</th><th onclick='orderBy(5)'>Genere</th><th onclick='orderBy(6)'>Media recensioni</th></tr>";
        $empty = true;

        $sql = "select film.*,ROUND(AVG(recensioni.voto),1) as media
                from film
                left join recensioni on recensioni.codfilm = film.codfilm
                group by film.codfilm";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $empty = false;
            $cont = 0;
            while($row = $result->fetch_assoc()) {
            $table .= "<tr id ='$cont'>";
            $pk = 1;
            foreach ($row as $key => $value) {
                $value = empty($value) || !isset($value) ? "none" : $value;
                $pk = $key === "CodFilm" ? $value : $pk;
                if($key === "media" && $value != "none"){
                    $value.= "<br>
                                <form action='select.php' method='post'>
                                    <input type='text' name='select' value='recensioni' class='d-none'>
                                    <input type='number' name='codfilm' value='$pk' class='d-none'>
                                    <button type='submit' class='fake-link'>Vedi Recensioni</button>
                                </form>";
                }
                $table .= "<td >" .$value. "</td>";
            }
            $table.="
                <td>
                    <form action='delete.php' method='post'>
                        <input type='text' name='table' value='film' class='d-none'>
                        <input type='text' name='pk' value='codfilm' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-trash3'></i><button class='fake-link'>elimina</button>
                    </form>
                </td>
                <td>
                    <form action='updateform.php' method='post'>
                        <input type='text' name='table' value='film' class='d-none'>
                        <input type='text' name='pk' value='codfilm' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-pencil-square'></i><button class='fake-link'>modifica</button>
                    </form>
                </td>
            ";
            $table .= "</tr>";
            $cont++;
            }
        }
        
        $response = array("title" => "", "table" => $table);

        if($empty)
            return array("title" => "", "table" => "");
        else
            return $response;
}

function getAllSale($conn){

        $table = "<tr class='header'><th onclick='orderBy(0)'>Codice Sala</th><th onclick='orderBy(1)'>Nome</th><th onclick='orderBy(2)'>N. Posti</th><th onclick='orderBy(3)'>Città</th><th onclick='orderBy(4)'>Data di Apertura</th><th onclick='orderBy(5)'>Proiezioni</th></th></tr>";
        $empty = true;
        $sql = "select sale.codsala,nome,posti,citta,dataapertura, if(COUNT(proiezioni.CodProiezione) > 0, 'TRUE','FALSE') as 'has_proiezioni' from sale
        LEFT JOIN proiezioni ON proiezioni.CodSala = sale.CodSala
        GROUP BY sale.CodSala;";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $empty = false;
            $cont = 0;
            while($row = $result->fetch_assoc()) {
            $table .= "<tr id ='$cont'>";
            $codsala = 1;
            foreach ($row as $key => $value) {
                $codsala = $key === "codsala" ? $value : $codsala;
                if($key === "has_proiezioni")
                    $value = $value === "TRUE" ?
                    "<br>
                    <form action='select.php' method='post'>
                        <input type='text' name='select' value='proiezioni' class='d-none'>
                        <input type='number' name='codsala' value='$codsala' class='d-none'>
                        <button type='submit' class='fake-link'>Vedi Proiezioni</button>
                    </form>" 
                    : "non ci sono proiezioni";
                $table .= "<td>" . $value. "</td>";
            }
            $table.="
                <td>
                    <form action='delete.php' method='post'>
                        <input type='text' name='table' value='sale' class='d-none'>
                        <input type='text' name='pk' value='codsala' class='d-none'>
                        <input type='text' name='pkvalue' value='$codsala' class='d-none'>
                        <i class='bi bi-trash3'></i><button class='fake-link'>elimina</button>
                    </form>
                </td>
                <td>
                    <form action='updateform.php' method='post'>
                        <input type='text' name='table' value='sale' class='d-none'>
                        <input type='text' name='pk' value='codsala' class='d-none'>
                        <input type='text' name='pkvalue' value='$codsala' class='d-none'>
                        <i class='bi bi-pencil-square'></i><button class='fake-link'>modifica</button>
                    </form>
                </td>
            ";
            $table .= "</tr>";
            $cont++;
            }
        }

        $response = array("title" => "", "table" => $table);

        if($empty)
            return array("title" => "", "table" => "");
        else
            return $response;
}

function getAllProiezioniBySala($conn,$codsala){
    $table = "<tr class='header'><th onclick='orderBy(0)'>Codice Proiezione</th><th onclick='orderBy(1)'>Titolo del Film</th><th onclick='orderBy(2)'>Incassi</th><th onclick='orderBy(3)'>Orario di Proiezione</th></tr>";

    $empty = true;

    

    $title = $conn->query("select nome from sale where codsala = '$codsala'");

    if($title->num_rows < 1)
        return array("title" => "", "table" => "");

    $r = $title->fetch_assoc();
    $title = $r["nome"];

    $sql = "select proiezioni.codproiezione, film.titolo as titolo, proiezioni.incasso, proiezioni.oraproiezione
            from proiezioni
            join sale on sale.codsala = proiezioni.codsala
            join film on proiezioni.codfilm = film.codfilm
            where sale.codsala = '$codsala'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $empty = false;
        $cont = 0;
        while($row = $result->fetch_assoc()) {
        $table .= "<tr id ='$cont'>";
        $pk = 1;
        foreach ($row as $key => $value) {
            if($key == "codproiezione")
                $pk = $value;
            $table .= "<td>" . $value. "</td>";
        
        }
        $table.="
                <td>
                    <form action='delete.php' method='post'>
                        <input type='text' name='table' value='proiezioni' class='d-none'>
                        <input type='text' name='pk' value='codproiezione' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-trash3'></i><button class='fake-link'>elimina</button>
                    </form>
                </td>
                <td>
                    <form action='updateform.php' method='post'>
                        <input type='text' name='table' value='proiezioni' class='d-none'>
                        <input type='text' name='pk' value='codproiezione' class='d-none'>
                        <input type='text' name='pkvalue' value='$pk' class='d-none'>
                        <i class='bi bi-pencil-square'></i><button class='fake-link'>modifica</button>
                    </form>
                </td>
            ";
        $table .= "</tr>";
        $cont++;
        }
    }

    $response = array("title" => $title, "table" => $table);

    if($empty)
        return array("title" => "", "table" => "");
    else
        return $response;
}

function getAllRecensioniByFilm($conn,$codfilm){
        $table = "<tr class='header'><th onclick='orderBy(0)'>ID Recensione</th><th onclick='orderBy(1)'>Voto</th><th onclick='orderBy(2)'>Username</th></th></tr>";

        $empty = true;

        $sql = "select idrecensione,voto,username from recensioni
                where codfilm = '$codfilm'";

        $title = $conn->query("select titolo from film where codfilm = '$codfilm'");

        if($title->num_rows < 1)
            return array("title" => "", "table" => "");

        $r = $title->fetch_assoc();
        $title = $r["titolo"];

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $empty = false;
            $cont = 0;
            $pk = 1;
            while($row = $result->fetch_assoc()) {
            $table .= "<tr id ='$cont'>";
            foreach ($row as $key => $value) {
                $table .= "<td>" . $value. "</td>";

                $pk = $key === "idrecensione" ? $value : $pk;

                if($key === "username" && $value === checkSessionCredentials($conn))
                    $table.= "<td>
                                <form action='delete.php' method='post'>
                                    <input type='text' name='table' value='recensioni' class='d-none'>
                                    <input type='text' name='pk' value='idrecensione' class='d-none'>
                                    <input type='text' name='pkvalue' value='$pk' class='d-none'>
                                    <i class='bi bi-trash3'></i><button class='fake-link'>elimina</button>
                                </form>
                            </td>
                            <td>
                                <form action='updateform.php' method='post'>
                                    <input type='text' name='table' value='recensioni' class='d-none'>
                                    <input type='text' name='pk' value='idrecensione' class='d-none'>
                                    <input type='text' name='pkvalue' value='$pk' class='d-none'>
                                    <i class='bi bi-pencil-square'></i><button class='fake-link'>modifica</button>
                                </form>
                            </td>";
            }
            $table .= "</tr>";
            $cont++;
            }
        }

        $response = array("title" => $title, "table" => $table);
        if($empty)
            return array("title" => "", "table" => "");
        else
            return $response;
}

?>