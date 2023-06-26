

<h1 class="nombre-pagina">Actualizar servicio</h1>
<p class="descripcion-pagina">Modifica los datos que consideres necesario</p>

<?php
    include_once __DIR__. '/../templates/barra.php';
    
?>


<form 
  method="POST" 
  class="form">

  <fieldset class="form__fieldset">
    <legend class="form__legend">Actualizar servicio</legend>

  <?php include_once __DIR__. '/../templates/formulario.php';?>

  <input 
  class="btn btn-servicios"
  type="submit" 
  value="Actualizar servicio">
  </fieldset>
</form>