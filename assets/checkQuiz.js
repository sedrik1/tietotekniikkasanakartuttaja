function checkChoice(e) {
    const xhr = new XMLHttpRequest();
    let wordID = e.attributes[0].value;
    let defID = document.getElementById("wordDefinition").attributes[1].value;
    wordID = wordID.toString();
    document.getElementById("newWords").style.display = "block";

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText === "Väärin") {
                document.getElementById("result").style.display = "block";
                document.getElementById("result").style.color = "red";
                document.getElementById("result").innerHTML = this.responseText + " &#x2718;";
            } else {
                document.getElementById("result").style.display = "block";
                document.getElementById("result").style.color = "green";
                document.getElementById("result").innerHTML = this.responseText + " &#x2714;";
            }
        }
    };
    xhr.open("GET", "inc/CheckQuiz.class.php?word="+wordID+"&defID="+defID, true);
    xhr.send();
}