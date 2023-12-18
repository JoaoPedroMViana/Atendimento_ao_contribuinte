<?php
    include('protecao.php');
    include('Mysql.php');
    define('HOST', 'localhost');
    define('DB','prefeitura');
    define('USER', 'root');
    define('PASS', '');
    $pdo = MySql::connect();

    if(isset($_SESSION['msg_success_gerenciar'])){
        unset($_SESSION['msg_success_gerenciar']);
        session_write_close();
    }else if(isset($_SESSION['msg_error_gerenciar'])){
        unset($_SESSION['msg_error_gerenciar']);
        session_write_close();
    }

    if(isset($_POST['enviado'])){
        if(isset($_SESSION['msg_success_cadastro'])){
            unset($_SESSION['msg_success_cadastro']);
            session_write_close();
        }else if(isset($_SESSION['msg_error_cadastro'])){
            unset($_SESSION['msg_error_cadastro']);
            session_write_close();
        }
        $inputsEmBranco = 0;
        if(!isset($_POST['nome'])){
            $inputsEmBranco += 1;
        }
        if(!isset($_POST['data_nascimento']) || $_POST['data_nascimento'] == null){
            $inputsEmBranco += 1;
        }
        if(!isset($_POST['cpf'])){
            $inputsEmBranco += 1;
        }
        if(!isset($_POST['sexo']) || $_POST['sexo'] == null || $_POST['sexo'] == ''){
            $inputsEmBranco += 1;
        }

        if($inputsEmBranco > 0){
            $_SESSION['nome_pessoa'] = $_POST['nome'];
            $_SESSION['data_nascimento_pessoa'] = $_POST['data_nascimento'];
            $_SESSION['cpf'] = $_POST['cpf'];
            if(isset($_POST['sexo'])){
                $_SESSION['sexo'] = $_POST['sexo'];
            }
            $_SESSION['cidade'] = $_POST['cidade'];
            $_SESSION['bairro'] = $_POST['bairro'];
            $_SESSION['rua'] = $_POST['rua'];
            $_SESSION['numero'] = $_POST['numero'];
            $_SESSION['complemento'] = $_POST['complemento'];
            $_SESSION['msg_error_cadastro'] = 'Preencha os campos obrigatórios.';
        }else{
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['data_nascimento'];
            $cpf = $_POST['cpf'];
            $sexo = $_POST['sexo'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];
            $rua = $_POST['rua'];
            $numero = $_POST['numero'];
            $complemento = $_POST['complemento'];
    
            $sql = $pdo->prepare("INSERT INTO `pessoas` VALUES(null, ?,?,?,?,?,?,?,?,?)");
            try{
                $sql->execute(array($nome,$dataNascimento,$cpf,$sexo, $cidade, $bairro, $rua, $numero, $complemento));
                $_SESSION['msg_success_cadastro'] = 'Pessoa cadastrada.';
                unset($_SESSION['nome_pessoa']);
                unset($_SESSION['data_nascimento_pessoa']);
                unset($_SESSION['cpf']);
                unset($_SESSION['sexo']);
                unset($_SESSION['cidade']);
                unset($_SESSION['bairro']);
                unset($_SESSION['rua']);
                unset($_SESSION['numero']);
                unset($_SESSION['complemento']);
                session_write_close();
            }catch(Exception $e){
                $_SESSION['msg_error_cadastro'] = 'Erro ao cadastrar pessoa.';
            } 
        }
    }else if(isset($_POST['confirmar'])){
        if(isset($_SESSION['msg_success_cadastro'])){
            unset($_SESSION['msg_success_cadastro']);
            session_write_close();
        }else if(isset($_SESSION['msg_error_cadastro'])){
            unset($_SESSION['msg_error_cadastro']);
            session_write_close();
        }

        $inputsEmBranco = 0;
        if(!isset($_POST['descricao']) || $_POST['descricao'] == '' || $_POST['descricao'] == null){
            $inputsEmBranco += 1;
        }
        if(!isset($_POST['prazo']) || $_POST['prazo'] == '' || $_POST['prazo'] == null){
            $inputsEmBranco += 1;
        } 

        if(!isset($_POST['id_pessoa']) || $_POST['id_pessoa'] == '' || $_POST['id_pessoa'] == null){
            $inputsEmBranco += 1;
        } 

        if(!isset($_POST['dataRegistro']) || $_POST['dataRegistro'] == null){
            $inputsEmBranco += 1;
        }

        if($inputsEmBranco > 0){
            $_SESSION['descricao'] = $_POST['descricao'];
            $_SESSION['prazo'] = $_POST['prazo'];
            $_SESSION['msg_error_cadastro'] = 'Preencha os campos obrigatórios.';
        }else{
            $id_pessoa = $_POST['id_pessoa'];
            $descricao = $_POST['descricao'];
            $prazo = $_POST['prazo'];
            $dataRegistro = date('Y-m-d');;
            
            $sql = $pdo->prepare("INSERT INTO `processos` VALUES(null, ?,?,?,?)");
            try{
                $sql->execute(array($descricao, $dataRegistro, $prazo, $id_pessoa));
                $_SESSION['msg_success_cadastro'] = 'Processo cadastrado.';
                unset($_SESSION['descricao']);
                unset($_SESSION['prazo']);
                session_write_close();
            }catch(Exception $e){
                $_SESSION['msg_error_cadastro'] = 'Erro ao cadastrar processo.';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar</title>
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="src/img/Brasao_Sao_Leopoldo.ico" type="image/x-icon">
  </head>
  <body class="overflow-hidden">
    <nav class="p-2 navbar navbar-expand-lg bg-dark " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href=""><i class="bi bi-file-earmark-text"> Cadastrar | </i></a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="gerenciar.php">Gerenciar</a>
                </div>
                <div>
                    <i class="text-secondary">/</i>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="consultar.php">Consultar</a>
                </div>
            </div>
            <div>
                <a id="sair"class="text-light" href="sair.php">
                    <i class="bi bi-box-arrow-right">sair</i>
                </a>
            </div>
        </div>
    </nav>
    
    <section class="container-fluid bg-secondary">
        <div class="row">
            <div class="text-center align-items-center col-4 vh-100 bg-light">
                    <form class="mt-5 mb-3" method="post">
                        <div class="mb-3">
                            <button class="px-5 btn btn-primary"type="submit" name="pessoa"value="Pessoa"><i class="bi bi-person-add"> Pessoa</i></button>
                        </div>
                        <div>
                            <button class="px-5 btn btn-primary"type="submit" name="processo"value="Processo"><i class="bi bi-folder-plus"> Processo</i></button>
                        </div>
                    </form>
                    <div class="container h-100">
                        <img class="img-thumbnail h-50 mt-4" src="src\img\logoPrefeitura.png" alt="Logo Prefeitura">
                    </div>
            </div>
            <div class="col-8 position-relative">
                <?php
                    if(isset($_POST['pessoa'])){
                        unset($_SESSION['nome_pessoa']);
                        unset($_SESSION['data_nascimento_pessoa']);
                        unset($_SESSION['cpf']);
                        unset($_SESSION['sexo']);
                        unset($_SESSION['cidade']);
                        unset($_SESSION['bairro']);
                        unset($_SESSION['rua']);
                        unset($_SESSION['numero']);
                        unset($_SESSION['complemento']);
                        if(isset($_SESSION['msg_success_cadastro'])){
                            unset($_SESSION['msg_success_cadastro']);
                            session_write_close();
                            include('formPessoa.php');
                        }else if(isset($_SESSION['msg_error_cadastro'])){
                            unset($_SESSION['msg_error_cadastro']);
                            session_write_close();
                            include('formPessoa.php');
                        }else{
                            include('formPessoa.php');
                        }

                    }else if(isset($_POST['enviado'])){
                        include('formPessoa.php');

                    }else if(isset($_POST['processo'])){
                        unset($_SESSION['descricao']);
                        unset($_SESSION['prazo']);
                        if(isset($_SESSION['msg_success_cadastro'])){
                            unset($_SESSION['msg_success_cadastro']);
                            session_write_close();
                            include('formProcesso.php');
                        }else if(isset($_SESSION['msg_error_cadastro'])){
                            unset($_SESSION['msg_error_cadastro']);
                            session_write_close();
                            include('formProcesso.php');
                        }else{
                            include('formProcesso.php');
                        }

                    }else if(isset($_POST['confirmar'])){
                        include('formProcesso.php');
                    }
                    

                ?>
            </div>
        </div>
    </section>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script>
       let sair = document.getElementById('sair');
       sair.addEventListener('click', function(){
        sessionStorage.setItem('logout', 'logout');
       });
    </script>
  </body>
</html>