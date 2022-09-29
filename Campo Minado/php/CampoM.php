<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=BancoCampoM", "root", "");
    $sql = "
    CREATE TABLE IF NOT EXISTS usuario (
        username VARCHAR(20) NOT NULL,
        PRIMARY KEY(username),
        senha VARCHAR(256) NOT NULL,
        nm_usuario VARCHAR(80) NOT NULL,
        cpf_usuario VARCHAR(11) NOT NULL,
        dt_nascimento DATE NOT NULL,
        tel VARCHAR(20) NULL,
        email VARCHAR(256) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS jogo(
        cd_jogo INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(cd_jogo),
        cd_modo_jogo INT NOT NULL, -- 1 classico, 2 rivotril
        x_tab INT NOT NULL,
        y_tab INT NOT NULL,
        qtd_bombas INT NOT NULL,
        qtd_tempo_max INT NULL
    );

    CREATE TABLE IF NOT EXISTS jogo_usuario(
        cd_jogo INT NOT NULL,
        FOREIGN KEY (cd_jogo) REFERENCES jogo(cd_jogo),
        username VARCHAR(20) NOT NULL,
        FOREIGN KEY (username) REFERENCES usuario(username),
        PRIMARY KEY(cd_jogo, username),
        qtd_partida INT NULL
    );";
    $conn->exec($sql);
}
catch(PDOException $e){
    echo "Ocorreu um erro: " . $e->getMessage();
}
?>
