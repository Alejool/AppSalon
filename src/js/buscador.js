
document.addEventListener('DOMContentLoaded', ()=>{
  inicarApp();
})

function inicarApp(){
  buscarFecha(); 
}


function buscarFecha(){
  const inputFecha= document.querySelector('#fecha');

  inputFecha.addEventListener('input', (e)=>{
    const fecha=e.target.value;
    window.location=`?fecha=${fecha}`
  })

  
  

}