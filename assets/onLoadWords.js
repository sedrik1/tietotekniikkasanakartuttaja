window.addEventListener("load", () => {
    const xhr = new XMLHttpRequest();
    let username = document.getElementById("profileName").textContent;
    username = username.trim();
    let element = document.getElementById("favourites");
    let counter = 0;

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            
            while(counter <= data.array.length) {
                let wordH4 = document.createElement("h4");
                let defP = document.createElement("p");
                let idSpan = document.createElement("span");

                let word = document.createTextNode(data.array[counter][0].word);
                let def = document.createTextNode(data.array[counter][0].def);
                let id = document.createTextNode(data.array[counter][0].id);
                let star = document.createTextNode("★");

                wordH4.appendChild(word);
                defP.appendChild(def);
                idSpan.appendChild(star);

                element.appendChild(idSpan).setAttribute("id", id.textContent);
                element.appendChild(idSpan).setAttribute("name", word.textContent);
                element.appendChild(idSpan).setAttribute("class", "addFavourite");
                element.appendChild(idSpan).setAttribute("data", "fav");
                element.appendChild(idSpan).setAttribute("type", "submit");
                element.appendChild(idSpan).setAttribute("title", "Poista sana suosikeistasi");
                element.appendChild(idSpan).setAttribute("onclick", "add(this)");
                idSpan.style.color = "black"; 

                element.appendChild(wordH4).setAttribute("class", "wordTitle");
                element.appendChild(defP).setAttribute("class", "contentText");
                counter++;
            }
        }
    };
    xhr.open("POST", "inc/OnLoadWords.class.php?user="+username, true);
    xhr.send();
});
