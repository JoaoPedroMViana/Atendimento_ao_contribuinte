<form class="m-3 border-bottom" method="post">
    <div class="input-group mb-2 text-light">
        <label class="form-label mt-1 mx-3" for="procurar_nome">Pesquisar nome:</label>
        <input class="form-control rounded" type="text" id="procurar_nome" name="procurar_nome">
        <div class="input-group-prepend">
            <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_nome"value="pesquisar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</form>
<div class="h-50 overflow-auto mx-2 bg-light rounded ">
    <table class="table table-striped table-bordered table-hover">
        <?php 
            if(isset($_POST['procurar_nome'])&&$_POST['procurar_nome'] != null){
                $nome = $_POST['procurar_nome'];
                echo '<caption class="mx-3">Lista de pessoas com: "'.$nome.'" no nome. </caption>';
            }
        ?>
        <thead>
            <tr class="table-dark">
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Data nascimento</th>
            <th scope="col">CPF</th>
            <th scope="col">Sexo</th>
            <th scope="col">Cidade</th>
            <th scope="col">Bairro</th>
            <th scope="col">Rua</th>
            <th scope="col">Número</th>
            <th scope="col">Complemento</th>
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
                            <td>'.$value['1'].'</td>
                            <td>'.$value['2'].'</td>
                            <td>'.$value['3'].'</td>
                            <td>'.$value['4'].'</td>
                            <td>'.$value['5'].'</td>
                            <td>'.$value['6'].'</td>
                            <td>'.$value['7'].'</td>
                            <td>'.$value['8'].'</td>
                            <td>'.$value['9'].'</td>
                            </tr>';
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>

