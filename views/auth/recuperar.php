<main class=" login ">


  <h2 class="pagina__title">Cambia tu contraseña</h2>
  <p class="pagina__descripcion">Escribe tu nuevo passsword </p>


  <form  class="form " method="POST" >
    <?php  include_once __DIR__ . "/../templates/alertas.php"?>

    <?php if($estado){ ?>
      <div class="form__campo ">
           <label for="contraseña"  class="form__label">password</label>
           <input 
              id="contraseña" 
              name="restaurar[password]"
              type="password" 
              class="form__input" 
              placeholder="Tu nueva password" minlength="6"
              autocomplete="off"
              required >
        </div> <!--campo-->

    

      <div class='form__btn'>
          <input type="submit" value="cambiar contraseña" class= "btn">
        </div> 
    <?php } ?>

      
      
        
  </form>

  <div class="actions">
    <a href="/" class="option">¿Ya la restauraste ? Iniciar sesión</a>
  </div>

</main>