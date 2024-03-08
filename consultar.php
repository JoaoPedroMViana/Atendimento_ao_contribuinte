<?php
    include('protecao.php');    
    include('Mysql.php');
    define('HOST', 'localhost');
    define('DB','prefeitura');
    define('USER', 'root');
    define('PASS', '');
    $pdo = MySql::connect();

    if(isset($_POST['fechar-msg'])){
      unset($_POST['fechar-msg']);
      unset($_SESSION['msg_success_gerenciar']);
      unset($_SESSION['msg_error_gerenciar']);
      session_write_close();
    }

    if(isset($_SESSION['msg_success_cadastro'])){
        unset($_SESSION['msg_success_cadastro']);
        session_write_close();
    }else if(isset($_SESSION['msg_error_cadastro'])){
        unset($_SESSION['msg_error_cadastro']);
        session_write_close();
    }

    if(isset($_POST['excluir_processo-consulta'])){
        $_SESSION['consultarNumero'] = $_POST['excluir_processo-consulta'];
        $_SESSION['modal_excluir-processo'] = 'true';
    }
    if(isset($_POST['excluir_pessoa-consulta'])){
        $_SESSION['idPessoaExcluir'] = $_POST['excluir_pessoa-consulta'];
        $_SESSION['modal_excluir-pessoa'] = 'true';
    }

    //gerenciar processo:
  if(isset($_GET['consultar_numero'])){
    if(isset($_GET['consultar_numero'])){
      $numero_processo = $_GET['consultar_numero'];
      $sql = $pdo->prepare("SELECT * FROM `processos` WHERE `numero` = ?");
      $sql->execute(array($numero_processo));
      $conteudo = $sql->fetchAll();
      if($conteudo == null){
      
      }else{
        $id_demandante = $conteudo['0']['4'];
        $descricao = $conteudo['0']['1'];
        $data_processo = $conteudo['0']['2'];
        $prazo = $conteudo['0']['3'];
        $gerenciarBotao = true;
      }
    }
  }

  if(isset($_POST['processo_enviar'])){
    $inputsVazios = 0;

    if(isset($_POST['demandante_processo']) && $_POST['demandante_processo'] == ''){
      $inputsVazios += 1;
    }

    if(!isset($_POST['descricao_processo']) || $_POST['descricao_processo'] == '' || $_POST['descricao_processo'] == null){
      $inputsVazios += 1;
    }

    if(!isset($_POST['data_atual']) || $_POST['data_atual'] == null || $_POST['data_atual'] == '0000-00-00'){
      $inputsVazios += 1;
    }

    if(!isset($_POST['prazo_processo']) || $_POST['prazo_processo'] == null || $_POST['prazo_processo'] == 0){
      $inputsVazios += 1;
    }

    if($inputsVazios > 0){
      $_SESSION['msg_error_gerenciar'] = 'Erro: dados vazios.';
    }else{
      $id_demandante = $_POST['demandante_processo'];
      $descricao = $_POST['descricao_processo'];
      $data_processo = $_POST['data_atual'];
      $prazo = $_POST['prazo_processo'];
  
      $sql = $pdo->prepare("UPDATE `processos` SET `descricao` = ?, `data_de_registro` = ?, `prazo` = ?, `id_pessoa` = ? WHERE `numero` = $numero_processo");
  
      try{
        $sql->execute(array($descricao, $data_processo, $prazo, $id_demandante));
        $_SESSION['msg_success_gerenciar'] = 'Processo editado.';
      }catch(Exception $e){
        $_SESSION['msg_error_gerenciar'] = 'Erro ao editar processo.';
      }
      header('Location: consultar.php?processoC=Processo');
    }
 
  }

  // gerenciar pessoa:
  if(isset($_GET['consultar_id'])){
    if(isset($_GET['consultar_id'])){
      $id_pessoa = $_GET['consultar_id'];
      $sql = $pdo->prepare("SELECT * FROM `pessoas` WHERE `id` = ?");
      $sql->execute(array($id_pessoa));
      $conteudo = $sql->fetchAll();
      if($conteudo == null){
      
      }else{
        $nome = $conteudo['0']['1'];
        $data_nascimento = $conteudo['0']['2'];
        $cpf = $conteudo['0']['3'];
        $sexo = $conteudo['0']['4'];
        $cidade = $conteudo['0']['5'];
        $bairro = $conteudo['0']['6'];
        $rua = $conteudo['0']['7'];
        $numero = $conteudo['0']['8'];
        $complemento = $conteudo['0']['9'];
        $gerenciarBotao = true;
      }
    }
  }
  if(isset($_POST['gerPessoa_enviar'])){
    $inputsVazios = 0;

    if(!isset($_POST['nome_demandante']) || $_POST['nome_demandante'] == '' || $_POST['nome_demandante'] == null){
      $inputsVazios += 1;
    }

    if(!isset($_POST['data_demandante']) || $_POST['data_demandante'] == null || $_POST['data_demandante'] == '0000-00-00'){
      $inputsVazios += 1;
    }

    if(!isset($_POST['cpf_demandante']) || $_POST['cpf_demandante'] == '' || $_POST['cpf_demandante'] == null){
      $inputsVazios += 1;
    }

    if($inputsVazios > 0){
      $_SESSION['msg_error_gerenciar'] = 'Erro: dados vazios.';
    }else{
      $nome = $_POST['nome_demandante'];
      $data_nascimento = $_POST['data_demandante'];
      $cpf = $_POST['cpf_demandante'];
      $sexo = $_POST['sexo_demandante'];
      $cidade = $_POST['cidade_demandante'];
      $bairro = $_POST['bairro_demandante'];
      $rua = $_POST['rua_demandante'];
      $numero = $_POST['numero_demandante'];
      $complemento = $_POST['complemento_demandante'];
    
      $sql = $pdo->prepare("UPDATE `pessoas` SET `nome` = ?, `data_nascimento` = ?, `cpf` = ?, `sexo` = ?, `cidade` = ?, `bairro` = ?, `rua` = ?, `numero` = ?, `complemento` = ? WHERE `id` = $id_pessoa");
  
      try{
        $sql->execute(array($nome, $data_nascimento, $cpf, $sexo, $cidade, $bairro, $rua, $numero, $complemento));
        $_SESSION['msg_success_gerenciar'] = 'Pessoa editada.';
      }catch(Exception $e){
        $_SESSION['msg_error_gerenciar'] = 'Erro ao editar pessoa.';
      }
      header('Location: consultar.php?pessoaC=Pessoa');
    }
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
                        <form class="mt-5 mb-3" method="GET">
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
                        if(isset($_GET['pessoaC'])){
                          if(isset($_SESSION['modal_excluir-processo'])){
                            $_SESSION['modal_excluir-processo'] ='false';
                          }  
                            include('consultarPessoa.php');

                        }else if(isset($_GET['processoC'])){
                          if(isset($_SESSION['modal_excluir-pessoa'])){
                            $_SESSION['modal_excluir-pessoa'] ='false';
                          }  
                            include('consultarProcesso.php');

                        }else if(isset($_POST['pesquisar_nome'])){
                            include('consultarPessoa.php');

                        }else if(isset($_POST['pesquisar_numero'])){
                            include('consultarProcesso.php');
                            
                        }else if(isset($_GET['consultar_id'])){
                            if(isset($_SESSION['modal_excluir-pessoa'])){
                              $_SESSION['modal_excluir-pessoa'] ='false';
                              include('gerPessoa.php');
                            }else{
                              include('gerPessoa.php');
                            } 
                          }else if(isset($_GET['consultar_numero'])){
                             if(isset($_SESSION['modal_excluir-processo'])){
                              $_SESSION['modal_excluir-processo'] ='false';
                              include('gerProcesso.php');
                            }else{
                              include('gerProcesso.php');
                            }
                            
                
                          }else if(isset($_GET['pesquisar_id']) || isset($_GET['excluir_pessoa']) || isset($_POST['gerPessoa_enviar'])){
                            include('gerPessoa.php');
          
                          }else if(isset($_GET['pesquisar_numero']) || isset($_GET['excluir_processo']) || isset($_POST['processo_enviar'])){
                            include('gerProcesso.php');
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
        <?php
  
            if(isset($_POST['excluir_pessoa']) || $_SESSION['modal_excluir-pessoa'] == 'true'){
                echo '$("#container-modal-pessoa").fadeIn("1500");$("#modal-excluir-pessoa").fadeIn("2400");';
            }
            if(isset($_POST['excluir_processo']) || $_SESSION['modal_excluir-processo'] == 'true'){
                echo '$("#container-modal-processo").fadeIn("1500");$("#modal-excluir-processo").fadeIn("2400");';
            }
        ?>
        
    </script>
  </body>
</html>