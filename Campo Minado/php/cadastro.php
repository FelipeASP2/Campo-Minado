<?php
    include("conectarBanco.php");
    if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    } 

    $username = $_POST["username"];
    $senha = $_POST["senha"];
    $nome = $_POST["nome"];
    $cpf = $_POST["CPF"];
    $nascimento = $_POST["data"];
    $telefone = $_POST["telefone"];
    $email = $_POST["e-mail"];

    $sql = "INSERT INTO usuario (username, senha, nm_usuario, cpf_usuario, dt_nascimento, tel, email) VALUES ('$username', SHA1('$senha'), '$nome', '$cpf', '$nascimento', '$telefone', '$email')";

    if ($conn->query($sql)) {
        $conn->close();
        
        session_start();
        $_SESSION["username"] = $username;
        
        header("location: ../campo_minado.php");
    } 
    else {
        $conn->close();
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

?>
