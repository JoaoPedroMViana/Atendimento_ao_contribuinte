<form class="m-3 border-bottom" method="post">
    <div class="input-group mb-2 text-light">
        <label class="form-label mt-1 mx-3" for="procurar_numero">Pesquisar número:</label>
        <input class="form-control rounded" type="text" id="procurar_numero" name="procurar_numero">
        <div class="input-group-prepend">
            <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_numero"value="pesquisar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</form>

<div class="overflow-auto mx-2 bg-light rounded h-400">
    <table class="table table-striped table-bordered table-hover">
        <?php 
            if(isset($_POST['procurar_numero']) && $_POST['procurar_numero'] != null){
                $numero = $_POST['procurar_numero'];
                echo '<caption class="mx-3">Lista de processos com : "'.$numero.'" no número. </caption>';
            }
        ?>
        <thead>
            <tr class="table-dark">
            <th scope="col">Número</th>
            <th scope="col">Descrição</th>
            <th scope="col">Data de Registro</th>
            <th scope="col">Prazo</th>
            <th scope="col">Demandante</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['pesquisar_numero'])){
                    $numero_pesquisado = '%'.$_POST['procurar_numero'].'%';
                    $sql = $pdo->prepare("SELECT * FROM `processos` WHERE `numero` LIKE ? ORDER BY `numero` ASC");
                    $sql->execute(array($numero_pesquisado));
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>';
                            $id_demandante = $value['4'];
                            $sqlNome = $pdo->prepare("SELECT `nome` FROM `pessoas` WHERE `id` = ?");
                            $sqlNome->execute(array($id_demandante));
                            $nome_id = $sqlNome->fetchAll(); 
                                if($nome_id == null){
                                    echo '<td></td>';
                                }else{
                                    echo '<td>'.$nome_id['0']['0'].'</td>';
                                }
                                echo '
                                <td class="d-flex flex-column gap align-items-center">
                                    <a href="http://localhost/Projeto_prefeitura/gerenciar.php?consultar_numero='.$value['0'].'&pesquisar_numero=pesquisar" type="button" class="btn btn-warning mt-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST">
                                        <input value="'.$value['0'].'" type="hidden" name="excluir_processo-consulta" id="excluir_processo-consulta">
                                        <button name="botao-excluir-processo" id="botao-excluir-processo" type="submit" class="btn btn-danger mb-2">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td></tr>';
                        }
                    }
                }else{
                    $sql = $pdo->prepare("SELECT * FROM `processos` ORDER BY `numero` ASC");
                    $sql->execute();
                    $conteudo = $sql->fetchAll();
                    if($conteudo == null){

                    }else{
                        foreach($conteudo as $key => $value){
                            echo '<tr>
                            <th scope="row">'.$value['0'].'</th>
                            <td class="align-middle">'.$value['1'].'</td>
                            <td class="align-middle">'.$value['2'].'</td>
                            <td class="align-middle">'.$value['3'].'</td>';
                            $id_demandante = $value['4'];
                            $sqlNome = $pdo->prepare("SELECT `nome` FROM `pessoas` WHERE `id` = ?");
                            $sqlNome->execute(array($id_demandante));
                            $nome_id = $sqlNome->fetchAll(); 
                                if($nome_id == null){
                                    echo '<td></td>';
                                }else{
                                    echo '<td>'.$nome_id['0']['0'].'</td>';
                                }
                                echo '
                                    <td class="d-flex flex-column align-items-center gap">
                                        <a href="http://localhost/Projeto_prefeitura/gerenciar.php?consultar_numero='.$value['0'].'&pesquisar_numero=pesquisar"  type="button" class="btn btn-warning mt-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form method="POST">
                                            <input value="'.$value['0'].'" type="hidden" name="excluir_processo-consulta" id="excluir_processo-consulta">
                                            <button name="botao-excluir-processo" id="botao-excluir-processo" type="submit" class="btn btn-danger mb-2">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>';
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>

