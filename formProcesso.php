<div class="w100 d-flex position-absolute top-0 mt-1 flex-row justify-content-center z9">
        <?php
            if(isset($_SESSION['msg_success_cadastro'])){
                echo '
                <div class="alert alert-success p-0 d-flex align-items-center">
                    <p class="m-0 p-1">'.$_SESSION['msg_success_cadastro'].'</p>
                    <form method="POST">
                        <input type="hidden" name="fechar-msg" value="fechar">
                        <input type="submit" name="fechar-msg" value="X" class="btn btn-outline-dark btn-sm m-1">
                    </form>
                </div>';
            }else if(isset($_SESSION['msg_error_cadastro'])){
                echo '
                <div class="alert alert-danger p-0 d-flex align-items-center">
                    <p class="m-0 p-2">'.$_SESSION['msg_error_cadastro'].'</p>
                    <form method="POST">
                        <input type="hidden" name="fechar-msg" value="fechar">
                        <input type="submit" name="fechar-msg" value="X" class="btn btn-outline-dark btn-sm m-2">
                    </form>
                </div>';
            }
        ?>
</div>
<form class="text-light mt-5" method="post">
    <div class="mt-4 mx-3">
        <label class="form-label" for="id_pessoa">Nome do demandante*:</label>
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
        <label class="form-label" for="descricao">Descrição*:</label>
        <textarea class="form-control" name="descricao" id="descricao" required><?php if(isset($_SESSION['descricao'])){echo $_SESSION['descricao'];} ?></textarea>
    </div>
    <div class="mx-3">
        <label class="form-label" for="dataRegistro">Data(Atual)*:</label>
        <input class="form-control" type="date" name="dataRegistro" id="data" value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="mx-3">
        <label class="form-label" for="prazo">Prazo(dias até a demanda expirar)*:</label>
        <input class="form-control" type="number" name="prazo" id="prazo" value="<?php if(isset($_SESSION['prazo'])){echo $_SESSION['prazo'];} ?>" required>
    </div>
    <button class="btn btn-success border border-white m-3" type="submit" value="Salvar" name="confirmar"><i class="bi bi-cloud-download"></i> Salvar</button>
</form> 
<script>

    let input_descricao = document.getElementById('descricao');
    let input_prazo = document.getElementById('prazo');
    let input_id = document.getElementById('id_pessoa');
    let input_data_vencimento = document.getElementById('data');

    function validacaoCamposVazios(input){
        if(input.value == null || input.value == undefined || input.value == ''){
            input.style = "outline: red 1px solid;";
            input.classList.remove("valido");
            input.classList.add("invalido");
        }else{
            input.style = "outline: green 1.5px solid;";
            input.classList.add("valido");
        };
        input.addEventListener('change', function(){
            if(input.value == null || input.value == undefined || input.value == ''){
                input.style = "outline: red 1px solid;";
                input.classList.remove('valido');
                input.classList.add('invalido');
            }else{
                input.style = "outline: green 1.5px solid;";
                input.classList.add('valido');
            }
        })
    };
    validacaoCamposVazios(input_descricao);
    validacaoCamposVazios(input_prazo);
    validacaoCamposVazios(input_id);
    validacaoCamposVazios(input_data_vencimento);
</script>