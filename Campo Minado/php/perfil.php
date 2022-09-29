<?php
    include("verificaSessao.php");
    include("conectarBanco.php");

     if ($conn->connect_error) {
        die("Falha de conexÃ£o: " . $conn->connect_error);
    }
    
    
    $user = $_SESSION["username"];

    $sql = "SELECT * FROM usuario WHERE username = $user";
    $resultado = $conn->query($sql);

    if ($resultado) {
        $row = $resultado->fetch_assoc();

        $username = $row['username'];
        $senha = $row['senha'];
        $nm_usuario = $row['nm_usuario'];
        $cpf_usuario = $row['cpf_usuario'];
        $dt_nascimento = $row['dt_nascimento'];
        $tel = $row['tel'];
        $email = $row['email'];

        $perfil = array(
                'username' => $username,
                'senha' => $senha,
                'nm_usuario' => $nm_usuario,
                'cpf_usuario' => $cpf_usuario,
                'dt_nascimento' => $dt_nascimento,
                'tel' => $tel,
                'email' => $email
            );
        echo json_encode($perfil);
    }

    return $resultado;
?>