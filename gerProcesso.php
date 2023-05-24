<section class="container text-light">
    <div class="row mt-4">
        <div class="col-6 mx-5 border-bottom d-flex justify-content-center">
            <form>
                <div class="input-group mb-3">
                    <label class="form-label mt-1 mx-3" for="numero">Pesquisar número:</label>
                    <select class="px-5 form-select rounded text-end" name="consultar_numero" id="consultar_numero">
                        <option value=" " selected disabled></option>
                        <?php
                            $sql = $pdo->prepare("SELECT `numero` FROM `processos`");
                            $sql->execute();
                            $informacoes = $sql->fetchAll();
                            print_r($informacoes);
                            foreach($informacoes as $key => $value){
                                echo '<option value="'.$value['0'].'">'.$value['0'].'</option>';
                            }
                        ?>
                    </select>
                    <div class="input-group-prepend">
                        <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_numero"value="pesquisar" id="pesquisar_numero"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4 mx-4 d-flex justify-content-end">
            <div class= "mx-3">
                <button disabled id="gerenciar_processo" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"> Gerenciar</i></button>
            </div>
            <form method="post">
                <input Style="color:white;"class="btn btn-outline-danger border-light"type="submit" name="excluir_processo"value="excluir">
            </form>
        </div>
        <div class="col-10 mt-2">
            <form method="post">
                <div>
                    <label class="form-label h6" for="numero_processo">Número do processo:</label>
                    <input class="form-control" type="number" name="numero_processo" id="numero_processo" value="<?php if(isset($_GET['consultar_numero'])){$numero=$_GET['consultar_numero'];echo $numero;}?>" disabled>
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="demandante_processo">Nome do demandante:</label>
                    <select class="form-select" name="demandante_processo" id="demandante_processo" disabled>
                        <option value=""disabled selected></option>
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
                    <label class="form-label h6" for="descricao_processo">Descrição:</label>
                    <textarea class="form-control" name="descricao_processo" id="descricao_processo" disabled><?php if(isset($descricao)){echo $descricao;}?></textarea>
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="data_atual">Data(de registro):</label>
                    <input class="form-control" type="date" name="data_atual" id="data_atual" value="<?php echo $data_processo;?>" disabled>
                </div>
                <div class="mt-2">
                    <label class="form-label h6" for="prazo_processo">Prazo(dias até a demanda expirar):</label>
                    <input class="form-control" type="number" name="prazo_processo" id="prazo_processo" value="<?php echo $prazo?>" disabled>
                </div>
                <button class="btn btn-success border border-white mt-2" type="submit" name="processo_enviar" value="Salvar" id="processo_enviar" disabled><i class="bi bi-cloud-download"></i> Salvar</button>
            </form>
        </div>
    </div>
</section>