const btnProyecto = document.querySelector('#btnProyecto');
const formu1 = document.querySelector('#formu1');
const formu2 = document.querySelector('#formu2');

btnProyecto.addEventListener('click', ()=>{
    /* formu1.style.display = "none"; */
    if(formu2.style.display == "none"){   
        formu2.style.display = "flex";
        formu1.style.display = "none";
        btnProyecto.innerHTML = "Cargar proyecto Iniciado/No iniciado";
    }else{
        formu2.style.display = "none";
        formu1.style.display = "flex";
        btnProyecto.innerHTML = "Cargar proyecto finalizado";
    }
});

/* ----------------- */