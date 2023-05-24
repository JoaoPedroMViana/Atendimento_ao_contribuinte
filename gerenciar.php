<?php
  include('Mysql.php');
  define('HOST', 'localhost');
  define('DB','prefeitura');
  define('USER', 'root');
  define('PASS', '');
  $pdo = MySql::connect();

  //gerenciar processo:
  if(isset($_GET['pesquisar_numero'])){
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
    $id_demandante = $_POST['demandante_processo'];
    $descricao = $_POST['descricao_processo'];
    $data_processo = $_POST['data_atual'];
    $prazo = $_POST['prazo_processo'];

    $sql = $pdo->prepare("UPDATE `processos` SET `descricao` = ?, `data_de_registro` = ?, `prazo` = ?, `id_pessoa` = ? WHERE `numero` = $numero_processo");
    $sql->execute(array($descricao, $data_processo, $prazo, $id_demandante));
  }

  if(isset($_POST['excluir_processo']) && isset($_GET['consultar_numero'])){
    if($conteudo == null){
      
    }else{
      $sql = $pdo->prepare("DELETE FROM `processos` WHERE `numero` = ?");
      $sql->execute(array($numero_processo));
    }
  }

  // gerenciar pessoa:
  if(isset($_GET['pesquisar_id'])){
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
    $sql->execute(array($nome, $data_nascimento, $cpf, $sexo, $cidade, $bairro, $rua, $numero, $complemento));
  }

  if(isset($_POST['excluir_pessoa']) && isset($_GET['consultar_id'])){
    if($conteudo == null){
      
    }else{
      $sql = $pdo->prepare("DELETE FROM `pessoas` WHERE `id` = ?");
      $sql->execute(array($id_pessoa));
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="overflow-hidden">
    <nav class="p-3 navbar navbar-expand-lg bg-dark " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href=""><i class="bi bi-gear"> Gerenciar | </i></a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="cadastro.php">Cadastrar</a>
                </div>
                <div>
                  <i class="text-secondary">/</i>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="consultar.php">Consultar</a>
                </div>
            </div>
            <div>
                <a class="text-light"href="index.php">
                    <i class="bi bi-box-arrow-right"> sair</i>
                </a>
            </div>
        </div>
    </nav>

    <section class="container-fluid bg-secondary">
        <div class="row">
            <div class="text-center align-items-center col-4 vh-100 bg-light">
                    <form class="mt-5 mb-3">
                        <div class="mb-3">
                          <button class="px-5 btn btn-primary" type="submit" name="pessoaG" value="Pessoa"><i class="bi bi-person-add"> Pessoa</i></button>
                        </div>
                        <div>
                          <button class="px-5 btn btn-primary" type="submit" name="processoG"value="Processo"><i class="bi bi-folder-plus"> Processo</i></button>
                        </div>
                    </form>
                    <div class="container h-100">
                        <img class="img-thumbnail h-50 mt-4" src="img\logoPrefeitura.png" alt="Logo Prefeitura">
                    </div>
            </div>
            <div class="col-8">
              <?php
                if(isset($_GET['pessoaG'])){
                  include('gerPessoa.php');
                    
                }else if(isset($_GET['processoG'])){
                  include('gerProcesso.php');
      
                }else if(isset($_GET['pesquisar_id']) || isset($_GET['excluir_pessoa']) || isset($_POST['gerPessoa_enviar'])){
                  include('gerPessoa.php');

                }else if(isset($_GET['pesquisar_numero']) || isset($_GET['excluir_processo']) || isset($_POST['processo_enviar'])){
                  include('gerProcesso.php');
                }
              ?>
            </div>
        </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $("#gerenciar_pessoa").on("click", 
        function tirarDisable(){
          $("#nome_demandante, #data_demandante, #cpf_demandante, #sexo_demandante, #cidade_demandante, #bairro_demandante, #rua_demandante, #numero_demandante, #complemento_demandante, #gerPessoa_enviar").removeAttr("disabled");
        }
      )
      
      $("#gerenciar_processo").on("click", 
        function tirarDisable(){
          $("#demandante_processo, #descricao_processo, #data_atual, #prazo_processo, #processo_enviar").removeAttr("disabled");
        }
      )
      <?php
        if($gerenciarBotao){
          echo '$("#gerenciar_processo, #gerenciar_pessoa").removeAttr("disabled");';
        }
      ?>
    </script>
  </body>
</html>