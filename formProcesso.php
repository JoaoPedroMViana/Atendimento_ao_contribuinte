<form class="text-light was-validated" method="post">
    <div class="mt-4 mx-3">
        <label class="form-label" for="id_pessoa">Nome do demandante:</label>
        <select class="form-select" name="id_pessoa" id="id_pessoa" autofocus required>
            <option value="" selected disabled></option>
            <?php
                $sql = $pdo->prepare("SELECT `nome`,`id` FROM `pessoas` ORDER BY `nome` ASC");
                $sql->execute();
                $informacoes = $sql->fetchAll();
                foreach($informacoes as $key => $value){
                    echo '<option value="'.$value['1'].'">'.$value['0'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="mx-3">
        <label class="form-label" for="descricao">Descrição:</label>
        <textarea class="form-control" name="descricao" id="descricao" required></textarea>
    </div>
    <div class="mx-3">
        <label class="form-label" for="dataRegistro">Data(Atual):</label>
        <input class="form-control" type="date" name="dataRegistro" id="data" disabled value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="mx-3">
        <label class="form-label" for="prazo">Prazo(dias até a demanda expirar):</label>
        <input class="form-control" type="number" name="prazo" id="prazo" required>
    </div>
    <button class="btn btn-success border border-white m-3" type="submit" value="Salvar" name="confirmar"><i class="bi bi-cloud-download"></i> Salvar</button>
</form>