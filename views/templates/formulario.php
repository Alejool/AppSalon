


  

  <div class="form__campo ">
    <label class="form__label" for="nombre">Nombre</label>
    <input 
    id="nombre" 
    type="text" 
    name="nombre"
    class="form__input"
    placeholder="corte de cabello..."
    required
    value='<?php echo $servicio->nombre ?? ''?>'
    > 
  </div><!--campo-->
  <div class="form__campo">
    <label class="form__label" for="precio">Precio</label>
    <input 
    id="precio" 
    type="number"
    name="precio" 
    class="form__input"
    placeholder="10000.."
    value='<?php echo $servicio->precio ?? 0 ?>'
    > 
  </div><!--campo-->
  
