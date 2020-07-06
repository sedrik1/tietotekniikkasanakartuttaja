 function checkUsername() {    
    let user = document.getElementById("user").value;
    if(user.trim() === "") {
        document.getElementById("user").style.borderColor = "transparent";
        document.getElementById("user").style.boxShadow = "";
        return false;
    } else {
        document.getElementById("user").style.boxShadow = "0 0 0 2px #009115";
        document.getElementById("user").style.borderRadius = "1px";
        return true;
    }
}
document.getElementById("user").addEventListener("change", () => {
    checkUsername();
});

function checkEmail() {
    let email = document.getElementById("email").value;
    if(email.trim() === "") {
        document.getElementById("email").style.borderColor = "transparent";
        document.getElementById("email").style.boxShadow = "";
        return false;
    } else {
        document.getElementById("email").style.boxShadow = "0 0 0 2px #009115";
        document.getElementById("email").style.borderRadius = "1px";
        return true;
    }
}
document.getElementById("email").addEventListener("change", () => {
    checkEmail();
});

document.getElementById("submitSignUpForm").addEventListener("click", () => {
    const xhr = new XMLHttpRequest();
    let username = document.getElementById("user").value;
    let email = document.getElementById("email").value;
    let pwd = document.getElementById("pwd").value;

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            document.getElementById("signupMsg").innerHTML = data.feedback;
            if(data.feedback === "Tilin luonti onnistui. Sinut ohjataan etusivulle") {
                setTimeout(() => {
                    location.href = "SendConfirmation.class.php?user="+data.user+"&email="+data.email;
                }, 2000);
            }
            document.getElementById("signupMsg").style.display = "block";
            document.getElementById("signupMsg").innerHTML = data.feedback;

            setTimeout(() => {
                document.getElementById("signupMsg").innerHTML = "";
            }, 2000);
        }
    };
    xhr.open("POST", "checkInfo.class.php?user="+username+"&email="+email+"&pwd="+pwd, true);
    xhr.send();
});