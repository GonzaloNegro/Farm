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
        if (form.usuario.value == "") { 
            alerta('\"Usuario\"'); form.usuario.focus(); return true; 
            }
        if (form.nombre.value == "") { 
            alerta('\"Nombre\"'); form.nombre.focus(); return true; 
            }
        if (form.apellido.value == "") { 
            alerta('\"Apellido\"'); form.apellido.focus(); return true; 
            }
        if (form.pass.value == "") { 
            alerta('\"Contraseña\"'); form.pass.focus(); return true; 
            }
        if (form.tipo.value == "") { 
            alerta('\"Tipo\"'); form.tipo.focus(); return true; 
            }
        if (form.estado.value == "") { 
            alerta('\"Estado\"'); form.estado.focus(); return true; 
            }
            
            
            
            if(form.usuario.value != "" && form.nombre.value != "" && form.apellido.value != "" && form.pass.value != "" && form.tipo.value != "" && form.estado.value != ""){
                $(document).ready(function() {
                    $('#btnform').click(function() {
                        Swal.fire({
                            title: "¿Está seguro que desea dar de alta al usuario?",
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
        <a href="./usuarios.php"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>&nbsp Atrás</button></a>
    </div>
    <div class="centrado--titulo">
    <h1>Agregar usuario</h1>	
    </div>
    <div class="centrado--form">
        <form action="./agrUsuario.php" name="form_mod" id="form_mod" method="POST" class="centrado--form--form">
            <div class="labelInput">
                <label for="name">Usuario:</label>
                <input type="text"  name="usuario" id="prov" required>
            </div>
            <div class="labelInput">
                <label for="name">Nombre:</label>
                <input type="text" name="nombre" id="prov" required>
            </div>
            <div class="labelInput">
                <label for="name">Apellido:</label>
                <input type="text" name="apellido" id="prov" required>
            </div>
            <div class="labelInput">
                <label for="name">Contraseña:</label>
                <input type="password" name="pass" id="prov" required>
            </div>
            <div class="labelInput">
                <label>Tipo:</label>
                <select name="tipo"  required>
                    <option value="" selected disabled="tipo">-Seleccione una-</option>
                    <?php
                    $consulta= "SELECT * FROM tipo_usuario ORDER BY tipo";
                    $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                    ?>
                    <?php foreach ($ejecutar as $opciones): ?> 
                    <option value="<?php echo $opciones['id_tipoUsuario']?>"><?php echo $opciones['tipo']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="labelInput">
                <label>Estado:</label>
                <select name="estado"  required>
                    <option value="" selected disabled="estado">-Seleccione una-</option>
                    <?php
                    $consulta= "SELECT * FROM estadousuario ORDER BY estadoUsuario";
                    $ejecutar= mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                    ?>
                    <?php foreach ($ejecutar as $opciones): ?> 
                    <option value="<?php echo $opciones['id_EstadoUsuario']?>"><?php echo $opciones['estadoUsuario']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="labelInputbtn" style="gap:5px;">
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <button type="button" id="btnform" onClick="validar_formulario(this.form)" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
</div>

</body>