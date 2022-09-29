<?php
    include("php/verificaSessao.php");
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <title>Perfil</title>

    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/perfil.css">

    <script type="text/javascript">

        xhttp = new XMLHttpRequest();

        if (!xhttp) {
            alert("Nao foi possivel carregar o historico")
        }

        xhttp.onreadystatechange = loadScreen
        xhttp.open('POST', 'php/perfil.php', true)
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        xhttp.send()

        function loadScreen() {
            try {
            if (xhttp.readyState === XMLHttpRequest.DONE) {
                if (xhttp.status === 200) {
                    console.log(xhttp.responseText)
                    let resposta = JSON.parse(xhttp.responseText);

                    document.getElementById('content').innerHTML += `
                        <input id="username" type="text" value="${resposta.username}">
                    `

                    document.getElementById('content').innerHTML += `
                        <input id="nome" type="text" value="${resposta.nm_usuario}">
                        <div class="edit-icons">
                            <button id="btnSalveNome" type="button">
                                <i class='fas fa-check-circle'></i>
                            </button>
                        </div>
                    `

                    document.getElementById('content').innerHTML += `
                        <input id="nascimento" type="date" value="${resposta.dt_nascimento}">
                    `

                    document.getElementById('content').innerHTML += `
                        <input id="tel" type="number" value="${resposta.tel}">
                        <div class="edit-icons">
                            <button id="btnSalveDataTel" type="button">
                                <i class='fas fa-check-circle'></i>
                            </button>
                        </div>
                    `

                    document.getElementById('content').innerHTML += `
                        <input id="cpf" type="number" value="${resposta.cpf_usuario}">
                    `

                    document.getElementById('content').innerHTML += `
                        <input id="email" type="email" value="${resposta.email}">
                        <div class="edit-icons">
                            <button id="btnSalveEmail" type="button">
                                <i class='fas fa-check-circle'></i>
                            </button>
                        </div>
                    `

                    document.getElementById('content').innerHTML += `
                        <input id="senha" type="password" value="${resposta.senha}">
                        <div class="edit-icons">
                            <button id="btnSalveSenha" type="button">
                                <i class='fas fa-check-circle'></i>
                            </button>
                        </div>
                    `
                }
                else {
                    alert('Um problema ocorreu.');
                }
            }
        }
        catch (e) {
            alert("Ocorreu uma exceção: " + e.description);
        }
        }

    </script>
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

    <fieldset class="center-hv box-perfil" id="content">
        <legend class="justify-text">
            <i class="fas fa-bomb"></i>
            Perfil:
        </legend>
        <p class="justify-text" style="margin: 1% 5%;">Selecione abaixo as informações que deseja editar <br> Atenção, o
            seu username, data de nascimento e CPF não podem ser alterados.</p>

        </div>
    </fieldset>

    <footer>
        <p class="center-text">Para a realização desta página foi utilizado os ícones disponíveis no arquivo externo:
            <br>
            <a href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" target="_blank">
                https://use.fontawesome.com/releases/v5.8.2/css/all.css</a>
        </p>
    </footer>
</body>

</html>