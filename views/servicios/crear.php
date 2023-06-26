

<h1 class="nombre-pagina">Crear servicio</h1>
<p class="descripcion-pagina">Completa los campos para crear nuevos servicios</p>

<?php
    include_once __DIR__. '/../templates/barra.php';
    include_once __DIR__. '/../templates/alertas.php';
?>


<form action="/servicios/crear" class="form" method="POST">
<fieldset class="form__fieldset">
    <legend class="form__legend">Añadir servicio</legend>
    <?php  include_once __DIR__. '/../templates/formulario.php';?>
    <input 
  class="btn btn-servicios"
  type="submit" 
  value="Añadir servicio">
  </fieldset>
</form>

