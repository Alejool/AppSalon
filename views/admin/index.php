

<h1 class="nombre-pagina"> Panel de administración</h1> 
<?php
    include_once __DIR__. '/../templates/barra.php';
    include_once __DIR__.'/../../helpers/helpers.php';
?>


<div class="admin__busqueda">
    <form class="form form__style">
        <h3>Busca tus citas</h3>
        <div class="form__campo form__campo--noflex ">
            <label 
                class="form__label form__label--noflex" 
                for="fecha"
                >
                Ingresa la fecha
            </label>
            <input 
                class="form__input" 
                type="date"
                id="fecha"
                value=<?php echo $fecha?>>
        </div>
    </form>

</div>


<div class="citas">
    <h3 class="citas__title">Citas</h3>
    <ul class='citas__citas'>

    <?php 
        if(count($citas)===0){ ?>
            <p class="citas__nohay">No hay citas para esta fecha</p>
    <?php }
    ?>

     <?php  
        $idCita=null;     
     foreach($citas as $key => $cita) {


            if($idCita !== $cita->id ) {
                $total=0;
                $idCita=$cita->id 
                ?>
                <li class="citap">
                    <div class="citap__title">
                        <p class="citap__nombre"><?php echo $cita->nombreCompleto ?> </p>
                        <form 
                            class="form citap__form"          
                            action="/api/eliminar"
                            method="POST">
                            <input 
                            type='hidden'
                            name="id" value="<?php echo $cita->id;?>">
                            <input 
                                type='submit' 
                                class="btn-eliminar" 
                                value='X'>
                        </form>
                    </div>

                    <p> Hora:  <span><?php echo formatearHora($cita->hora) ?> </span>   </p>
                    <p> Email:  <span><?php echo $cita->email ?> </span>   </p>
                    <p> Telefono:  <span><?php echo $cita->telefono ?> </span>   </p>
                    <div class="citap__servicios">

                    <h3>servicios</h3>

            <?php } /* fin del if */?>

            <p class="citap__servicio"> <?php echo $cita->servicio ?> <span> <?php echo formatPriceToCOP($cita->precio) ?> </span> </p>

            
            <?php
            // que la cita actual sea diferente a a la siguiente para asi si imprimir el total una unica vez 
                $citaActual= $cita->id;
                $citaSiguiente= $citas[$key+1]->id ?? 0;
                $total+=$cita->precio;

                if(esUltimo($citaActual, $citaSiguiente)){ 
                    ?> 
                    <div class="citap__total">
                        <p >Total: <span><?php echo formatPriceToCOP($total) ;?></span></p>
                    </div>

                    
                <?php 
                } else {?>

                <?php }
            ?>
            


     <?php } // fin del foreach ?>
    </ul>
</div>

<?php 
    $script= '<script src="build/js/buscador.min.js"> </script>'
?>