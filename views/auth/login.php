
<main class=" login ">
  <h2 class="pagina__title">Login</h2>
  <p class="pagina__descripcion">Inicia sesión con tus datos </p>

 
  <form  class="form " method="POST" action="/">
   <?php  include_once __DIR__ . "/../templates/alertas.php"?>
    
        <div class="form__campo ">
            <label for="email" class="form__label">Email</label>
            <input 
              id="email"   
              name="login[email]"
              type="email" 
              class="form__input"
              placeholder="Tu email" 
              required>
        </div> <!--campo-->

        <div class="form__campo ">
           <label for="contraseña"  class="form__label">password</label>
           <input 
              id="contraseña" 
              name="login[password]"
              type="password" 
              class="form__input" 
              placeholder="Tu password" minlength="6"
              autocomplete="off"
              required >
        </div> <!--campo-->


        <div class='form__btn'>
          <input type="submit" value="Iniciar Sesión" class= "btn">
        </div> 
      
        
  </form>

  <div class="actions">
    <a href="/crear-cuenta" class="option">¿No tienes cuenta? Crear cuenta</a>
    <a href="/olvidar" class="option">"¿olvidaste tu password?"</a>
  </div>

</main>
