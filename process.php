<?php
session_start();
$method = $_POST["method"];

function redirect($page)
{
    header("Location: ./$page");
    exit();
}

function isValid($var)
{
    return isset($var) && !empty($var);
}

if (!isValid($method) || ($method != "login" && $method != "register" && $method != "logout")) {
    $_SESSION["login_error"] = "il metodo '$method' selezionato non e' valido!";
    redirect("login.php");
}

include_once("./connectdb.php");

$conn = getConn();

if ($method == "login") {
    $userid = $_POST["userid"];
    $password = $_POST["password"];
    $errormessage = "username or password are invalid! try again";

    if (!isValid($userid) || !isValid($password)) {
        $_SESSION["login_error"] = $errormessage;
        redirect("login.php");
    }

    $sql = "select password from utenti where username = '$userid' or email = '$userid'";

    $result = $conn->query($sql);

    if ($conn->affected_rows < 0) {
        $_SESSION["login_error"] = $errormessage;
        redirect("login.php");
    }

    $row = $result->fetch_assoc();
    $password = hash('sha256', $password);
    if ($password == $row["password"]) {
        $_SESSION["userid"] = $userid;
        $_SESSION["password"] = $password;
        $_SESSION["register_error"] = "";
        $_SESSION["login_error"] = "";
        redirect("index.php");
    } else {
        $_SESSION["login_error"] = $errormessage;
        redirect("login.php");
    }

} else if ($method == "register") {
    $email = $_POST["email"];
    $name = $_POST["nome"];
    $surname = $_POST["cognome"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!isValid($email) || !isValid($name) || !isValid($surname) || !isValid($username) || !isValid($password)) {
        $_SESSION["register_error"] = "invalid fields, please check again for errors!";
        redirect("register.php");
    }
    $password = hash('sha256', $password);
    $sql = "insert into utenti (email,nome,cognome,username,password)
            value ('$email','$name','$surname','$username','$password')";

    $conn->query($sql);

    if ($conn->affected_rows > 0) {
        $_SESSION["register_error"] = "";
        $_SESSION["login_error"] = "";
        redirect("login.php");
    } else {
        $_SESSION["register_error"] = "an account with the chosen email or username already exists!";
        redirect("register.php");
    }
} else if ($method == "logout") {
    session_unset();
    $_SESSION["login_error"] = "sessione eliminata";
    redirect("login.php");
}

?>