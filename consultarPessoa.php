<?php

    if(isset($_POST['excluir_pessoa']) && isset($_GET['consultar_id'])){
        if($conteudo == null){
          
        }else{
          $_SESSION['modal_excluir-pessoa'] = 'true';
        }
      }
      if(isset($_POST['cancelar-modal-pessoa'])){
        $_SESSION['modal_excluir-pessoa'] ='false';
       } else if(isset($_POST['confirmar-modal-pessoa'])){
           try{
                $idPessoa = $_SESSION['idPessoaExcluir'];
                $sql = $pdo->prepare("DELETE FROM `pessoas` WHERE `id` = ?");
                $sql->execute(array($idPessoa));
                $_SESSION['modal_excluir-pessoa'] ='false';
                $_SESSION['msg_success_gerenciar'] = 'Pessoa excluida.';
                unset($_POST['excluir_pessoa-consulta']);  
                unset($_SESSION['idPessoaExcluir']);   
                session_write_close();       
            }catch(Exception $e){
                $_SESSION['modal_excluir-pessoa'] ='false';
                $_SESSION['msg_error_gerenciar'] = 'Erro ao excluir pessoa.';
            }
        }
    
      if(isset($_SESSION['modal_excluir-pessoa']) && $_SESSION['modal_excluir-pessoa'] == 'true'){
        echo '
        <div id="container-modal-pessoa" class="absolute z10">
            <div id="modal-excluir-pessoa" class="modal-excluir">
                <div class="header">
                    <h5>Excluir pessoa</h5>
                </div>
                <div class="body">
                    <p>Deseja excluir está pessoa?</p>
                </div>  
                <form method="POST" class="footer">
                    <button type="submit" name="confirmar-modal-pessoa" value="confirmar-modal-pessoa" class="btn btn-success">Confirmar</button>
                    <button type="submit" name="cancelar-modal-pessoa" value="cancelar-modal-pessoa" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
        '
        ;
    }
?>
<div class="w100 d-flex position-absolute top-0 mt-2 flex-row justify-content-center z9">
        <?php
            if(isset($_SESSION['msg_success_gerenciar'])){
                echo '
                <div class="alert alert-success p-0 d-flex align-items-center">
                    <p class="m-0 p-2">'.$_SESSION['msg_success_gerenciar'].'</p>
                    <form method="POST">
                        <input type="hidden" name="fechar-msg" value="fechar">
                        <input type="submit" name="fechar-msg" value="X" class="btn btn-outline-dark btn-sm m-2">
                    </form>
                </div>';
            }else if(isset($_SESSION['msg_error_gerenciar'])){
                echo '
                <div class="alert alert-danger p-0 d-flex align-items-center">
                    <p class="m-0 p-2">'.$_SESSION['msg_error_gerenciar'].'</p>
                    <form method="POST">
                        <input type="hidden" name="fechar-msg" value="fechar">
                        <input type="submit" name="fechar-msg" value="X" class="btn btn-outline-dark btn-sm m-2">
                    </form>
                </div>';
            }
        ?>
</div>
<form class="m-3 border-bottom" method="post">
    <div class="input-group mb-2 text-light">
        <label class="form-label mt-1 mx-3" for="procurar_nome">Pesquisar nome:</label>
        <input class="form-control rounded" type="text" id="procurar_nome" name="procurar_nome">
        <div class="input-group-prepend z9">
            <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_nome"value="pesquisar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</form>

<div class="h-400 overflow-auto mx-2 bg-light rounded ">
    <table class="table table-striped table-bordered table-hover">
        <?php 
            if(isset($_POST['procurar_nome'])&&$_POST['procurar_nome'] != null){
                $nome = $_POST['procurar_nome'];
                echo '<caption class="mx-3">Lista de pessoas com: "'.$nome.'" no nome. </caption>';
            }
        ?>
        <thead>
            <tr class="table-dark">
            <th class="p-1"scope="col">Id</th>
            <th class="p-1"scope="col">Nome</th>
            <th class="p-1"scope="col">Data nascimento</th>
            <th class="p-1"scope="col">CPF</th>
            <th class="p-1"scope="col">Sexo</th>
            <th class="p-1"scope="col">Cidade</th>
            <th class="p-1"scope="col">Bairro</th>
            <th class="p-1"scope="col">Rua</th>
            <th class="p-1"scope="col">N°</th>
            <th class="p-1"scope="col">Compl.</th>
            <th class="p-0"scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['pesquisar_nome'])){
                    $nome_pesquisado = '%'.$_POST['procurar_nome'].'%';
                    $sql = $pdo->prepare("SELECT * FROM `pessoas` WHERE `nome` LIKE ? ORDER BY `nome` ASC");
                    $sql->execute(array($nome_pesquisado));
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>
                            <td class="align-middle">'.$value['4'].'</td>
                            <td class="align-middle">'.$value['5'].'</td>
                            <td class="align-middle">'.$value['6'].'</td>
                            <td class="align-middle">'.$value['7'].'</td>
                            <td class="align-middle">'.$value['8'].'</td>
                            <td class="align-middle">'.$value['9'].'</td>';
                            echo '
                                <td class="d-flex flex-column gap align-items-center p-1">
                                  <form method="GET">
                                        <input value="'.$value['0'].'" type="hidden" name="consultar_id" id="consultar_id">
                                        <button name="botao-gerenciar-pessoa" id="botao-gerenciar-pessoa" type="submit" class="btn btn-warning mt-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>
                                <form method="POST">
                                    <input value="'.$value['0'].'" type="hidden" name="excluir_pessoa-consulta" id="excluir_pessoa-consulta">
                                    <button name="botao-excluir-pessoa" id="botao-excluir-pessoa" type="submit" class="btn btn-danger mb-2">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td></tr>';
                        }
                    }
                }else{
                    $sql = $pdo->prepare("SELECT * FROM `pessoas` ORDER BY `nome` ASC");
                    $sql->execute();
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>
                            <td class="align-middle">'.$value['4'].'</td>
                            <td class="align-middle">'.$value['5'].'</td>
                            <td class="align-middle">'.$value['6'].'</td>
                            <td class="align-middle">'.$value['7'].'</td>
                            <td class="align-middle">'.$value['8'].'</td>
                            <td class="align-middle">'.$value['9'].'</td>';
                            echo '
                                <td class="d-flex flex-column gap align-items-center p-1">
                                    <form method="GET">
                                        <input value="'.$value['0'].'" type="hidden" name="consultar_id" id="consultar_id">
                                        <button name="botao-gerenciar-pessoa" id="botao-gerenciar-pessoa" type="submit" class="btn btn-warning mt-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>

                                    <form method="POST">
                                        <input value="'.$value['0'].'" type="hidden" name="excluir_pessoa-consulta" id="excluir_pessoa-consulta">
                                        <button name="botao-excluir-pessoa" id="botao-excluir-pessoa" type="submit" class="btn btn-danger mb-2">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td></tr>';
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>

