"use strict"

let xhttp = new XMLHttpRequest();
if (!xhttp) {
    alert('Não foi possível buscar seu histórico.');
}

xhttp.onreadystatechange = addHistorico;
xhttp.open('POST', '../php/historico.php', true);
xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhttp.send(null);

function addHistorico(){
    try {
        if (xhttp.readyState === XMLHttpRequest.DONE) {
            if (xhttp.status === 200) {
                let result = JSON.parse(xhttp.responseText);
                
                for(let i = 0; i < result.length; i++){
                    let div = `<div class="display-flex result">
                        <p class="first-col">${result[i].username}</p>
                        <p>${result[i].x_tab}x${result.y_tab}</p>
                        <p>${result[i].n_bombs}</p>
                        <p>${result[i].cd_modalidade}</p>
                        <p>${result[i].cd_resultado}</p>
                        <p>${result[i].tempo}</p>
                        <p>${result[i].data}</p>
                    </div>`
                    
                    document.getElementsByClassName("historico")[i].innerHTML += div;
                }
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
    