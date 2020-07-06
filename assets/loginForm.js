document.getElementById("loginButton").addEventListener("click", function show() {
    let x = document.getElementById("loginFormContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
});

function out() {
    location.href = "http://localhost/sop/inc/logout.inc.php";
}

document.getElementById("loginUser").addEventListener("change", () => {
    let user = document.getElementById("loginUser").value;
    if(user.trim() === "") {
        return false;
    } else {
        return true;
    }
});

document.getElementById("loginPwd").addEventListener("change", () => {
    let pwd = document.getElementById("loginPwd").value;
    if(pwd.trim() === "") {
        return false;
    } else {
        return true;
    }
});