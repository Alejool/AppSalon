

<h1 class="nombre-pagina"> Servicios</h1> 
<?php
    include_once __DIR__. '/../templates/bienvenida.php';
    include_once __DIR__. '/../templates/barra.php';
    include_once __DIR__.'/../../helpers/helpers.php';
?>

<div class="listado-servicios">
<?php 

    foreach($servicios as $servicio){
      
        ?>
        <div class="servicio servicio-hover">
            <p class="servicio__nombre"> <?php echo $servicio->nombre?></p>
            <p class="servicio__precio"> <?php echo formatPriceToCOP( $servicio->precio)?></p>

            <div class="acciones">
                <a 
                    class="btn-edit" 
                    href="/servicios/actualizar?id=<?php echo$servicio->id; ?>">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <form 
                    action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id?>">
                    <button
                        type="submit"
                        class="btn btn-eliminar "> 
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        <?php
    }

?>

</div>