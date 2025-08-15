<?php
    require "conexion.php";


    $email = $_POST["correo"]; /*Obtenemos el email del formulario con metodo POST*/
    $clave = $_POST["clave"]; /*Obtenemos la clave del formulario con metodo POST*/
    $confir_clave = $_POST["confirmar_clave"]; /*Obtenemos la clave para confirmar del formulario con metodo POST*/

    $request_verify = "SELECT 1 FROM usuarios WHERE correo = ?"; /*Creamos un string con el comando SQL que vamos a ejecutar*/
    $stmt_verify = $conn->prepare($request_verify); /*Usamos un Stmt(Molde o plantilla) para evitar SQL Inyection hacemos que prepare el comando pero no lo ejecute todavia*/
    $stmt_verify->bind_param("s", $email,); /*Aqui rellenamos el ? que usamos en la plantilla la S representa el valor s(string) y la variable que va en el ?*/ 
    $stmt_verify->execute(); /*Aqui ejecutamos el comando SQL que preparamos anteriormente*/
    $stmt_verify->store_result(); /*Aqui guardamos el resultado del comando o consulta SQL */

    if($stmt_verify->num_rows > 0){/*Aqui hacemos que si la consulta SQL tiene mas de 0 filas, osea si encontro el correo ejecute cierto codigo*/ 
        die("Este correo ya se encuentra registrado");
    }

    

    if ($clave == $confir_clave) {

        $request = "INSERT INTO `usuarios`(`correo`, `clave`) VALUES (?,?)";
        

        $clave_haseada = password_hash($clave, PASSWORD_DEFAULT);

        $stmt = $conn ->prepare($request);
        $stmt->bind_param("ss", $email, $clave_haseada);

        

        if ($stmt -> execute()) {
            echo "Registro Existoso";
        }else{
            echo "Reigistro fallido" . $stmt->error;
        }

    }else{
        echo"LA CONTRASEÑAS NO COINCIDEN";
    }

    $conn -> close();
    $stmt -> close();
    $stmt_verify -> close();

?>