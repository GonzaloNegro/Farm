<?php session_start(); ?>
    <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->             
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="preconnect" href="https://fonts.googleapis.com">
			    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link rel="stylesheet" type="text/css" href="./Css/estiloLogin.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <title>Login GAFA</title>
            </head>
            <body class="bdy">
            <script type="text/javascript">
			function ok(){
				swal.fire(  {title: "Bienvenido!",
						icon: "success",
						showConfirmButton: true,
						showCancelButton: false,
						})
						.then((confirmar) => {
						if (confirmar) {
							window.location.href='./System/inicio.php';
						}
						}
						);
			}	
            function err(){
				swal.fire(  {title: "Usuario o contraseña erronea!",
						icon: "error",
						showConfirmButton: true,
						showCancelButton: false,
						}
						);
			}	
            function ini(){
				swal.fire(  {title: "Usuario deshabilitado!",
						icon: "error",
						showConfirmButton: true,
						showCancelButton: false,
						}
						);
			}	
			</script>
				<div class="login--tittle">
					<h1>Don Juan S.R.L.</h1>
				</div>
                <form method="POST" action="./Controlador/controlador_login.php">
                <div class="form-login">
                    <h5>Inicio de sesión</h5>
                    <input class="cajas" type="text" name="usuario" value="" placeholder="ingresar usuario" required>
                    <input class="cajas" type="password" name="password" value="" placeholder="ingresar password" required>
                    <input class="btn" type="submit" name="btningresar" value="Ingresar">
                </div>
                </form>
                <?php if(isset($_GET['ok'])){ ?> <script>ok();</script><?php }?>
                <?php if(isset($_GET['err'])){ ?> <script>err();</script><?php }?>
                <?php if(isset($_GET['ini'])){ ?> <script>ini();</script><?php }?>
            </body>
        </html>