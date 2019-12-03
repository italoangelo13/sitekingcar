<?php
header("Content-type:text/html; charset=utf8");

include_once 'Config/ConexaoBD.php';
require_once 'Models/Carros.php';
require_once 'Models/Marcas.php';



$carro = new Carros();
$marca = new Marcas();
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

<div class="row bg-secondary text-white" style="margin-top: 10px; padding:5px;">
    <div class="col-lg-4">
        <label for="Sel_Marca_Codigo">Marca</label>
        <select class="form-control form-control-sm">
            <option value="0" selected="true">Selecionar</option>
            <?php if ($listaMarcas) : ?>
                <?php foreach ($listaMarcas as $marca) : ?>
                    <option value="" selected><?php echo $marca->MARDESCRICAO; ?></option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="0" selected>Selecionar</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="col-lg-4">
    <label for="Sel_Marca_Codigo">Modelo</label>
        <select class="form-control form-control-sm">
            <option value="0" selected="true">Selecionar</option>
            <?php if ($listaMarcas) : ?>
                <?php foreach ($listaMarcas as $marca) : ?>
                    <option value="" selected><?php echo $marca->MARDESCRICAO; ?></option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="0" selected>Selecionar</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="col-lg-4"></div>
</div>

<div class="row" style="margin-top: 10px">
    <section class="col-lg-10">

    </section>
    <section class="col-lg-2">

    </section>
</div>
<?php include 'footer.inc.php'; ?>