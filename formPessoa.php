
    <form class="text-light was-validated" method = "post">
        <div class="mt-4 mx-3">
            <label class="form-label" for="nome">Nome:</label>
            <input class="form-control" type="text" id="nome" name="nome" autofocus required>

            <label class="form-label" for="data_nascimento">Data de nascimento:</label>
            <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" required>

            <label class="form-label" for="cpf">CPF:</label>
            <input class="form-control" type="text" id="cpf" name="cpf" placeholder="000.000.000-00" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" maxlength="14" required>
        </div>
        <div class="mx-3">
            <label class="form-label" for="sexo">Sexo:</label>    
            <select class="form-control" name="sexo" id="sexo" required>
                <option value="" disabled selected> </option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        <div class="mx-3" id="endereco">
            <label class="form-label" for="endereco">Endereço:</label>
            <input class="form-control mb-1" type="text" name="cidade" placeholder="Cidade:">
            <input class="form-control mb-1" type="text" name="bairro" placeholder="Bairro:">
            <input class="form-control mb-1" type="text" name="rua" placeholder="Rua:">
            <div class="row">
                <div class="col-6">
                    <input class="form-control mb-1" type="number" name="numero" placeholder="Número:">
                </div>
                <div class="col-6">
                    <input class="form-control mb-1" type="text" name="complemento" placeholder="Complemento:">
                </div>
            </div>
        </div>
        <button class="btn btn-success border border-white m-3"type="submit" name="enviado" value="Salvar"><i class="bi bi-cloud-download"></i> Salvar</button>
    </form>
