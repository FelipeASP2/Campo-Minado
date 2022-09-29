<?php
    include("verificaSessao.php");

    include("conectarBanco.php");
    if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    } 

    session_start();

    $xTab = $_POST["xTab"];
    $yTab = $_POST["yTab"];
    $nBomb = $_POST["nBomb"];
    $tpJogo = $_POST["modo-jogo"];

    $sql = "INSERT INTO jogo (cd_modo_jogo, x_tab, y_tab, qtd_bombas) VALUES ($tpJogo, $xTab, $yTab, $nBomb)";

    if ($conn->query($sql)){
        $cd_jogo = selectLastIdJogo();
        if($cd_jogo >= 0){
            $sql = "INSERT INTO jogo_usuario (cd_jogo, username) VALUES ($cd_jogo,'".$_SESSION["username"]."')";
        
            if (!$conn->query($sql)){
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }    
        }
    } 
    else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    function selectLastIdJogo(){
        $sql = "SELECT MAX(cd_jogo) FROM jogo";
        $resultado = $conn->query($sql);
        if($resultado){
            $row = $resultado->fetch_assoc();    
            return $row["cd_jogo"];
        }
        
        return -1;
    }
?>

