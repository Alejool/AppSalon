let paso=1;
const pasoInicial=1;
const pasoFinal=3;

//object para guardar los servicios elegidos
let cita= {
  id:'',
  nombre:'',
  fecha:'',
  hora:'',
  servicios:[]
}

document.addEventListener('DOMContentLoaded', ()=>{
  iniciarApp();
})


function iniciarApp(){
  mostrarSeccion();
  //campia la seccion 
  tabs();
  //paginador
  paginador();

  // btn de nav
  paginaSiguiente();
  paginaAnterior();

  // consulta la api de php
  consultarApi();

  // añadir datos adicionales a la cita
  datosAdicionales();

 

}


function mostrarSeccion(){
  // ocultar para luego solo mostrar una de las secciones
  const seccionAnterior=document.querySelector('.mostrar');
  if(seccionAnterior){
    seccionAnterior.classList.remove('mostrar');
  }

  // quitar el resaltado al tab anterior
  const tenerTab=document.querySelector('.actual');
  if(tenerTab){
    tenerTab.classList.remove('actual');
  }
  

  //selecciona la seccion con el paso..
  const seccion=document.querySelector(`#p-${paso}`);
  seccion.classList.add('mostrar');

  // mostrar el tab que esta actualmente
  const tab=document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add('actual');

}



function tabs(){
  const btns= document.querySelectorAll('.tabs button');

  btns.forEach(btn=>{
    btn.addEventListener('click', (e)=>{
      paso=Number(e.target.dataset.paso);
      console.log(paso)

      mostrarSeccion();
      paginador();
    });
  })
}


function paginador(){
 
  const anterior=document.querySelector('#anterior');
  const siguiente=document.querySelector('#siguiente');


  if(paso===1){
    anterior.classList.add('ocultar');
    siguiente.classList.remove('ocultar');
  } 
  else if(paso==3) {
    anterior.classList.remove('ocultar');
    siguiente.classList.add('ocultar');
    mostrarResumen();
  } 
  else {
    anterior.classList.remove('ocultar');
    siguiente.classList.remove('ocultar');
  }

  mostrarSeccion();
  
}


function paginaAnterior(){
  const btnAnterior=document.querySelector('#anterior');
  btnAnterior.addEventListener('click', ()=>{

    if(paso>pasoInicial && paso<=pasoFinal){
      paso--;
     paginador();
    }
    
  })

}

function paginaSiguiente(){
  const btnSiguiente=document.querySelector('#siguiente');
  btnSiguiente.addEventListener('click', ()=>{

    if(paso>=pasoInicial && paso<pasoFinal){
      paso++;
     
      paginador();
    }
    
  })
}

async function consultarApi()
{
  // agregar el spinner de carga
  const sipnner= document.querySelector('.spinner');
    sipnner.style.display='flex';

  try {
    const url=`${location.origin}/api/servicios`;
    const respuesta= await fetch(url);
    const servicios= await respuesta.json();

    sipnner.style.display='none';

    mostrarServicios(servicios);
    
  } catch (error) {
    console.log(error)
    
  }
}

function mostrarServicios(servicios){

  servicios.forEach(servicio=>{
      const {id, nombre, precio}= servicio;

      // crear nombre
      const nombreServicio= document.createElement('P');
      nombreServicio.classList.add('servicio__nombre');
      nombreServicio.textContent=`${nombre}`;

      // crear precio
      const precioServicio= document.createElement('P');
      precioServicio.classList.add('servicio__precio');
      precioServicio.textContent=formatearPrecio(precio);


      // cada servicio
      const Servicio=document.createElement('DIV');
      Servicio.classList.add('servicio');
      Servicio.dataset.idServicio=id;
      Servicio.onclick=()=>{
        servicioSeleccionado(servicio)
        
      };


      Servicio.appendChild(nombreServicio);
      Servicio.appendChild(precioServicio);

      document.querySelector('#servicios').appendChild(Servicio);

    })
  
}

function servicioSeleccionado(servicio){
  const {id}=servicio;
  const {servicios}=cita;
  cita.servicios=[...servicios, servicio];

  

  if(servicios.some(agregado=> agregado.id===id)){
    cita.servicios=servicios.filter(buscado=> buscado.id!==id)
  }
  else {
    cita.servicios=[...servicios, servicio]
  }

  // seleccionar el elemento para quitar o agregar la clase servicio__seleccionado 
  const servicioClick=document.querySelector(`[data-id-servicio="${id}"]`)
  // comprobar si tiene la clase para eliminar o añadirlo
  servicioClick.classList.toggle('servicio__seleccionado');


}

function datosAdicionales(){
  
    // leer el id del cliente y añadirlo al objeto
    const idCliente= document.querySelector('#id');
    cita.id=idCliente.value;

    // asignar nombre al objeto
  cita.nombre=document.querySelector('#nombre').value;
  
  añadirFecha();
  añadirHora();
}

function añadirFecha(){
   //asignar fecha al objeto
   const fechaInput=document.querySelector('#fecha');
   fechaInput.addEventListener('input', function(e){
     const dia=new Date(e.target.value).getUTCDay();
 
     if([6,0].includes(dia)){
       e.target.value='';
       cita.fecha='';
       alerta('error', 'no abrimos sábados o domingos', '.form')
     }
     else {
       cita.fecha=e.target.value;
     }

     
     
   })
}

