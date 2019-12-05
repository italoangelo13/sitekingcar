<?php
header("Content-type:text/html; charset=utf8");

include_once 'Config/ConexaoBD.php';
require_once 'Models/Carros.php';
require_once 'Models/Marcas.php';
require_once 'Models/Modelos.php';

$anoAtual = date("Y");
$contador = 40;
$carro = new Carros();
$marca = new Marcas();
$modelo = new Modelos();
$listacarro = $carro->SelecionarListaCarros();
$listaMarcas = $marca->SelecionarListaMarcas();
?>
<?php include 'header.inc.php'; ?>
<div class="row" style="margin-top: 10px">
    <div class="col-lg-12" style="padding: 0px;">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="img/slide1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/slide3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="row bg-secondary text-white" style="margin-top: 10px; padding:5px; padding-bottom:15px">
    <div class="col-lg-12">
        <h4>Busque por um modelo específico!</h4>
        <hr>
    </div>
    <div class="col-lg-4">
        <label for="Sel_Marca_Codigo">Marca</label>
        <select class="form-control form-control">
            <option value="0" selected="true">Selecionar</option>
            <?php if ($listaMarcas) : ?>
                <?php foreach ($listaMarcas as $marca) : ?>
                    <option value=""><?php echo $marca->MARDESCRICAO; ?></option>
                <?php endforeach; ?>
                <!-- <?php else : ?>
                <option value="0" selected>Selecionar</option>
            <?php endif; ?> -->
        </select>
    </div>
    <div class="col-lg-4">
        <label for="Sel_Mod_Codigo">Modelo</label>
        <select class="form-control form-control">
            <option value="0" selected="true">Selecionar</option>
            <?php if ($listaMarcas) : ?>
                <?php foreach ($listaMarcas as $marca) : ?>
                    <option value=""><?php echo $marca->MARDESCRICAO; ?></option>
                <?php endforeach; ?>
                <!-- <?php else : ?>
                <option value="0" selected>Selecionar</option>
            <?php endif; ?> -->
        </select>
    </div>
    <div class="col-lg-1">
        <label for="Sel_Ano_Codigo">Ano</label>
        <select class="form-control form-control">
            <option value="0" selected>Selecionar</option>
            <?php for ($i = 0; $i <= $contador; $i++) : ?>
                <?php $anoitem = $anoAtual - $i; ?>
                <option value="<?php echo $anoitem; ?> "><?php echo $anoitem; ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-2">
        <br>
        <button type="submit" class="btn btn-success">Buscar</button>
    </div>
</div>
</div>

<div class="row" style="margin-top: 10px">
    <section class="col-lg-10">
        <div class="container-fluid">
            <div class="row" style="padding: 10px;">
                <?php if ($listacarro) : ?>
                    <?php foreach ($listacarro as $carros) : ?>
                        <div class="card col-lg-4 bg-secondary" style="width: 100%; padding-top: 10px; padding-bottom: 10px;">
                            <img class="card-img-top" src="img/<?php echo $carros->CARFOTO; ?>" title="<?php echo strtoupper (utf8_encode($carros->CARNOME)); ?>" alt="<?php echo utf8_encode($carros->CARNOME); ?>">
                            <h5 class="alert alert-secondary" style="margin-top:10px"><?php echo strtoupper (utf8_encode($carros->CARNOME)); ?></h5>
                            <div class="card-body bg-light" style="width: 100%">
                                <p class="card-text">
                                    <table class="table">
                                        <tr>
                                            <td><i class="fas fa-gas-pump"></i> <?php echo $carros->COMDESCRICAO; ?></td>
                                            <td><i class="fas fa-car-side"></i> <?php echo $carros->CORDESCRICAO; ?></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2" class="text-center"><i class="fas fa-tachometer-alt"></i> <?php echo $carros->CARKM." KM"; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><h3 class="text-danger text-center"><?php echo "R$ ". $carros->CARPRECO; ?></h3></td>
                                        </tr>
                                    </table>
                                </p>
                                <a href="detalhescarro.php?id=<?php echo $carros->CARCOD; ?>" class="btn btn-primary btn-block">Quero Este Carro</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-lg-12">
                        <h4 class="alert alert-warning">Nenhum Automovel encontrado!</h4>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <!-- <div class=" "> -->
                    <nav aria-label="Page navigation example" class="col-lg-12">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                <!-- </div> -->
            </div>
        </div>
    </section>
    <section class="col-lg-2">

    </section>
</div>
<?php include 'footer.inc.php'; ?>