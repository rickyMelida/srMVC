<?php
    require_once "../assets/base_datos.php";

    $correo = $_POST['correo_sesion'];
    $pass = $_POST['contrasena_sesion'];
    $recordar = $_POST['recuerdame'];


    if(isset($_POST) && !empty($correo) && !empty($pass)) {

        $bd = $_POST['base_datos'];

        session_start();

        if($recordar == "on"){

            for ($i=0; $i < 1; $i++) { 
                setcookie("correo", $correo);
                setcookie("pass", $pass);
            }

        } 


        $obj = new baseDatos();
        $con = $obj->nueva_conexion($bd);
        $sql = "SELECT * from usuario where correo_usu='$correo' and pass_usu='$pass'";

        $res = mysqli_query($con, $sql);

        

        $filas = mysqli_num_rows($res);

        if($filas > 0) {
            $r = $obj->mostrar($sql, $con);

            foreach($r as $key) {
                $_SESSION['usuario'] = $key['nombre_usu'];
            }
            $var_session = $_SESSION['usuario'];

            //header("Location: ../index.php");
            echo "Los datos de la cookies son ".$_COOKIE['correo'] . " y ". $_COOKIE['pass'];
            

        }else {
            header("Location: ../src/errorDB.php");
        }
        
    }else {
        header("Location: ../src/iniciar_sesion.php");
    }




?>