
<main class=" login ">
  <h2 class="pagina__title">Cambiar contraseña</h2>
  <p class="pagina__descripcion">Cambia tu contraseña </p>


  <form  class="form form__noMarginTop " method="POST" >

  <?php  include_once __DIR__ . "/../templates/alertas.php"?>
  
    <?php if($estado){ ?>
        <div class="form__campo ">
            <label for="email" class="form__label">Email</label>
            <input 
              id="email"   
              name="recuperar[email]"
              type="email" 
              class="form__input"
              placeholder="Tu email" 
              required>
        </div> <!--campo-->

    

      <div class='form__btn'>
          <input type="submit" value="Recuperar" class= "btn">
        </div> 
          
      <?php } ?>
        
  </form>

  <div class="actions">
    <a href="/" class="option">¿Ya la restauraste ? Iniciar sesión</a>
  </div>

</main>
