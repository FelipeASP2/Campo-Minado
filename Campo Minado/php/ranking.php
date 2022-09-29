<?php

    include("php/verificaSessao.php");
    include("conectarBanco.php");

     if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    } 
    
    session_start();
    
    $sql = "SELECT * FROM jogo_usuario WHERE cd_resultado = 1 ORDER BY tempo_celula ASC LIMIT 0,10;"
    
    $ranking[];
    $resultado = $conn->query($sql);

    if ($resultado){
        while($row = $resultado->fetch_assoc()){
            $sql = "SELECT j.x_tab, j.y_tab, j.cd_modo_jogo, u.username FROM jogo AS j INNER JOIN usuario AS u ON j.cd_jogo = ".$row["cd_jogo"]." AND u.username = '".$row["username"]."';" 
            
            $resultado2 = $conn->query($sql);
            if ($resultado2){
                while($row2 = $resultado2->fetch_assoc()){
                    $array_push($ranking, array(
                        'username' => $row2["username"],
                        'x_tab' => $row2["x_tab"],
                        'y_tab' => $row2["y_tab"],
                        'qtd_partida' => $row["qtd_partida"],
                        'cd_modo_jogo' => $row["cd_modo_jogo"]
                    ));
                } 
                echo json_encode($ranking);
            }
        }
    }
    else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
        
 ?>