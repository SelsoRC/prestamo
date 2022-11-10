function confirmacion(e){
	if (confirm("¿Desea devolver este equipo?")) {
		return true;
	} else {
		e.preventDefault();

	} 
}
let linkdelete = document.querySelectorAll(".devo");

for(var i = 0; i < linkdelete.length; i++ ){
	linkdelete[i].addEventListener('click',confirmacion);
}