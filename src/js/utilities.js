


 function formatearFecha(fecha){
   // formatear la fecha
   const fechaOb=new Date(fecha);
   const dia=fechaOb.getDate()+2;
   const mes=fechaOb.getMonth();
   const year= fechaOb.getFullYear();


   const fechaUTC= new Date(Date.UTC(year, mes, dia));

  const opciones= {
    weekday:'long',
    year:'numeric',
    month:'long', 
    day:'numeric'
  }
   const fechaFormat=fechaUTC.toLocaleDateString('es-CO', opciones);

   

   return fechaFormat;
 }


 function formatearHora(hora){
  let horaFormateada='';

  const soloHora=hora.split(':')[0]; // extreaer solo la hora
  const soloMinutos=hora.split(':')[1]; // extraer solo los minutos

  //convertirlo en el formato de 1 horas
  if(soloHora> 0 && soloHora<12){
    horaFormateada=`${hora} a.m.`
  }
  else if(soloHora==12 ){
    horaFormateada=`${hora} p.m.`
  }
  else
  {
    horaFormateada=`${soloHora-12}:${soloMinutos} p.m.`
  }


  return horaFormateada;
 }



function formatearPrecio(precio ){
  const formatoMoneda = new Intl.NumberFormat('es-CO', {
    style: 'currency',
    currency: 'COP'
  });


  return formatoMoneda.format(precio);
}