function confirmacion(e){
	if (confirm("¿Desea eliminar este registro?")) {
		return true;
	} else {
		e.preventDefault();

	} 
}
let linkdelete = document.querySelectorAll(".delete");

for(var i = 0; i < linkdelete.length; i++ ){
	linkdelete[i].addEventListener('click',confirmacion);
}
	
	

