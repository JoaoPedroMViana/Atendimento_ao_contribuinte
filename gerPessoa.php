<section class="container text-light">
    <div class="row mt-4">
        <div class="col-6 mx-5 border-bottom d-flex">
            <form>
                <div class="input-group mb-3">
                    <label class="form-label mt-1 mx-3" for="id">Pesquisar nome:</label>
                    <select class="form-select rounded" name="consultar_id" id="id">
                        <option value=""disabled selected></option>
                        <?php
                            $sql = $pdo->prepare("SELECT `nome`,`id` FROM `pessoas` ORDER BY `nome` ASC");
                            $sql->execute();
                            $informacoes = $sql->fetchAll();
                            foreach($informacoes as $key => $value){
                                echo '<option value="'.$value['1'].'">'.$value['0'].'</option>';
                                
                            }
                        ?>
                       
                    </select>
                    <div class="input-group-prepend">
                        <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_id"value="pesquisar"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4 mx-4 d-flex justify-content-end">
            <div class= mx-3>
                <button id="gerenciar_pessoa" type="button" class="btn btn-warning" disabled><i class="bi bi-pencil-square"> Gerenciar</i></button>
            </div>
            <form method="post">
                <input Style="color:white;"class="btn btn-outline-danger border-light"type="submit" name="excluir_pessoa"value="excluir">
            </form>
        </div>
        <div class="col-9 mt-2">
            <form method="post">
                <div class="d-flex">
                    <label class="form-label h6 mt-1 mx-3"for="id_demandante">Id:</label>
                    <input class="form-control" type="number" name="id_demandante" id="id_demandante" value="<?php if(isset($_GET['consultar_id'])){$id = $_GET['consultar_id'];echo $id;}?>" disabled>
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3"for="nome_demandante">Nome:</label>
                    <input class="form-control" type="text" name="nome_demandante" id="nome_demandante" value="<?php if(isset($nome)){echo $nome;}?>" disabled>
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3" for="data_demandante">Data de nascimento:</label>
                    <input class="form-control" type="date" name="data_demandante" id="data_demandante" value="<?php if(isset($data_nascimento)){echo $data_nascimento;}?>" disabled>
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3" for="cpf_demandante">CPF:</label>
                    <input class="form-control" type="text" name="cpf_demandante" id="cpf_demandante" placeholder="000.000.000-00" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" maxlength="14" value="<?php if(isset($cpf)){echo $cpf;}?>" disabled>
                </div>

                <div class="d-flex mt-2">
                    <label class="form-label h6 mt-1 mx-3" for="sexo_demandante">Sexo:</label>
                    <select class="form-control" name="sexo_demandante" id="sexo_demandante" disabled>
                        <option value="<?php if(isset($sexo)){echo $sexo;}?>"><?php if(isset($sexo)){echo $sexo;}?></option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                
                <div class="mt-2" id="endereco_demandante">
                    <label class="form-label h6 mt-1 mx-3" for="endereco_demandante">Endereço:</label>
                    <input class="form-control mb-1" type="text" name="cidade_demandante" placeholder="Cidade:" value="<?php if(isset($cidade)){echo $cidade;}?>" id="cidade_demandante"disabled>
                    <input class="form-control mb-1" type="text" name="bairro_demandante" placeholder="Bairro:" value="<?php if(isset($bairro)){echo $bairro;}?>" id="bairro_demandante" disabled>
                    <input class="form-control mb-1" type="text" name="rua_demandante" placeholder="Rua:" value="<?php if(isset($rua)){echo $rua;}?>" id="rua_demandante" disabled>
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control mb-1" type="number" name="numero_demandante" placeholder="Número:" value="<?php if(isset($numero)&&$numero>0){echo $numero;}?>" id="numero_demandante" disabled>
                        </div>
                        <div class="col-6">
                            <input class="form-control mb-1" type="text" name="complemento_demandante" placeholder="Complemento:" value="<?php if(isset($complemento)){echo $complemento;}?>" id="complemento_demandante" disabled>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success border border-white mt-1" name="gerPessoa_enviar" type="submit" value="Salvar" id="gerPessoa_enviar" disabled><i class="bi bi-cloud-download"></i> Salvar</button>
            </form>
        </div>
    </div>
</section>