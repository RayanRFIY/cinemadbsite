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


    <div id="register-form" class="text-center">
        <div class="h-100 pb-5 ps-5 pe-5">
            <form action="process.php" method="post" class="h-100 d-flex flex-column justify-content-around pt-4">
                <h3 class="pb-2">REGISTER FORM</h3>
                <label for="email" class="label">Email</label>
                <input type="email  " name="email" class="input" required>
                <label for="nome" class="label">Nome</label>
                <input type="text" name="nome" class="input" required>
                <label for="cognome" class="label">Cognome</label>
                <input type="text" name="cognome" class="input" required>
                <label for="username" class="label">Username</label>
                <input type="text" name="username" class="input" required>
                <label for="password" class="label">Password</label>
                <input type="password" name="password" class="input" required>
                <br>
                <input type="text" name="method" class="d-none" value="register">
                <button class="btn btn-primary" type="submit">INVIA</button>
            </form>
            <a class="fake-link" href="login.php">hai già un account?</a>
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