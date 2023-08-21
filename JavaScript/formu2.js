const changeG = document.querySelector('#changeG');
const piechart2 = document.querySelector('#piechart2');
const piechart4 = document.querySelector('#piechart4');

changeG.addEventListener('click', ()=>{
    if(piechart4.style.display == "none"){   
        piechart4.style.display = "flex";
        piechart2.style.display = "none";
        changeG.innerHTML = "Ver activos";
    }else{
        piechart4.style.display = "none";
        piechart2.style.display = "flex";

        changeG.innerHTML = "Ver Finalizados";
    }
});