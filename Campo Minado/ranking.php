<?php
    include("php/verificaSessao.php");
?>

<!DOCTYPE html>

<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Ranking</title>

        <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="css/base.css">
        <link rel="stylesheet" type="text/css" href="css/ranking.css">
        
        <script src="rankingJS.js"></script>
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
        
        <section>
             
             <h1>Raking</h1>
           <div class="corpo">
		
		<table>
                 <tr>
    <th>Username</th>
    <th>Tamanho</th>
    <th>Tempo</th>
    <th>Modo de jogo</th>
  </tr>
  
</table>
		
	</div>
             
        </section>
        
       
    </body>
</html>
