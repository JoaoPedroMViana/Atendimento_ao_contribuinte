<?php

    if(isset($_POST['excluir_processo']) && isset($_GET['consultar_numero'])){
        if($conteudo == null){
          
        }else{
          $_SESSION['modal_excluir-processo'] = 'true';
        } 
      }
if(isset($_POST['cancelar-modal-processo'])){
    $_SESSION['modal_excluir-processo'] ='false';

}else if(isset($_POST['confirmar-modal-processo'])){
    $consultarNumero = $_SESSION['consultarNumero'];
    $sql = $pdo->prepare("DELETE FROM `processos` WHERE `numero` = ?");
    try{
        $sql->execute(array($consultarNumero));
        $_SESSION['modal_excluir-processo'] ='false';
        $_SESSION['msg_success_gerenciar'] = 'Processo excluida.';
        unset($_GET['consultar_numero']);
        unset($_SESSION['consultarNumero']);
        session_write_close();
    }catch(Exception $e){
        $_SESSION['modal_excluir-processo'] ='false';
        $_SESSION['msg_error_gerenciar'] = 'Erro ao excluir processo.';
    }
}
if(isset($_SESSION['modal_excluir-processo']) && $_SESSION['modal_excluir-processo'] == 'true'){
    echo '
    <div id="container-modal-processo" class="absolute z10">
        <div id="modal-excluir-processo" class="modal-excluir">
            <div class="header">
                <h5>Excluir processo</h5>
            </div>
            <div class="body">
                <p>Deseja excluir este processo?</p>
            </div>  
            <form method="POST" class="footer">
                <button type="submit" name="confirmar-modal-processo" value="confirmar-modal-processo" class="btn btn-success">Confirmar</button>
                <button type="submit" name="cancelar-modal-processo" value="cancelar-modal-processo" class="btn btn-danger">Cancelar</button>
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
        <label class="form-label mt-1 mx-3" for="procurar_numero">Pesquisar número:</label>
        <input class="form-control rounded" type="text" id="procurar_numero" name="procurar_numero">
        <div class="input-group-prepend">
            <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_numero"value="pesquisar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</form> 

<div class="overflow-auto mx-2 bg-light rounded h-400">
    <table class="table table-striped table-bordered table-hover">
        <?php 
            if(isset($_POST['procurar_numero']) && $_POST['procurar_numero'] != null){
                $numero = $_POST['procurar_numero'];
                echo '<caption class="mx-3">Lista de processos com : "'.$numero.'" no número. </caption>';
            }
        ?>
        <thead>
            <tr class="table-dark">
            <th scope="col">Número</th>
            <th scope="col">Descrição</th>
            <th scope="col">Data de Registro</th>
            <th scope="col">Prazo</th>
            <th scope="col">Demandante</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['pesquisar_numero'])){
                    $numero_pesquisado = '%'.$_POST['procurar_numero'].'%';
                    $sql = $pdo->prepare("SELECT * FROM `processos` WHERE `numero` LIKE ? ORDER BY `numero` ASC");
                    $sql->execute(array($numero_pesquisado));
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>';
                            $id_demandante = $value['4'];
                            $sqlNome = $pdo->prepare("SELECT `nome` FROM `pessoas` WHERE `id` = ?");
                            $sqlNome->execute(array($id_demandante));
                            $nome_id = $sqlNome->fetchAll(); 
                                if($nome_id == null){
                                    echo '<td></td>';
                                }else{
                                    echo '<td>'.$nome_id['0']['0'].'</td>';
                                }
                                echo ' 
                                <td class="d-flex flex-column gap align-items-center">
                                    <form method="GET">
                                        <input value="'.$value['0'].'" type="hidden" name="consultar_numero" id="consultar_numero">
                                        <button name="botao-gerenciar-pessoa" id="botao-gerenciar-pessoa" type="submit" class="btn btn-warning mt-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>
                                    <form method="POST">
                                        <input value="'.$value['0'].'" type="hidden" name="excluir_processo-consulta" id="excluir_processo-consulta">
                                        <button name="botao-excluir-processo" id="botao-excluir-processo" type="submit" class="btn btn-danger mb-2">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td></tr>';
                        }
                    }
                }else{
                    $sql = $pdo->prepare("SELECT * FROM `processos` ORDER BY `numero` ASC");
                    $sql->execute();
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>';
                            $id_demandante = $value['4'];
                            $sqlNome = $pdo->prepare("SELECT `nome` FROM `pessoas` WHERE `id` = ?");
                            $sqlNome->execute(array($id_demandante));
                            $nome_id = $sqlNome->fetchAll(); 
                                if($nome_id == null){
                                    echo '<td></td>';
                                }else{
                                    echo '<td>'.$nome_id['0']['0'].'</td>';
                                }
                                echo '
                                    <td class="d-flex flex-column align-items-center gap">
                                        <form method="GET">
                                            <input value="'.$value['0'].'" type="hidden" name="consultar_numero" id="consultar_numero">
                                            <button name="botao-gerenciar-pessoa" id="botao-gerenciar-pessoa" type="submit" class="btn btn-warning mt-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST">
                                            <input value="'.$value['0'].'" type="hidden" name="excluir_processo-consulta" id="excluir_processo-consulta">
                                            <button name="botao-excluir-processo" id="botao-excluir-processo" type="submit" class="btn btn-danger mb-2">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>';
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>

