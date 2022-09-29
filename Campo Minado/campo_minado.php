<?php
    include("php/verificaSessao.php");
?>

<html lang="pt"><head>
    <meta charset="utf-8">
	<title>Campo minado</title>
    
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/jogo.css">
    <script src="js/jogo.js"></script>
    <script src="js/historico.js"></script>
</head>

    
<body>
    <header>
        <nav>
            <a href="campo_minado.php">
                <img class="logo" src="img/logo2.png" alt="imagem de uma bomba">
            </a>
            <ul>
                <li class="op-menu">
                    <a class="link-menu lbl-link" href="ranking.html">Ranking</a>
                </li>
                <li class="op-menu">
                    <a class="link-menu lbl-link" href="perfil.html">Perfil</a>
                </li>
                <li class="op-menu exit">
                    <a class="link-menu" href="php/logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    
    <div class="first-item config-game">
        <div class="submenu display-flex">
            <select name="modo-jogo" id="modo-jogo">
                <option value="0">Modo de jogo</option>
                <option value="1">Clássico</option>
                <option value="2">Rivotril</option>
            </select>

            <p>Dimensões do tabuleiro:</p>
            <input id="xTab" type="number" value="">
            <p id="dmTab">x</p>
            <input id="yTab" type="number" value="">

            <p>Número de bombas: </p>
            <input id="nBomb" type="number" value="">

            <input id="btnIniciar" type="submit" value="Iniciar" onclick="startGame()">
        </div>
    </div>
    
    <section class="game">
        <div id="game">
            <!--<h1>Aguardando...</h1>-->
        </div>
        <div class="display-flex">
            <button id="btnTrapaca" type="button" onclick="activateGlitch()">Trapaça</button>
            <div class="temp">
                <span id="timedisplay">--:--</span>
                <i class="far fa-clock"></i>
            </div>
        </div>
    </section>
    
    <section class="historico">
        <h1>Histórico de partidas:</h1>
        
    </section>
    
    <footer>
        <p class="center-text">Para a realização desta página foi utilizado os ícones disponíveis no arquivo externo: <br>
            <a href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" target="_blank"> https://use.fontawesome.com/releases/v5.8.2/css/all.css</a>
        </p>
    </footer>

</body></html>