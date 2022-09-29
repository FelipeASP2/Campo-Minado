let xhttp;


xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = mostraResposta;
xhttp.open('POST', '../php/ranking.php', true);
xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhttp.send();

function mostraResposta() {
    try {
        if (xhttp.readyState === XMLHttpRequest.DONE) {
            if (xhttp.status === 200) {
               let result = JSON.parse(xhttp.responseText);
                
                for(let i = 0; i < result.length; i++){
                    let div = `<div class="display-flex result">
                        <p class="first-col">${result[i].username}</p>
                        <p>${result[i].x_tab}x${result.y_tab}</p>
                        <p>${result[i].tempo}</p>
                        <p>${result[i].cd_modo_jogo}</p>
                        
                        
                    </div>`
                    
                    document.getElementsByClassName("historico")[i].innerHTML += div;
        }
            }} else {
    alert('Um problema ocorreu.');
        }
    }
    catch (e) {
        alert("Ocorreu uma exceção: " + e.description);
    }
}
    
    

