

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