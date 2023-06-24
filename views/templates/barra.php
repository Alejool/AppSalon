<div class="cita__info"> 
  <p> Bienvenido: <span> <?php  echo isset($nombre) ? $nombre : ''; ?> </span></p>
  <a href="/logout"
   class="btn">
    Cerrar sesión
  </a>
</div>


<?php if(isset($_SESSION['admin'])){ ?>
  <div class="barra-admin">
    <a href="/admin"
    class="btn">
      Ver Citas
    </a>
    <a href="/servicios"
    class="btn">
      servicios
    </a> 
    <a href="/servicios/crear"
      class="btn">
      crear Servicio
    </a> 
  </div>
<?php } ?>