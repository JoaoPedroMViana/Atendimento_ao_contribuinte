<?php
    include('protecao.php');    
    include('Mysql.php');
    define('HOST', 'localhost');
    define('DB','prefeitura');
    define('USER', 'root');
    define('PASS', '');
    $pdo = MySql::connect();

    if(isset($_SESSION['msg_success_cadastro'])){
        unset($_SESSION['msg_success_cadastro']);
        session_write_close();
    }else if(isset($_SESSION['msg_error_cadastro'])){
        unset($_SESSION['msg_error_cadastro']);
        session_write_close();
    }

    if(isset($_SESSION['msg_success_gerenciar'])){
        unset($_SESSION['msg_success_gerenciar']);
        session_write_close();
    }else if(isset($_SESSION['msg_error_gerenciar'])){
        unset($_SESSION['msg_error_gerenciar']);
        session_write_close();
    }

    if(isset($_POST['excluir_processo-consulta'])){
        header("Location: http://localhost/Projeto_prefeitura/gerenciar.php?consultar_numero=".$_POST['excluir_processo-consulta']."&pesquisar_numero=pesquisar");
        $_SESSION['modal_excluir-processo'] = 'true';
    }
    if(isset($_POST['excluir_pessoa-consulta'])){
        header("Location: http://localhost/Projeto_prefeitura/gerenciar.php?consultar_id=".$_POST['excluir_pessoa-consulta']."&pesquisar_id=pesquisar".$_POST['excluir_processo-consulta']."&pesquisar_numero=pesquisar");
        $_SESSION['modal_excluir-pessoa'] = 'true';
    }

    
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar</title>
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="src/img/Brasao_Sao_Leopoldo.ico" type="image/x-icon">
  </head>
  <body class="overflow-hidden">
    <nav class="p-2 navbar navbar-expand-lg bg-dark " data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href=""><i class="bi bi-search"> Consultar | </i></a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="gerenciar.php">Gerenciar</a>
                    </div>
                    <div>
                        <i class="text-secondary">/</i>
                    </div>
                    <div class="navbar-nav">
                        <a class="nav-link" href="cadastro.php">Cadastrar</a>
                    </div>
                </div>
                <div>
                    <a id="sair" class="text-light"href="sair.php">
                        <i class="bi bi-box-arrow-right"> sair</i>
                    </a>
                </div>
            </div>
        </nav>

        <section class="container-fluid bg-secondary">
            <div class="row">
                <div class="text-center align-items-center col-4 vh-100 bg-light">
                        <form class="mt-5 mb-3" method="post">
                            <div class="mb-3">
                                <button class="px-5 btn btn-primary"type="submit" name="pessoaC"value="Pessoa"><i class="bi bi-person-add"> Pessoa</i></button>
                            </div>
                            <div>
                                <button class="px-5 btn btn-primary"type="submit" name="processoC"value="Processo"><i class="bi bi-folder-plus"> Processo</i></button>
                            </div>
                        </form>
                        <div class="container h-100">
                            <img class="img-thumbnail h-50 mt-4" src="src\img\logoPrefeitura.png" alt="Logo Prefeitura">
                        </div>
                </div>
                <div class="col-8 position-relative">
                    <?php
                        if(isset($_POST['pessoaC'])){
                            include('consultarPessoa.php');

                        }else if(isset($_POST['processoC'])){
                            include('consultarProcesso.php');

                        }else if(isset($_POST['pesquisar_nome'])){
                            include('consultarPessoa.php');

                        }else if(isset($_POST['pesquisar_numero'])){
                            include('consultarProcesso.php');
                            
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