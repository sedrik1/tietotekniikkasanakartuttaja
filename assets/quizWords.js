function quizWords() {
    let laskenta = 0;
    const xhr = new XMLHttpRequest();
    let element = document.getElementById("quizContent");
    let counter = 0;
    document.getElementById("newWords").style.display = "none";
    document.getElementById("result").style.display = "none";

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            let randNum = Math.floor(Math.random() * 4);
            document.getElementById("wordDefinition").innerHTML = data[randNum].def;
            document.getElementById("wordDefinition").setAttribute("data", data[randNum].id);

            if(laskenta === 1) {
                while (element.lastElementChild) {
                    element.removeChild(element.lastElementChild);
                }
            }

            while(counter < 4) {
                let wordB = document.createElement("button");
                let word = document.createTextNode(data[counter].word);
                let id = document.createTextNode(data[counter].id);

                wordB.appendChild(word);
                wordB.setAttribute("id", id.textContent);
                wordB.setAttribute("class", "profileButtons");
                wordB.setAttribute("onclick", "checkChoice(this)");
                element.appendChild(wordB);
                counter++;
            }
        }
    };
    xhr.open("GET", "inc/QuizWords.class.php", true);
    xhr.send();
    laskenta++;
}