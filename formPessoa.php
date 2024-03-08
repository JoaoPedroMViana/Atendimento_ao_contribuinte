
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
    <form id="formPessoa" class="text-light mt-4" method = "post">
        <div class="mt-3 mx-3">
            <label class="form-label" for="nome">Nome*:</label>
            <input class="form-control" type="text" id="nome" name="nome" value="<?php if(isset($_SESSION['nome_pessoa'])){ echo $_SESSION['nome_pessoa'];} ?>"autofocus required>

            <label class="form-label" for="data_nascimento">Data de nascimento*:</label>
            <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" value="<?php if(isset($_SESSION['data_nascimento_pessoa'])){ echo $_SESSION['data_nascimento_pessoa'];} ?>" required>

            <label class="form-label" for="cpf">CPF*:</label>
            <input class="form-control" type="text" id="cpf" name="cpf" placeholder="000.000.000-00" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" maxlength="14" autocomplete="off" value="<?php if(isset($_SESSION['cpf'])){echo $_SESSION['cpf'];} ?>" required>
        </div>
        <div class="mx-3">
            <label class="form-label" for="sexo">Sexo*:</label>    
            <select class="form-control" name="sexo" id="sexo" required>
                <option value="<?php if(isset($_SESSION['sexo'])){echo $_SESSION['sexo'];} ?>" disabled selected><?php if(isset($_SESSION['sexo'])){echo $_SESSION['sexo'];} ?></option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        <div class="mx-3" id="endereco">
            <label class="form-label" for="endereco">Endereço:</label>
            <input class="form-control mb-1" type="text" name="cidade" placeholder="Cidade:" value="<?php if(isset($_SESSION['cidade'])){echo $_SESSION['cidade'];} ?>">
            <input class="form-control mb-1" type="text" name="bairro" placeholder="Bairro:" value="<?php if(isset($_SESSION['bairro'])){echo $_SESSION['bairro'];} ?>">
            <input class="form-control mb-1" type="text" name="rua" placeholder="Rua:" value="<?php if(isset($_SESSION['rua'])){echo $_SESSION['rua'];} ?>">
            <div class="row">
                <div class="col-6">
                    <input class="form-control mb-1" id="numero"type="number" name="numero" placeholder="Número:" value="<?php if(isset($_SESSION['numero'])){echo $_SESSION['numero'];} ?>">
                </div>
                <div class="col-6">
                    <input class="form-control mb-1" type="text" name="complemento" placeholder="Complemento:" value="<?php if(isset($_SESSION['complemento'])){echo $_SESSION['complemento'];} ?>">
                </div>
            </div>
        </div>
        <button class="btn btn-success border border-white mx-3 my-1"type="submit" name="enviado" value="Salvar"><i class="bi bi-cloud-download"></i> Salvar</button>
    </form>
    <script>
       
        let input_nome = document.getElementById('nome');
        let input_data_nascimento = document.getElementById('data_nascimento');
        let input_cpf = document.getElementById('cpf');
        let input_sexo = document.getElementById('sexo');
        
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
        
            validacaoCamposVazios(input_nome);
            validacaoCamposVazios(input_data_nascimento);
            validacaoCamposVazios(input_cpf);
            validacaoCamposVazios(input_sexo);

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
