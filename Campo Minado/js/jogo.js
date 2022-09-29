"use strict"

var board;
var xTab;
var yTab;
var nBomb;
var gameMode;

var minesPosition = [];

var pontuacao = 0;
var openedCell = 0;

var time = 0;
var i = 1

function myTimer() {
  time += i

  if (time == 0) {
      gameOver()
  }

  document.getElementById("timedisplay").innerHTML = time;
}

function startGame() {
    var select = document.getElementById('modo-jogo');
    var value = select.options[select.selectedIndex].value;

    if (value == 0) {
        alert("Selecione um modo de jogo!")
        return;
    }
    
    gameMode = value;

    if(value == 2) {
        time = 120
        i = -1
    }

    xTab = parseInt(document.getElementById("xTab").value);
    if (xTab < 0) {
        alert("Informe a quantidade de colunas do tabuleiro!")
        return;
    }

    yTab = parseInt(document.getElementById("yTab").value);
    if (yTab < 0) {
        alert("Informe a quantidade de linhas do tabuleiro!")
        return;
    }

    nBomb = parseInt(document.getElementById("nBomb").value);
    if (nBomb < 0) {
        alert("Informe a quantidade de bombas do tabuleiro!")
        return;
    }

    board = new Array(yTab).fill(0).map(_ => new Array(xTab).fill(0));

    insertMines(nBomb);
    countBombs(minesPosition);

    createBoard();
    setInterval(myTimer, 1000);
    
    insertGame();
}

function createBoard() {
    document.getElementById("game").innerHTML += "";

    for (let i = 0; i < board.length; i++) {
        document.getElementById("game").innerHTML += `<div class=\"display-flex\" id=\"row${i}\"/>`;

        for (let j = 0; j < board[i].length; j++) {
            document.getElementById("game").getElementsByClassName("display-flex")[i].innerHTML += `<div class=\"cell\" onClick=\"cellClick(this.id)\" id=\"${i}-${j}\"/>`;
        }
    }
}

function cellClick(id) {
    var x = parseInt(id.split('-')[1]);
    var y = parseInt(id.split('-')[0]);

    if (!isValidPosition(x, y))
        return;

    if (board[y][x] == -1) {
        gameOver();
    }

    openCell(x, y);
}

function openCell(x, y) {
    var around = [[0, -1],
    [-1, 0], [1, 0],
    [0, 1]];

    if (isValidPosition(x, y)) {
        if (board[y][x] != -2) {
            pontuacao += 10
            openedCell += 1
            switch (board[y][x]) {
                case -1:
                    break;
                case 0:
                    document.getElementById(y + "-" + x).innerHTML = "0";
                    board[y][x] = -2;

                    for (let j = 0; j < around.length; j++) {
                        let x2 = x + around[j][0];
                        let y2 = y + around[j][1];

                        if (isValidPosition(x2, y2))
                            openCell(x2, y2);
                    }
                    break;
                default:
                    document.getElementById(y + "-" + x).innerHTML = board[y][x];
                    board[y][x] = -2;
            }
        }
    }

    setTimeout(() => {
        if(openedCell >= xTab * yTab - nBomb) {
            winGame()
            return
        }
    }, 200)
}

function gameOver() {
    finishGame(2);
    
    alert(`Voce perdeu! \nSua potuacao: ${pontuacao} \nTempo de jogo: ${time} \nCelulas abertas: ${openedCell}`);
    document.location.reload(true);
}

function winGame() {
    finishGame(1);
    
    alert(`Voce venceu! \nSua potuacao: ${pontuacao} \nTempo de jogo: ${time} \nCelulas abertas: ${openedCell}`);
    document.location.reload(true);
}

function isValidPosition(x, y) {
    return (x >= 0 && y >= 0 && x < board[0].length && y < board.length);
}


function insertMines(nBomb) {
    let i = 0;

    while (i < nBomb) {
        let y = parseInt(Math.round(Math.random() * board.length));
        let x = parseInt(Math.round(Math.random() * board[0].length));

        if (isValidPosition(x, y)) {
            if (board[y][x] == 0) {
                board[y][x] = -1;
                minesPosition.push([x, y]);
                i++;
            }
        }
    }
}

function countBombs(minesPosition) {
    var around = [[-1, -1], [0, -1], [1, -1],
    [-1, 0], [1, 0],
    [-1, 1], [0, 1], [1, 1]];

    for (let i = 0; i < minesPosition.length; i++) {
        for (let j = 0; j < around.length; j++) {
            let x = minesPosition[i][0] + around[j][0];
            let y = minesPosition[i][1] + around[j][1];

            if (isValidPosition(x, y))
                if (board[y][x] > -1)
                    board[y][x]++;
        }
    }
}

function activateGlitch() {
    setTimeout(() => {
        minesPosition.forEach(element => {
            document.getElementById(element[1]+"-"+element[0]).style.backgroundImage = "";
        });
    }, 1000)

    minesPosition.forEach(element => {
        document.getElementById(element[1]+"-"+element[0]).style.backgroundImage = 'url(img/logo.png)';
    });
}

function insertGame(){
    let xhttp = initXhttp('../php/iniciarPartida.php');
    if(xhttp == false)
        return false;
    
    let params = 'xTab=' + encodeURIComponent(xTab) + '&yTab=' + encodeURIComponent(yTab) + '&nBomb=' + encodeURIComponent(nBomb) + '&tpJogo=' + encodeURIComponent(gameMode);
    xhttp.send(params);
}

function finishGame(cd_result){
    let xhttp = initXhttp('../php/finalizaPartida.php');
    if(xhttp == false)
        return false;
    
    if(gameMode == 2)
       time = 120 - time;
       
    let params = `tempo_partida=${time}&cd_resultado=${cd_result}`; 
    xhttp.send(params);
}

function initXhttp(url){
    let xhttp = new XMLHttpRequest();
    if (!xhttp) {
        alert('Não foi possível criar um objeto XMLHttpRequest.');
        return false;
    }

    xhttp.open('POST', url, true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    return xhttp;
}




















