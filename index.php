<?php
    include('Mysql.php');
    define('HOST', 'localhost');
    define('DB','prefeitura');
    define('USER', 'root');
    define('PASS', '');
    $pdo = MySql::connect();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="shortcut icon" href="src/img/Brasao_Sao_Leopoldo.ico" type="image/x-icon">
  </head>
  <body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100 position-relative text-center d-flex flex-column">
          <div id="div_logout" class="position-absolute top-0 row justify-content-center"></div>
            <?php

              if(isset($_POST['email']) && isset($_POST['pass']) ){
                $email = $_POST['email'];
                $senha = $_POST['pass'];
                
                $sql = $pdo->prepare("SELECT * FROM `usuarios` WHERE `email`= ? LIMIT 1");
                $sql->execute(array($email));
                $conteudo = $sql->fetchAll();
                if($conteudo == null){
                  echo '<p class="alert alert-danger m-4 w-25 position-absolute top-0">Email não encontrado!</p>';
                }elseif(!password_verify($senha, $conteudo[0]['senha'])){
                  echo '<p class="alert alert-danger m-4 w-25 position-absolute top-0">Senha incorreta!</p>';
                }else{
                  if(!isset($_SESSION)){
                    session_start();
                  }
                  $_SESSION['usuario'] = $conteudo[0]['id'];
                  header("Location: menu.php");
                }
              }
            ?>
            <form id="form" method="post" class="p-4 col-md-5 bg-light text-center rounded">
                    <div class="m-3 text-start">
                      <label for="email" class="form-label">Email:</label>
                      <input type="email" id="email" name="email" class="form-control" autofucos required>
                    </div>
                    <div class="m-3 text-start">
                      <label for="pass" class="form-label">Senha:</label>
                      <div class="position-relative">
                        <input type="password" id="pass" name="pass" class="form-control" required>
                        <input type="checkbox" name="mostrar-senha" id="mostrar-senha" class="mostrar-senha">
                        <label for="mostrar-senha" class="label-mostrar-senha"></label>
                      </div>
                    </div>
                    <div class="m-3">
                      <button id="enviar" type="submit" class="btn btn-primary form-control" name="entrar" value="entrar">Entrar</button>
                    </div>
                    <div class="m-3">
                      <p>Não possui cadastro? click <a href="cadastro-usuario.php">aqui</a></p>
                    </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/script.js"></script>
    <script>
      let input_email = document.getElementById('email');
      let form = document.getElementById('form');
      let div_logout = document.getElementById('div_logout');
      let botao_submit = document.getElementById('enviar');

      sessionStorage.removeItem('nome');
      sessionStorage.removeItem('email');
      input_email.value = sessionStorage.getItem('email_usuario');
      form.addEventListener('submit', function(){
        sessionStorage.setItem('email_usuario', input_email.value);
        sessionStorage.removeItem('logout');
      });
  
      if(sessionStorage.getItem('logout') == 'logout'){
        div_logout.innerHTML = div_logout.innerHTML+'<p class="alert alert-danger m-4 w-25 ">Logout!</p>';
      }

    </script>
  </body>
</html>