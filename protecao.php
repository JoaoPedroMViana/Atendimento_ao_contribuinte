<?php

    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['usuario'])){
        die('<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="src\css\style.css">
            <link href="src/css/bootstrap.min.css" rel="stylesheet">
            <title>Faça o login</title>
        </head>
        <body class="bg-secondary">
            <div class="container w-100 text-light">
                <div class="row justify-content-center align-items-center vh-100 position-relative text-center">
                    <p>Faça o login para acessar esta página: <a href="index.php">Login</a></p>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="src/js/bootstrap.min.js"></script>
        </body>
        </html>');
    }
?>

