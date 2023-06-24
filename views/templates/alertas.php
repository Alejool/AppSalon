


<?php foreach ($alertas as $key => $mensajes){

  foreach ($mensajes as $mensaje): 

    if ($key=== 'error'){ ?>
      <p class="alerta error"> <?php echo $mensaje?></p>
    <?php }

    if ($key=== 'exito'){ ?>
      <p class="alerta exito"> <?php echo $mensaje?></p>
    <?php }

  endforeach;

} ?>





