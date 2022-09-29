<?php
    include("php/verificaSessao.php");
    include("conectarBanco.php");

     if ($conn->connect_error) {
        die("Falha de conexÃ£o: " . $conn->connect_error);
    } 
    
    session_start();
    
    $sql = "SELECT * FROM jogo WHERE cd_jogo IN (SELECT cd_jogo FROM jogo_usuario WHERE username='".$_SESSION["username"]."')";
    $resultado = $conn->query($sql);
    
    if($resultado){
        $historico[];
        while($row = $resultado->fetch_assoc()){
            $sql = "SELECT * FROM jogo_usuario WHERE username='".$_SESSION["username"]."' AND cd_jogo = ".$row["cd_jogo"].")";
            $resultado2 = $conn->query($sql);
            
            if($resultado2){
                $row2 = $resultado2->fetch_assoc();
                
                $array_push($historico, array(
                    'username' => $_SESSION["username"],
                    'x_tab' => $row["x_tab"],
                    'y_tab' => $row["y_tab"],
                    'n_bombs' => $row["qtd_bombas"],
                    'cd_modalidade' => $row["cd_modo_jogo"],
                    'cd_resultado' => $row2["cd_resultado"],
                    'tempo' => $row2["qtd_partida"],
                    'data' => $row["dt_partida"]
                ));
            }
        echo json_encode($historico);
        }
    }
    else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    
?>