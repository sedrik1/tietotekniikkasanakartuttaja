const contents = document.querySelectorAll("div[data='displayContent']");

document.addEventListener("click", (e) => {
    if(e.target.attributes[0].name === "data") {
        if(e.target.attributes[0].value === "contentButton") {
            if(e.target.childNodes[0].nodeValue === "Tallennetut sanat" || 
            e.target.childNodes[0].nodeValue === "Profiili ja tallennetut sanat") {
                contents[1].style.display = "block";
                contents[2].style.display = "none";
                contents[0].style.display = "none";
            } else if(e.target.childNodes[0].nodeValue === "Etusivu") {
                contents[1].style.display = "none";
                contents[2].style.display = "none";
                contents[0].style.display = "block";
            } else if(e.target.childNodes[0].nodeValue === "Sanavisa") {
                contents[1].style.display = "none";
                contents[2].style.display = "block";
                contents[0].style.display = "none";
            } else if(e.target.childNodes[0].nodeValue === "Satunnainen sana") {
                contents[1].style.display = "none";
                contents[2].style.display = "none";
                contents[0].style.display = "block";
            }
        }
    } else {
        return;
    }
});

document.getElementById("showContentText").addEventListener("click", () => {
    if(document.getElementById("a").style.display == "none") {
        document.getElementById("a").style.display = "block";
        document.getElementById("showContentText").textContent = "Sulje profiilitiedot ∧";
    } else if(document.getElementById("a").style.display == "block") {
        document.getElementById("a").style.display = "none";
        document.getElementById("showContentText").textContent = "Näytä profiilitiedot ∨";
    }
});

document.getElementById("topTitle").addEventListener("click", () => {
    contents[1].style.display = "none";
    contents[2].style.display = "none";
    contents[0].style.display = "block";
});

