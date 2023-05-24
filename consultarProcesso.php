<form class="m-3 border-bottom" method="post">
    <div class="input-group mb-2 text-light">
        <label class="form-label mt-1 mx-3" for="procurar_numero">Pesquisar número:</label>
        <input class="form-control rounded" type="text" id="procurar_numero" name="procurar_numero">
        <div class="input-group-prepend">
            <button class="btn btn-success border border-white h-100 text-light" type="submit" name="pesquisar_numero"value="pesquisar"><i class="bi bi-search"></i></button>
        </div>
    </div>
</form>
<div class="h-50 overflow-auto mx-2 bg-light rounded ">
    <table class="table table-striped table-bordered table-hover table-responsive">
        <?php 
            if(isset($_POST['procurar_numero'])&&$_POST['procurar_numero'] != null){
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
                            <td>'.$value['1'].'</td>
                            <td>'.$value['2'].'</td>
                            <td>'.$value['3'].'</td>';
                            $id_demandante = $value['4'];
                            $sqlNome = $pdo->prepare("SELECT `nome` FROM `pessoas` WHERE `id` = ?");
                            $sqlNome->execute(array($id_demandante));
                            $nome_id = $sqlNome->fetchAll(); 
                                if($nome_id == null){

                                }else{
                                    echo '<td>'.$nome_id['0']['0'].'</td>';
                                }
                    
                                }
                        }
                }
            ?>
        </tbody>
    </table>
</div>
