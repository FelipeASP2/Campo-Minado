<?php
    include("verificaSessao.php");
    
    include("conectarBanco.php");
    if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    } 

    session_start();

    $qtd_tempo_partida = $_POST["tempo_partida"];
    $cd_resultado = $_POST["cd_resultado"];

    $sql = "SELECT MAX(cd_jogo) FROM jogo_usuario WHERE username ='".$_SESSION["username"]."'";
    $resultado = $conn->query($sql);
    
    if($resultado){
    	$row = $resultado->fetch_assoc();
    	$cd_jogo = $row["cd_jogo"];

        $sql = "SELECT x_tab, y_tab FROM jogo WHERE cd_jogo = $cd_jogo";
    	$resultado = $conn->query($sql);
        
        if($resultado){
            $row = $resultado->fetch_assoc();
            $celula_tempo = $qtd_tempo_partida/(row["x_tab"] * row["y_tab"]);
            
            $sql = "UPDATE jogo_usuario SET qtd_partida = $qtd_tempo_partida, tempo_celula = $celula_tempo, cd_resultado = $cd_resultado WHERE cd_jogo = $cd_jogo AND username = '".$_SESSION["username"]."';";
            $resultado = $conn->query($sql);

            if(!$resultado){
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        }
        else{
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } 
    else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
?>
