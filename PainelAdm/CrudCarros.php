<?php
header("Content-type:text/html; charset=utf8");

include_once '../Config/ConexaoBD.php';
require_once '../Models/Carros.php';
$numCarros = 0;

$Carro = new Carros();

//determina o numero de registros que serão mostrados na tela
$maximo = 10;
//armazenamos o valor da pagina atual
$pagina = isset($_GET['pagina']) ? ($_GET['pagina']) : '1';
//subtraimos 1, porque os registros sempre começam do 0 (zero), como num array
$inicio = $pagina - 1;
//multiplicamos a quantidade de registros da pagina pelo valor da pagina atual 
$inicio = $maximo * $inicio;


$strCount = $Carro->SelecionaTotalNumCarros();
$total = 0;
if (count($strCount)) {
    foreach ($strCount as $row) {
        //armazeno o total de registros da tabela para fazer a paginação
        $total = $row->NUMCARROS;
        $numCarros = $row->NUMCARROS;
    }
}


$resultado = $Carro->SelecionaCarrosPaginados($inicio, $maximo);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KingCar - Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontello/css/fontello.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/kingcar.css">
    <script src="../assets/jquery-3.3.1.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/fontawesome/js/all.min.js"></script>
    <script src="../assets/kingcar.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row bg-primary text-white">
            <div class="col-lg-10">
                <h5>Cadastro de Carros</h5>
            </div>
            <div class="col-lg-2 text-right">
                <?php echo $numCarros; ?> Registro(s)
            </div>
        </div>
        <div class="row" style="margin-top:5px;">
            <div class="col-lg-12">
                <button class="btn btn-success" data-toggle="modal" data-target="#CadCarro"><i class="icone-plus"></i> Cadastrar Carro</button>
            </div>
        </div>

        <form action="" method="post">
            <div class="row" style="margin-top: 5px;">
                <div class="col-lg-12 bg-secondary">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="">Pesquisar Por:</label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <select name="_ddlPesquisa" id="_ddlPesquisa" class="form-control">
                                                <option value="CODCAR" selected>CÓDIGO</option>
                                                <option value="MARDESCRICAO">MARCA</option>
                                                <option value="MODDESCRICAO">MODELO</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="text" name="_edPesquisa" id="_edPesquisa" class="form-control" placeholder="Pesquisar Carro">
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-success" name="pesquisa"><i class="icone-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Ordem de Pesquisa:</label>
                                <select name="_ddlPesquisa" id="_ddlPesquisa" class="form-control">
                                    <option value="ASC" selected>CRESCENTE</option>
                                    <option value="DESC">DECRESCENTE</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div class="row" style="margin-top: 10px;">
            <div class="col-lg-12">
                <?php if ($resultado) : ?>
                    <table class="table table-stripped">
                        <thead>
                            <th>
                                Cod.
                            </th>
                            <th>
                                Marca
                            </th>
                            <th>
                                Modelo
                            </th>
                            <th>
                                Ano
                            </th>
                            <th>
                                Preço
                            </th>
                            <th>
                                Localização
                            </th>
                            <th>
                                Editar
                            </th>
                            <th>
                                Excluir
                            </th>
                        </thead>
                        <tbody>
                            <? foreach ($linha as $resultado) : ?>
                                <tr>
                                    <td><?php echo $linha->CARCOD; ?></td>
                                </tr>
                            <? endforeach ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h5 class="alert alert-danger">Nenhum Registro encontrado!</h5>
                <?php endif ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        //determina de quantos em quantos links serão adicionados e removidos
                        $max_links = 10;
                        //dados para os botões
                        $previous = $pagina - 1;
                        $next = $pagina + 1;
                        //usa uma funcção "ceil" para arrendondar o numero pra cima, ex 1,01 será 2
                        $pgs = ceil($total / $maximo);
                        if ($pgs > 1) {
                            //botao anterior
                            if ($previous > 0) {

                                ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?pagina=" . $previous; ?>">Anterior</a></li>
                            <?php
                                } else {

                                    ?>
                                <li class="page-item" disabled='disabled'><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?pagina=" . $previous; ?>">Anterior</a></li>
                                <?php
                                    }

                                    for ($i = $pagina - $max_links; $i <= $pgs - 1; $i++) {
                                        if ($i <= 0) {
                                            //enquanto for negativo, não faz nada
                                        } else {
                                            //senão adiciona os links para outra pagina
                                            if ($i != $pagina) {
                                                ?>
                                        <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?pagina=" . ($i); ?>"><?php echo $i; ?></a></li>
                                    <?php

                                                } else {
                                                    ?>
                                        <li class="page-item" disabled='disabled'><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?pagina=" . ($i); ?>"><?php echo $i; ?></a></li>
                                <?php
                                            }
                                        }
                                    }
                                    //botao proximo
                                    if ($next <= $pgs) {

                                        ?>
                                <li class="page-item"><a class="page-link" href="<?php $_SERVER['PHP_SELF'] . "?pagina=" . $next; ?>">Proximo</a></li>
                            <?php
                                } else {
                                    ?>
                                <li class="page-item" disabled='disabled'><a class="page-link" href="<?php $_SERVER['PHP_SELF'] . "?pagina=" . $next; ?>">Proximo</a></li>
                        <?php
                            }
                        }

                        ?>
                    </ul>
                </nav>
            </div>
        </div>

    </div>



    <!-- Modal Cad Carro -->
    <div class="modal fade" id="CadCarro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Carros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group col-lg-2">
                                    <label for="_edCodCarro">Cod</label>
                                    <input type="text" class="form-control" id="_edCodCarro" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="_edCodCarro">Marca</label>
                                    <select class="form-control form-control" id="_ddlMarca">
                                        <option value="0" selected="true">Selecionar</option>
                                        <?php if ($listaMarcas) : ?>
                                            <?php foreach ($listaMarcas as $marca) : ?>
                                                <option value="<?php echo $marca->MARCOD; ?>"><?php echo $marca->MARDESCRICAO; ?></option>
                                            <?php endforeach; ?>
                                            <!-- <?php else : ?>
                <option value="0" selected>Selecionar</option>
            <?php endif; ?> -->
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="_ddlModelo">Modelo</label>
                                    <select class="form-control form-control" id="_ddlModelo">
                                        <option value="0" selected="true">Selecionar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2">
                                    <label for="_edCodCarro">Ano</label>
                                    <input type="text" class="form-control" id="_edCodCarro">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="_edCodCarro">Modelo</label>
                                    <input type="text" class="form-control" id="_edCodCarro" disabled>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Limpar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>