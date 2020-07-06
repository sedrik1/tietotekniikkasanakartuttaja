function changeEmail() {
    const xhr = new XMLHttpRequest();
    let username = document.getElementById("profileName").textContent.trim();
    let email = document.getElementById("changeEmail").value;

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            document.getElementById("emailFeedback").style.display = "block";
            document.getElementById("emailFeedback").innerHTML = data.feedback;
            document.getElementById("profileEmail").innerHTML = data.newEmail;
            if(data.feedback === "Sähköposti vaihdettu") {
                document.getElementById("changeEmail").value = "";
            }

        }
    };
    xhr.open("POST", "inc/NewEmail.class.php?user="+username+"&email="+email, true);
    xhr.send();
    setTimeout(() => {
        document.getElementById("emailFeedback").innerHTML = "";
        document.getElementById("emailFeedback").style.display = "none";
    }, 3000);
}