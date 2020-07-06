function add(e) {
    let laskenta = 0;
    const xhr = new XMLHttpRequest();
    let wordID = e.attributes[0].value;
    wordID = parseInt(wordID);
    let username = document.getElementById("profileName").textContent;
    username = username.trim();
    let element = document.getElementById("favourites");
    let counter = 0;

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            if(data.feedback === "Luo tili tallentaaksesi sanoja") {
                document.getElementById("feedbackVisitor").innerHTML = data.feedback;
                document.getElementById("feedbackVisitor").style.display = "block";
                setTimeout(() => {
                    document.getElementById("feedbackVisitor").innerHTML = "";
                    document.getElementById("feedbackVisitor").style.display = "none";
                }, 5000);
            } else {
                if(data.feedback === "Sana poistettu") {
                    document.getElementById("feedback").style.color = "red";
                    document.getElementById("feedback").innerHTML = data.feedback;
                } else {
                    document.getElementById("feedback").style.color = "green";
                    document.getElementById("feedback").innerHTML = data.feedback;
                }
    
                if(laskenta === 1) {
                    while (element.lastElementChild) {
                        element.removeChild(element.lastElementChild);
                    }
                }
                
                while(counter <= data.array.length) {
                    let wordH4 = document.createElement("h4");
                    let defP = document.createElement("p");
                    let idSpan = document.createElement("span");
    
                    let word = document.createTextNode(data.array[counter][0].word);
                    let def = document.createTextNode(data.array[counter][0].def);
                    let id = document.createTextNode(data.array[counter][0].id);
                    let wordInner = document.createTextNode(data.word);
                    let star = document.createTextNode("★");
        
                    wordH4.appendChild(word);
                    defP.appendChild(def);
                    idSpan.appendChild(star);
    
                    element.appendChild(idSpan).setAttribute("id", id.textContent);
                    element.appendChild(idSpan).setAttribute("name", wordInner.textContent);
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
        }
    };
    xhr.open("POST", "inc/Fav.class.php?wordID="+wordID+"&user="+username, true);
    xhr.send();
    setTimeout(() => {
        document.getElementById("feedback").innerHTML = ""; 
    }, 3000);
    laskenta++;

    let aa = document.querySelectorAll("span[class='addFavourite']");
    for(let i = 0; i <= aa.length; i++) {
        if(aa[i].attributes[0].value === wordID.toString()) {
            if(aa[i].attributes[5].value === "Lisää sana suosikkeihisi") {
                aa[i].setAttribute("title", "Poista sana suosikeistasi");
                aa[i].style.color = "black";
            } else {
                aa[i].setAttribute("title", "Lisää sana suosikkeihisi");
                aa[i].style.color = "gold"; 
            }
        }
    }
}