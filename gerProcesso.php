<?php
    if(isset($_POST['excluir_processo']) && isset($_GET['consultar_numero'])){
        if($conteudo == null){
        
        }else{
        $_SESSION['modal_excluir-processo'] = 'true';
        } 
    }

    if(isset($_SESSION['modal_excluir-pessoa'])){
        $_SESSION['modal_excluir-pessoa'] ='false'; 
    }    
    
    if(isset($_POST['cancelar-modal-processo'])){
        $_SESSION['modal_excluir-processo'] ='false';
    }else if(isset($_POST['confirmar-modal-processo'])){
        $sql = $pdo->prepare("DELETE FROM `processos` WHERE `numero` = ?");
        try{
            $sql->execute(array($_GET['consultar_numero']));
            $_SESSION['modal_excluir-processo'] ='false';
            $_SESSION['msg_success_gerenciar'] = 'Processo excluido.';
            unset($_GET['consultar_numero']);
            unset($id_demandante);
            unset($descricao);
            unset($data_processo);
            unset($prazo);
            header('Location: consultar.php?processoC=Processo'); 
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
<section class="container text-light">
    <div class="row mt-4">
        <div class="col-10 mt-2">
            <form method="post">
                <div>
                    <label class="form-label h6" for="numero_processo">Número do processo*:</label>
                    <input class="form-control" type="number" name="numero_processo" id="numero_processo" value="<?php if(isset($_GET['consultar_numero'])){$numero=$_GET['consultar_numero'];echo $numero;}?>" disabled>
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="demandante_processo">Nome do demandante*:</label>
                    <select class="form-select" name="demandante_processo" id="demandante_processo" >
                        <option value="" selected></option>
                        <?php
                            $sql = $pdo->prepare("SELECT `nome`,`id` FROM `pessoas`");
                            $sql->execute();
                            $informacoes = $sql->fetchAll();
                            foreach($informacoes as $key => $value){
                                if($value['1'] == $id_demandante){
                                    echo '<option value="'.$value['1'].'" selected>'.$value['0'].'</option>';
                                }else{
                                    echo '<option value="'.$value['1'].'">'.$value['0'].'</option>';
                                }
                            }
                        ?>
                       
                    </select>
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="descricao_processo">Descrição*:</label>
                    <textarea class="form-control" name="descricao_processo" id="descricao_processo" ><?php if(isset($descricao)){echo $descricao;}?></textarea>
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="data_atual">Data(de registro)*:</label>
                    <input class="form-control" type="date" name="data_atual" id="data_atual" value="<?php echo $data_processo;?>" >
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="prazo_processo">Prazo(dias até a demanda expirar)*:</label>
                    <input class="form-control" type="number" name="prazo_processo" id="prazo_processo" value="<?php echo $prazo?>" >
                </div>
                <button class="btn btn-success border border-white mt-2" type="submit" name="processo_enviar" value="Salvar" id="processo_enviar" ><i class="bi bi-cloud-download"></i> Salvar</button>
            </form>
            <form method="post" class="mt-2">
                <input Style="color:white;"class="btn btn-outline-danger border-light"type="submit" name="excluir_processo" id="excluir_processo" value="excluir" >
            </form>
        </div>
    </div>
</section>