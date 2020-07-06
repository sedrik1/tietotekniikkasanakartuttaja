let printWord = function() {
    const xhr = new XMLHttpRequest();
    let username = document.getElementById("profileName").textContent;
    username = username.trim();
    let element = document.getElementById("getWord");
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
                let wordH4 = document.createElement("h4");
                let defP = document.createElement("p");
                let idSpan = document.createElement("span");

                let word = document.createTextNode(data.word + " | " + data.date);
                let def = document.createTextNode(data.def);
                let id = document.createTextNode(data.id);
                let wordInner = document.createTextNode(data.word);
                let star = document.createTextNode("★");

                (defP).setAttribute("class", "contentText");
                defP.appendChild(def);
                element.prepend(defP);

                (wordH4).setAttribute("class", "wordTitle");
                wordH4.appendChild(word);
                element.prepend(wordH4);

                idSpan.appendChild(star);
                (idSpan).setAttribute("id", id.textContent);
                (idSpan).setAttribute("name", wordInner.textContent);
                (idSpan).setAttribute("class", "addFavourite");
                (idSpan).setAttribute("data", "fav");
                (idSpan).setAttribute("type", "submit");
                if(data.msg === "Poista") {
                    (idSpan).setAttribute("title", "Poista sana suosikeistasi");
                    idSpan.style.color = "black"; 
                } else if(data.msg === "Lisää"){
                    (idSpan).setAttribute("title", "Lisää sana suosikkeihisi");
                    idSpan.style.color = "gold"; 
                }
                (idSpan).setAttribute("onclick", "add(this)");
                element.prepend(idSpan);
        }
    };
    xhr.open("GET", "inc/GetWord.class.php?user="+username, true);
    xhr.send();
};

let intervalID = null;

function intervalManager(flag, printWord, time) {
   if(flag)
     intervalID = setInterval(printWord, time);
   else
     clearInterval(intervalID);
}

function setPrintWord(e) {
    if(intervalID !== null) {
        intervalManager(false);
    }
    intervalManager(true, printWord, e.options[e.selectedIndex].value);
}

function onloadPrintWord(e) {
    if(intervalID !== null) {
        intervalManager(false);
    }
    intervalManager(true, printWord, e);
}

window.addEventListener("load", () => {
    onloadPrintWord(60000);
});