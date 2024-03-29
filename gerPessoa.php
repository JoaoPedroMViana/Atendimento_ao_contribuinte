<?php

// Olhar os requisitos dnv


    if(isset($_POST['excluir_pessoa']) && isset($_GET['consultar_id'])){
        if($conteudo == null){
        
        }else{
        $_SESSION['modal_excluir-pessoa'] = 'true';
        }
    }

    if(isset($_SESSION['modal_excluir-processo'])){
        $_SESSION['modal_excluir-processo'] ='false';
    } 
    if(isset($_POST['cancelar-modal-pessoa'])){
        $_SESSION['modal_excluir-pessoa'] ='false';
    }else if(isset($_POST['confirmar-modal-pessoa'])){
        $sql = $pdo->prepare("DELETE FROM `pessoas` WHERE `id` = ?");
        try{
            $sql->execute(array($id_pessoa));
            $_SESSION['modal_excluir-pessoa'] ='false';
            $_SESSION['msg_success_gerenciar'] = 'Pessoa excluida.';
            unset($_GET['consultar_id']);
            unset($nome);
            unset($data);
            unset($cpf);
            unset($sexo);
            unset($cidade);
            unset($bairro);
            unset($rua);
            unset($numero);
            unset($complemento);
            header('Location: consultar.php?pessoaC=Pessoa');
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
<section class="container text-light">
    <div class="row mt-2">
        <div class="col-9 mt-2">
            <form method="post">
                <div class="d-flex">
                    <label class="form-label h6 mt-1 mx-3"for="id_demandante">Id:</label>
                    <input class="form-control" type="number" name="id_demandante" id="id_demandante" value="<?php if(isset($_GET['consultar_id'])){$id = $_GET['consultar_id'];echo $id;}?>" disabled>
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3"for="nome_demandante">Nome:</label>
                    <input class="form-control" type="text" name="nome_demandante" id="nome_demandante" value="<?php if(isset($nome)){echo $nome;}?>" >
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3" for="data_demandante">Data de nascimento:</label>
                    <input class="form-control" type="date" name="data_demandante" id="data_demandante" value="<?php if(isset($data_nascimento)){echo $data_nascimento;}?>" >
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3" for="cpf_demandante">CPF:</label>
                    <input class="form-control" type="text" name="cpf_demandante" id="cpf_demandante" placeholder="000.000.000-00" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" maxlength="14" value="<?php if(isset($cpf)){echo $cpf;}?>" >
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3" for="sexo_demandante">Sexo:</label>
                    <select class="form-control" name="sexo_demandante" id="sexo_demandante" >
                        <option value="<?php if(isset($sexo)){echo $sexo;}?>"><?php if(isset($sexo)){echo $sexo;}?></option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                
                <div class="mt-2" id="endereco_demandante">
                    <label class="form-label h6 mt-1 mx-3" for="endereco_demandante">Endereço:</label>
                    <input class="form-control mb-1" type="text" name="cidade_demandante" placeholder="Cidade:" value="<?php if(isset($cidade)){echo $cidade;}?>" id="cidade_demandante">
                    <input class="form-control mb-1" type="text" name="bairro_demandante" placeholder="Bairro:" value="<?php if(isset($bairro)){echo $bairro;}?>" id="bairro_demandante" >
                    <input class="form-control mb-1" type="text" name="rua_demandante" placeholder="Rua:" value="<?php if(isset($rua)){echo $rua;}?>" id="rua_demandante" >
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control mb-1" type="number" name="numero_demandante" placeholder="Número:" value="<?php if(isset($numero)&&$numero>0){echo $numero;}?>" id="numero_demandante" >
                        </div>
                        <div class="col-6">
                            <input class="form-control mb-1" type="text" name="complemento_demandante" placeholder="Complemento:" value="<?php if(isset($complemento)){echo $complemento;}?>" id="complemento_demandante" >
                        </div>
                    </div>
                </div>
                <button class="btn btn-success border border-white mt-1" name="gerPessoa_enviar" type="submit" value="Salvar" id="gerPessoa_enviar" ><i class="bi bi-cloud-download"></i> Salvar</button>
            </form>
                <form method="post" class="mt-2">
                    <input Style="color:white;"class="btn btn-outline-danger border-light"type="submit" name="excluir_pessoa" id="excluir_pessoa"value="excluir">
                </form>
        </div>
    </div>
</section>
<script>
    
    let input_cpf = document.getElementById('cpf_demandante');

    input_cpf.addEventListener('keypress', function(){
        if(input_cpf.value.length == 3 || input_cpf.value.length == 7){
            input_cpf.value += ".";
        }else if(input_cpf.value.length == 11){
            input_cpf.value += "-";
        }
    });

    input_cpf.addEventListener('change', function(){
        if(/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/.test(input_cpf.value)){
            input_cpf.style = "outline: green 1.5px solid;";
            input_cpf.classList.remove('invalido');
            input_cpf.classList.add('valido');
        }else{
            input_cpf.style = "outline: red 1px solid;";
            input_cpf.classList.remove('valido');
            input_cpf.classList.add('invalido');
        }
    });
</script>