function añadirHora(){
  // asignar hora al objeto de cita
  const horaInput=document.querySelector('#hora');
  horaInput.addEventListener('input', function(e){
    
    const hora=horaInput.value.split(':')[0];
  

    if(hora<9 || hora>20){
      e.target.value='';
      cita.hora=''
      alerta('error', 'selecciona otro horario, no atendemos.', '.form')
    }
    else {
      cita.hora=e.target.value;
    }
    
    
  })
}

function mostrarResumen(){
  const contenido=document.querySelector('.cita__contenido');

  if(Object.values(cita).includes('') || cita.servicios.length===0){
    alerta('error','Debes seleccionar servicios y completar todos los campos', '.cita__resumen', false);
    contenido.classList.add('ocultar');
    return;  
  }
    //eliminar la alerta si existia
    eliminarAlerta();
    limpiarResumen();
    // mostrar la seccion de resumen y demas
    contenido.classList.remove('ocultar');
    const citaContenido=document.querySelector('.resumen__insertado')
    // Extraer el datos para crear el scrpting
    const {nombre, fecha, hora, servicios}= cita;
    const nombreCliente=document.createElement('P');
    nombreCliente.classList.add('resumen__info');
    nombreCliente.innerHTML=`<span>Nombre: </span> ${nombre}`

   const fechaFormateada=formatearFecha(fecha);

    const fechaCliente=document.createElement('P');
    fechaCliente.classList.add('resumen__info');
    fechaCliente.innerHTML=`<span >Fecha: </span> ${fechaFormateada}`

    const horaFormateada=formatearHora(hora);

    const  horaCliente=document.createElement('P');
    horaCliente.classList.add('resumen__info');
    horaCliente.innerHTML=`<span> Hora: </span> ${horaFormateada}`


    // iterar sobre los servicios y mostrarlo
    serviciosCita(servicios);

    // crear el boton de envio 
      const btnEnviar=document.createElement('BUTTON');
      btnEnviar.classList.add('resumen__enviar');
      btnEnviar.textContent='enviar cita'
      btnEnviar.onclick = reservarCita;



    citaContenido.appendChild(btnEnviar);
    citaContenido.prepend(horaCliente)
    citaContenido.prepend(fechaCliente)
    citaContenido.prepend(nombreCliente)
}

function limpiarResumen(){

  // eliminar los parrafos de contenedor
  const contenedor=document.querySelector('.resumen__insertado')
  const parrafos = contenedor.getElementsByTagName('p');   

  if (parrafos.length ) {
    const parrafosArray = Array.from(parrafos); // Convertir el HTMLCollection en un array
    const primerosTresParrafos = parrafosArray.splice(0, parrafosArray.length); // Obtener los tres primeros párrafos y eliminarlos del array
    
    // Eliminar los tres primeros párrafos del contenedor
    primerosTresParrafos.forEach(parrafo => {
      parrafo.parentNode.removeChild(parrafo);
    });
  }


  // eliminar los servicios 
  const listadoResumen=document.querySelector('.listado-servicios-resumen');
  listadoResumen.textContent=''

  // eliminando el btn 
  const btn= document.querySelector('.resumen__enviar')
  if (btn){
    btn.remove();
  }

}

async function reservarCita(){

  const {id, fecha, hora, servicios}= cita;
  const idServicios= servicios.map(servicio=> servicio.id)

  // formData
  const data= new FormData();
  data.append('fecha', fecha)
  data.append('usuarioId', id)
  data.append('hora', hora)
  data.append('servicios', idServicios)



  // realizar la peticion a a la api
  try {

    const url= '/api/citas';

    const respuesta = await fetch(url, {
      method:'POST',
      body: data  // detecta los datos de forData
    });
  
  
    const resultado= await respuesta.json();
  
    console.log(resultado)

    if(resultado.resultado){
      Swal.fire({
        icon: 'success',
        title: 'Cita creada correctamente',
        confirmButtonText: 'OK',
        
      }).then (()=>{
        window.location.reload();
      })
    }
    
  } catch (error) {
    
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se pudo guardar la cita',
    })
    
  }
 
  
}

function serviciosCita(servicios){

  const Resumen=document.querySelector('.listado-servicios-resumen') 
  servicios.forEach(servicio=>{
    // crear nombre
    const nombreServicio= document.createElement('P');
    nombreServicio.classList.add('servicio__nombre');
    nombreServicio.textContent=`${servicio.nombre}`;

    // crear precio
    const precioServicio= document.createElement('P');
    precioServicio.classList.add('servicio__precio');
    precioServicio.innerHTML=`$${servicio.precio}`;


    // cada servicio
    const Servicio=document.createElement('DIV');
    Servicio.classList.add('servicio');

    // insertarle los valores
    Servicio.appendChild(nombreServicio);
    Servicio.appendChild(precioServicio);
  
    // mostrarlo en pantalla
    Resumen.appendChild(Servicio);
  })
}

function alerta(tipo, contenido, ubicacion, eliminarla=true){
 
  eliminarAlerta(); //elimina la alerta previa si existe
  

  // crear la alerta si no existe
  const alerta= document.createElement('P');
  alerta.classList.add('alerta', `${tipo}`);
  alerta.textContent=contenido;

  const elemento=document.querySelector(ubicacion);
  elemento.prepend(alerta)

  // eliminar la alerta

  if (eliminarla){
    setTimeout(()=>{
      alerta.remove();
    },3000)
  }
    
  
}

function eliminarAlerta(){
  const alertaExistente = document.querySelector('.alerta');
  if (alertaExistente) {
    alertaExistente.remove();
  }
}





