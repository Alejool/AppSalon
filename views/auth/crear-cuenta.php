
<main class=" login ">
  <h2 class="pagina__title">Crear Cuenta</h2>
  <p class="pagina__descripcion">Ingresa tus datos para crear la cuenta: </p>

  <?php  include_once __DIR__ . "/../templates/alertas.php"?>

  <form  class="form  " method="POST" >

      <div class="form__campo ">
            <label for="nombre" class="form__label">Nombre</label>
            <input 
              id="nombre"   
              name="crear[nombre]"
              type="text" 
              class="form__input"
              placeholder="Tu Nombre" 
              value="<?php echo s($usuario->nombre) ?>"
              required
              >
        </div> <!--campo-->

        <div class="form__campo ">
            <label for="apellido" class="form__label">Apellido</label>
            <input 
              id="apellido"   
              name="crear[apellido]"
              type="text" 
              class="form__input"
              placeholder="Tu Apellido" 
              value="<?php echo s($usuario->apellido) ?>"
              required
              >
        </div> <!--campo-->

        <div class="form__campo ">
            <label for="telefono" class="form__label">Teléfono</label>
            <input 
              id="telefono"   
              name="crear[telefono]"
              type="tel" 
              class="form__input"
              placeholder="Tu telefono" 
              value="<?php echo s($usuario->telefono) ?>"
              required>
        </div> <!--campo-->

        <div class="form__campo ">
            <label for="email" class="form__label">Email</label>
            <input 
              id="email"   
              name="crear[email]"
              type="email" 
              class="form__input"
              placeholder="Tu email" 
              value="<?php echo s($usuario->email) ?>"
              required>
        </div> <!--campo-->

        <div class="form__campo ">
           <label for="contraseña"  class="form__label">password</label>
           <input 
              id="contraseña" 
              name="crear[password]"
              type="password" 
              class="form__input" 
              placeholder="Tu password" 
              minlength="6" 
              required
              autocomplete="off">
        </div> <!--campo-->

        
        


        <div class='form__btn'>
          <input type="submit" value="Crear Cuenta" class= "btn">
        </div> 
    
        
  </form>

  <div class="actions">
    <a href="/" class="option">¿Ya tienes una cuenta? Inicia Sesión</a>
    
  </div>

</main>