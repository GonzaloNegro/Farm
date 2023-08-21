/*Cuando el documento este listo ejecutamos una funcion*/
$(document).ready(function () {
  /*ACCEDER AL MENU, A LOS ELEMENTOS LI Q POSEAN UL DENTRO*/
  $(".menu li:has(ul)").click(function (e) {
    /*prevenimos q redirija*/
    e.preventDefault();
    /*Si posee la clase activate lo queremos mostrar*/
    if ($(this).hasClass("activado")) {
      $(this).removeClass("activado");
      $(this).children("ul").slideUp();
    } else {
      $(".menu li ul").slideUp();
      $(".menu li").removeClass("activado");
      $(this).addClass("activado");
      $(this).children("ul").slideDown();
    }
  });

  $(".btn-menu").click(function () {
    $(".contenedor-menu .menu").$(selector).slideToggle();
  });
  $(window).resize(function(){
if($(document).width() > 450){
    $('.contenedor-menu .menu').css({'display' : 'block'});
}
if($(document).width()< 450){
    $('.contenedor-menu .menu').css({'display' : 'none'});
    $('.menu li ul').slideUp();
    $('.menu li ul').removeClass('activado');
}
  });
});
/* --------------------------------------------- */
/* --------------------------------------------- */
/* --------------------------------------------- */
/* --------------------------------------------- */

const btnDepartamentos = document.getElementById('btn-departamentos'),
	  btnCerrarMenu = document.getElementById('btn-menu-cerrar'),
	  grid = document.getElementById('grid'),
	  contenedorEnlacesNav = document.querySelector('#menu .contenedor-enlaces-nav'),
	  contenedorSubCategorias = document.querySelector('#grid .contenedor-subcategorias'),
	  esDispositivoMovil = () => window.innerWidth <= 800;

btnDepartamentos.addEventListener('mouseover', () => {
	if(!esDispositivoMovil()){
		grid.classList.add('activo');
	}
});

grid.addEventListener('mouseleave', () => {
	if(!esDispositivoMovil()){
		grid.classList.remove('activo');
	}
});

document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
	elemento.addEventListener('mouseenter', (e) => {
		if(!esDispositivoMovil()){
			document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
				categoria.classList.remove('activo');
				if(categoria.dataset.categoria == e.target.dataset.categoria){
					categoria.classList.add('activo');
				}
			});
		};
	});
});

// EventListeners para dispositivo movil.
document.querySelector('#btn-menu-barras').addEventListener('click', (e) => {
	e.preventDefault();
	if(contenedorEnlacesNav.classList.contains('activo')){
		contenedorEnlacesNav.classList.remove('activo');
		document.querySelector('body').style.overflow = 'visible';
	} else {
		contenedorEnlacesNav.classList.add('activo');
		document.querySelector('body').style.overflow = 'hidden';
	}
});

// Click en boton de todos los departamentos (Para version movil).
btnDepartamentos.addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.add('activo');
	btnCerrarMenu.classList.add('activo');
});

// Boton de regresar en el menu de categorias
document.querySelector('#grid .categorias .btn-regresar').addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.remove('activo');
	btnCerrarMenu.classList.remove('activo');
});

document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
	elemento.addEventListener('click', (e) => {
		if(esDispositivoMovil()){
			contenedorSubCategorias.classList.add('activo');
			document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
				categoria.classList.remove('activo');
				if(categoria.dataset.categoria == e.target.dataset.categoria){
					categoria.classList.add('activo');
				}
			});
		}
	});
});

// Boton de regresar en el menu de categorias
document.querySelectorAll('#grid .contenedor-subcategorias .btn-regresar').forEach((boton) => {
	boton.addEventListener('click', (e) => {
		e.preventDefault();
		contenedorSubCategorias.classList.remove('activo');
	});
});

btnCerrarMenu.addEventListener('click', (e)=> {
	e.preventDefault();
	document.querySelectorAll('#menu .activo').forEach((elemento) => {
		elemento.classList.remove('activo');
	});
	document.querySelector('body').style.overflow = 'visible';
});


/* ALTA DE PROYECTOS */
function habilitar(){
    const disponible = document.querySelector('#disponible');
    const parcela = document.querySelector('#parcela').value;
    const value = document.querySelector('.value');

    val = 0;

    if(parcela == ""){
        val++;
    }

    if(val == 0){
        disponible.style.display = "flex";
		console.log(parcela);
		value.innerHTML = parcela;
    }else{
        disponible.style.display = "none";
    }
}
    document.querySelector('#parcela').addEventListener("change", habilitar);
