window.addEventListener("load", () => {
    const xhr = new XMLHttpRequest();
    let element = document.getElementById("getWord");
    let counter = 0;

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            
            while(counter <= data.length) {
                let wordH4 = document.createElement("h4");
                let defP = document.createElement("p");
                let idSpan = document.createElement("span");

                let word = document.createTextNode(data[counter].word);
                let def = document.createTextNode(data[counter].def);
                let date = document.createTextNode(data[counter].date);
                let id = document.createTextNode(data[counter].id);
                let wordOuter = document.createTextNode(data[counter].word + " | " + data[counter].date);

                let star = document.createTextNode("★");

                wordH4.appendChild(wordOuter);
                defP.appendChild(def);
                idSpan.appendChild(star);

                element.appendChild(idSpan).setAttribute("id", id.textContent);
                element.appendChild(idSpan).setAttribute("name", word.textContent);
                element.appendChild(idSpan).setAttribute("class", "addFavourite");
                element.appendChild(idSpan).setAttribute("data", "fav");
                element.appendChild(idSpan).setAttribute("type", "submit");
                if(data[counter].msg === "Poista") {
                    (idSpan).setAttribute("title", "Poista sana suosikeistasi");
                    idSpan.style.color = "black"; 
                } else if(data[counter].msg === "Lisää"){
                    (idSpan).setAttribute("title", "Lisää sana suosikkeihisi");
                    idSpan.style.color = "gold"; 
                }element.appendChild(idSpan).setAttribute("onclick", "add(this)");

                element.appendChild(wordH4).setAttribute("class", "wordTitle");
                element.appendChild(defP).setAttribute("class", "contentText");
                counter++;
            }
        }
    };
    xhr.open("GET", "inc/GetUserFeed.class.php", true);
    xhr.send();
});
