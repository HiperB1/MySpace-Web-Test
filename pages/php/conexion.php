<?php
    $USER = "myspace";
    $SERVER = "mysql-myspace.alwaysdata.net";
    $PASSWORD = "Juan12142006_";
    $DATABASE = "myspace_basedata";

    $conn = new mysqli($SERVER, $USER, $PASSWORD, $DATABASE);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }



?>