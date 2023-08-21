<?php #Llammo a cabecera, incluye el archivo cabecera.php desde template
include ("../Modelo/Conexion.php");
include('../Template/Cabecera.php');
error_reporting(0);
?>

<script>
    function alerta(campo) { 
    alert("Por favor, completa el campo "+campo) 
    }
    function validar_formulario(form){
        if (form.cultivo.value == "") { 
            alerta('\"Cultivo\"'); form.cultivo.focus(); return true; 
            }
        if (form.semillas.value == "") { 
            alerta('\"Kg semillas/Has\"'); form.semillas.focus(); return true; 
            }
        if (form.rinde.value == "") { 
            alerta('\"Rinde esperado/Has\"'); form.rinde.focus(); return true; 
            }
            
            
            
            if(form.cultivo.value != "" && form.semillas.value != "" && form.rinde.value != ""){
                $(document).ready(function() {
                    $('#btnform').click(function() {
                        Swal.fire({
                            title: "¿Está seguro que desea dar de alta el cultivo?",
                                type: "warning",
                                showCancelButton: true,
                                showConfirmButton: true,
                                confirmButtonColor: '#2CB073',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Aceptar',
                                cancelButtonText: "Cancelar",
                                customClass:{
                                    actions: 'sweet--btn'
                                }
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    $("#form_mod").submit()
                                } else if (result.isDenied) {
                                    Swal.fire('Changes are not saved', '', 'info')
                                }
                            })
                        }
                    )
                })
/* form.submit() */
            }
        }
</script>

<div class="centrado">
    <div class="centrado-vlv">
        <a href="./cultivos.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
    <div class="centrado--titulo">
    <h1>Agregar cultivo</h1>	
    </div>
    <div class="centrado--form">
        <form action="./agrCultivo.php" name="form_mod" id="form_mod" method="POST" class="centrado--form--form">
            <div class="labelInput">
                <label for="name">Cultivo:</label>
                <input type="text"  name="cultivo" id="prov" required>
            </div>
            <div class="labelInput">
                <label for="name">Kg semillas/Has:</label>
                <input type="number" name="semillas" id="prov" min="1" required>
            </div>
            <div class="labelInput">
                <label for="name">Rinde esperado/Has:</label>
                <input type="number" name="rinde" id="prov" min="1" required>
            </div>
            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" onClick="validar_formulario(this.form)" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
</div>

</body>