
<main class="cita">

<?php 
  include_once __DIR__. '/../templates/barra.php'
?>

<h1 class="pagina__title">Agenda tu cita</h1>
<p class="descripcon-pagina"> Elegi tus servicios para tu cita y llena tus datos</p>


<div id='cita_app '>
  <nav class="tabs">
    <button class="actual" type="button" data-paso='1'>Servicios</button>
    <button type="button" data-paso='2'>Información</button>
    <button type="button" data-paso='3'>Resumen</button>
  </nav>
  <div id='p-1' class=" cita__seccion mostrar">
    <h2> Servicios</h2>
    <p>Elige tus servicios</p>
    
    <div class="spinner">
      <span class="loader "></span>
    </div>
    <div id="servicios" class="listado-servicios">

    </div>
  </div>
  <div id='p-2' class=" cita__seccion">
   <h2> Datos y cita</h2>
    <p>LLena los campos</p>
    <div id="servicios" class="listado-servicios">
      
    </div>

    <form 
      class="form form__style form__noMarginTop" 
      method="POST"
      action="/api/citas"
      >
      <div class="form__campo form__campo--noflex">
        <label 
          class="form__label form__label--noflex" 
          for='nombre'>
          Tu nombre
        </label>
        <input
          id="nombre" 
          class="form__input"
          type="text" 
          placeholder="Alejandro, josue, maria"
          disabled
          value="<?php echo $nombre?>"
          />
      </div><!--campo-->

      <div class="form__campo form__campo--noflex">
        <label 
          class="form__label form__label--noflex" 
          for='fecha'>
          fecha
        </label>
        <input
          id="fecha" 
          class="form__input"
          type="date" 
          min='<?php echo date('Y-m-d', strtotime('+1 day')) ?>'/>
      </div><!--campo-->

      <div class="form__campo form__campo--noflex">
        <label 
          class="form__label form__label--noflex" 
          for='hora'>
          Hora
        </label>
        <input
          id="hora" 
          class="form__input"
          type="time" />
      </div><!--campo-->

      <input  id="id" type='hidden' value="<?php echo $id ?>" />
     
    </form>

    </div>
    
  </div>

  <div id='p-3' class="cita__seccion cita__resumen">
    <div class="cita__contenido">
      <h2>Resumen</h2>
        <p>Verifica la información</p>
      <div class="resumen__insertado">
        <div id="servicios" class="listado-servicios listado-servicios-resumen">
        </div>
      </div>
    </div>
  </div>

  <div class="paginacion">
    <button 
      type="button"
      class="btn"
      id="anterior"> 
      &laquo; Anterior
    </button>

    <button 
      type="button"
      class="btn"
      id="siguiente"> 
      Siguiente &raquo; 
    </button>
  </div>
</div>

<?php
  $script="
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script src='/build/js/app.min.js'></script>   
  <script src='/build/js/utilities.min.js'></script>   
  ";
?>

</main>