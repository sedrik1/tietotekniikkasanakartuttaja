document.getElementById("sana").addEventListener("keyup", () => {
    const xhr = new XMLHttpRequest();
    let sana = document.getElementById("sana").value;
    let modal = document.getElementById("pseudoModal");
    let username = document.getElementById("profileName").textContent;
    username = username.trim();

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(sana.trim().length === 0) {
                modal.style.display = "none";
            } else {
                modal.style.display = "block";
            }
            document.getElementById("innerModal").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "inc/SearchWord.class.php?q="+sana+"&user="+username, true);
    xhr.send();
});