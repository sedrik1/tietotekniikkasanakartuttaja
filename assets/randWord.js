document.getElementById("randWordButton").addEventListener("click", () => {
    const xhr = new XMLHttpRequest();
    let username = document.getElementById("profileName").textContent;
    username = username.trim();
    let element = document.getElementById("randWordInner");

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            document.getElementById("randWord").style.display = "block";

            let wordH4 = document.createElement("h4");
            let defP = document.createElement("p");
            let idSpan = document.createElement("span");

            let word = document.createTextNode(data.word + " | " + data.date);
            let def = document.createTextNode(data.def);
            let wordInner = document.createTextNode(data.word);
            let id = document.createTextNode(data.id);
            let star = document.createTextNode("★");

            wordH4.appendChild(word);
            defP.appendChild(def);
            idSpan.appendChild(star);

            element.appendChild(idSpan).setAttribute("id", id.textContent);
            element.appendChild(idSpan).setAttribute("name", wordInner.textContent);
            element.appendChild(idSpan).setAttribute("class", "addFavourite");
            element.appendChild(idSpan).setAttribute("data", "fav");
            element.appendChild(idSpan).setAttribute("type", "submit");

            if(data.msg === "Poista") {
                element.appendChild(idSpan).setAttribute("title", "Poista sana suosikeistasi");
                idSpan.style.color = "black"; 
            } else if(data.msg === "Lisää") {
                element.appendChild(idSpan).setAttribute("title", "Lisää sana suosikkeihisi");
                idSpan.style.color = "gold"; 
            }

            element.appendChild(idSpan).setAttribute("onclick", "add(this)");

            element.appendChild(wordH4).setAttribute("class", "wordTitle");
            element.replaceChild(idSpan, element.childNodes[0]);
            element.replaceChild(wordH4, element.childNodes[1]);
            element.replaceChild(defP, element.childNodes[2]);
        }
    };
    xhr.open("GET", "inc/GetWord.class.php?user="+username, true);
    xhr.send();
});

document.getElementById("closeRand").addEventListener("click", () => {
    document.getElementById("randWord").style.display = "none";
});