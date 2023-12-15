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
    <title>Cadastro</title>
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="shortcut icon" href="src/img/Brasao_Sao_Leopoldo.ico" type="image/x-icon">
  </head>
  <body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100 position-relative text-center d-flex flex-column">
            <div class="gap d-flex position-absolute top-0 flex-row justify-content-center">
                <?php
                    $error = 0;
                    if(isset($_POST['nome'])){
                        $nome = $_POST['nome'];
                        if(strlen($nome) < 8){
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Nome curto. </p>';
                        }
                    }

                    if(isset($_POST['email'])){
                        $email = $_POST['email'];
                        $sql = $pdo->prepare("SELECT * FROM `usuarios` WHERE `email` = ?");
                        $sql->execute(array($email));
                        $conteudo = $sql->fetchAll();
                        if($conteudo == null){

                        }else{
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Email já cadastrado. </p>';
                        }
                    }

                    if(isset($_POST['pass'])){
                        $senha = $_POST['pass'];
                        $confirmar_senha = $_POST['pass2'];
                        if(!preg_match('/[@_]/', $senha)) {
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Senha não contém @ ou _. </p>';
                        }
                        
                        if(!preg_match('/[0-9]/', $senha)) {
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Senha não contém números. </p>';
                        }
                        
                        if(!preg_match('/[A-Z]/', $senha)) {
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Senha não contém letras maiúsculas. </p>';
                        }
                        
                        if(!preg_match('/[a-z]/', $senha)) {
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Senha não contém letras minúsculas. </p>';
                        }

                        if(strlen($senha) < 8){
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Senha curta. </p>';
                        }

                        if($senha != $confirmar_senha){
                            $error += 1;
                            echo '<p class="mt-2 alert alert-danger">Senhas diferentes. </p>';
                        }
                    }
                    
                    if($error == 0 && isset($_POST['cadastrar'])){
                        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
                        $sql = $pdo->prepare("INSERT INTO `usuarios` VALUES(null, ?,?,?)");
                        $sql->execute(array($nome, $email, $senhaCriptografada));
                        echo '<p id="cadastrado" class="mt-2 alert alert-success" >Cadastrado!</p>';
                    }

                ?>
            </div>
            <form id="form" method="post" class="p-4 pb-1 pt-1 col-md-5 bg-light text-center rounded">
                    <div class="m-3 text-start">
                      <label for="nome" class="form-label">Nome:</label>
                      <input type="text" id="nome" name="nome" class="form-control" autofucos required>
                    </div>
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
                    <div class="m-3 text-start">
                      <label for="pass2" class="form-label">Confirme sua senha:</label>
                      <div class="position-relative">
                        <input type="password" id="pass2" name="pass2" class="form-control" required>
                        <input type="checkbox" name="mostrar-senha2" id="mostrar-senha2" class="mostrar-senha">
                        <label for="mostrar-senha2" class="label-mostrar-senha"></label>
                      </div>
                      <p class="text-secondary">Sua senha deve conter pelo menos 8 caracteres, entre eles: letras minúsculas, maiúsculas, @ ou _ e números.</p>
                    </div>
                    <div class="m-3">
                      <button type="submit" class="btn btn-primary form-control" name="cadastrar" value="cadastrar">Cadastrar</button>
                    </div>
                    <div class="m-3">
                      <p>Possui cadastro? click <a href="index.php">aqui</a></p>
                    </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/script.js"></script>
    <script>
        let cadastrado = document.getElementById('cadastrado');
        let nome = document.getElementById('nome');
        let email = document.getElementById('email');
        let form = document.getElementById('form');
        
        sessionStorage.removeItem('logout');
        sessionStorage.removeItem('email_usuario');
        nome.value = sessionStorage.getItem('nome');
        email.value = sessionStorage.getItem('email');

        form.addEventListener('submit', function(){
            sessionStorage.setItem('nome', nome.value);
            sessionStorage.setItem('email', email.value);
        });
        
        if(cadastrado == null){

        }else{
            sessionStorage.setItem('email_usuario', email.value);
            setTimeout(() => {
                window.location.href = "http://localhost/Projeto_prefeitura/index.php"
            }, 1500);
        }

    </script>
  </body>
</html>