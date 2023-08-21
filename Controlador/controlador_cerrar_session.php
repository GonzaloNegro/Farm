<?php
#inicio sesion
session_start();
#destruyo la sesion(cierro)
session_destroy();
#redirijo al login
header("location:../login.php");


?>