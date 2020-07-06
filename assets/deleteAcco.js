function deleteAcco() {
    if(confirm("Haluatko varmasti poistaa tilisi?") === false) {
      return false;
    } else {
        const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                if(this.responseText === "Poistettu") {
                    location.href = "inc/logout.inc.php";
                } else {
                    return false;
                }
            }
        };
        xhr.open("POST", "inc/DeleteAccount.class.php", true);
        xhr.send();
    } 
}
