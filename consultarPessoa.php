<form class="m-3 border-bottom" method="post">
    <div class="input-group mb-2 text-light">
        <label class="form-label mt-1 mx-3" for="procurar_nome">Pesquisar nome:</label>
        <input class="form-control rounded" type="text" id="procurar_nome" name="procurar_nome">
        <div class="input-group-prepend">
            <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_nome"value="pesquisar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</form>

<div class="h-400 overflow-auto mx-2 bg-light rounded ">
    <table class="table table-striped table-bordered table-hover">
        <?php 
            if(isset($_POST['procurar_nome'])&&$_POST['procurar_nome'] != null){
                $nome = $_POST['procurar_nome'];
                echo '<caption class="mx-3">Lista de pessoas com: "'.$nome.'" no nome. </caption>';
            }
        ?>
        <thead>
            <tr class="table-dark">
            <th class="p-1"scope="col">Id</th>
            <th class="p-1"scope="col">Nome</th>
            <th class="p-1"scope="col">Data nascimento</th>
            <th class="p-1"scope="col">CPF</th>
            <th class="p-1"scope="col">Sexo</th>
            <th class="p-1"scope="col">Cidade</th>
            <th class="p-1"scope="col">Bairro</th>
            <th class="p-1"scope="col">Rua</th>
            <th class="p-1"scope="col">N°</th>
            <th class="p-1"scope="col">Compl.</th>
            <th class="p-0"scope="col"></th>
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
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>
                            <td class="align-middle">'.$value['4'].'</td>
                            <td class="align-middle">'.$value['5'].'</td>
                            <td class="align-middle">'.$value['6'].'</td>
                            <td class="align-middle">'.$value['7'].'</td>
                            <td class="align-middle">'.$value['8'].'</td>
                            <td class="align-middle">'.$value['9'].'</td>';
                            echo '
                                <td class="d-flex flex-column gap align-items-center p-1">
                                    <a href="http://localhost/Projeto_prefeitura/gerenciar.php?consultar_id='.$value['0'].'&pesquisar_id=pesquisar" type="button" class="btn btn-warning mt-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST">
                                    <input value="'.$value['0'].'" type="hidden" name="excluir_pessoa-consulta" id="excluir_pessoa-consulta">
                                    <button name="botao-excluir-pessoa" id="botao-excluir-pessoa" type="submit" class="btn btn-danger mb-2">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td></tr>';
                        }
                    }
                }else{
                    $sql = $pdo->prepare("SELECT * FROM `pessoas` ORDER BY `nome` ASC");
                    $sql->execute();
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>
                            <td class="align-middle">'.$value['4'].'</td>
                            <td class="align-middle">'.$value['5'].'</td>
                            <td class="align-middle">'.$value['6'].'</td>
                            <td class="align-middle">'.$value['7'].'</td>
                            <td class="align-middle">'.$value['8'].'</td>
                            <td class="align-middle">'.$value['9'].'</td>';
                            echo '
                                <td class="d-flex flex-column gap align-items-center p-1">
                                    <a href="http://localhost/Projeto_prefeitura/gerenciar.php?consultar_id='.$value['0'].'&pesquisar_id=pesquisar" type="button" class="btn btn-warning mt-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST">
                                        <input value="'.$value['0'].'" type="hidden" name="excluir_pessoa-consulta" id="excluir_pessoa-consulta">
                                        <button name="botao-excluir-pessoa" id="botao-excluir-pessoa" type="submit" class="btn btn-danger mb-2">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td></tr>';
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>

