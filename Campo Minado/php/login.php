<?php
    include("conectarBanco.php");
    if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    } 

    $username = $_POST["fname"];
    $senha = $_POST["lname"];

    $sql = "SELECT * FROM usuario WHERE username = '$username' and senha = SHA1('$senha')";
    $resultado = $conn->query($sql);

    if($resultado){
        if ($resultado->num_rows > 0) {            
            $conn->close();

            session_start();
            $_SESSION["username"] = $username;

            header("location: ../campo_minado.php");
        } else {
            echo "deu ruim dentro\n" . $username . " " . $senha;
        }
    }
    else {
        echo "deu ruim fora";
    }
    $conn->close();
?>