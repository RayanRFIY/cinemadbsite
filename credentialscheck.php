<?php
function redirect($page)
{
    header("Location: ./$page");
    exit();
}

function isValid($var)
{
    return isset($var) && !empty($var) && $var != null;
}

function checkSessionCredentials($conn){
    

    $userid = $_SESSION["userid"];
    $password = $_SESSION["password"];

    if (!isset($userid) || empty($userid) || !isset($password) || empty($password)) {
        header("Location: ./login.php");
        exit();
    }

    $sql = "select username,password from utenti where username = '$userid' or email = '$userid'";

    $errormessage = "credenziali di sessione invalide";

    $result = $conn->query($sql);

    if ($conn->affected_rows < 0) {
        $_SESSION["login_error"] = $errormessage;
        redirect("login.php");
    }

    $row = $result->fetch_assoc();

    if ($password != $row["password"]) {
        $_SESSION["login_error"] = $errormessage;
        redirect("login.php");
    }
    return $row["username"];    
}
?>