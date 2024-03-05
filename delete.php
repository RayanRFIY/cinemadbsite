<?php
    session_start();
    
    include_once("./connectdb.php");

    $conn = getConn();

    $lastpage = "./index.php";
    include_once("./credentialscheck.php");
    
    checkSessionCredentials($conn);

    $table = $_POST["table"];
    $pk = $_POST["pk"];
    $pkvalue = $_POST["pkvalue"];

    if(!isValid($table) || !isValid($pk) || !isValid($pkvalue))
        redirect($lastpage);

    $sql = "delete from $table where $pk = '$pkvalue'";

    $conn->query($sql);

    $_SESSION["query_status"] = $conn->affected_rows > 0;

    redirect($lastpage);
?>