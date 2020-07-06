
  function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

window.addEventListener("load", () => {
  let teema = getCookie("teema");
  if (teema === "Vaalea") {
    document.getElementById("feedback").classList.add("feedback");
    document.getElementById("feedback").classList.remove("feedback-dark");
    document.getElementById("content").classList.remove("dark-mode-content");
    document.getElementById("profile").classList.remove("dark-mode-content");
    document.getElementById("quiz").classList.remove("dark-mode-content");
    document.getElementById("closeRand").classList.remove("closeRand-dark");
    document.getElementById("closeModal").classList.remove("closeRand-dark");
    document.getElementById("randWord").classList.remove("randWord-dark");
    document.getElementById("content").classList.add("content");
    document.getElementById("profile").classList.add("content");
    document.getElementById("quiz").classList.add("content");
    document.getElementById("closeRand").classList.add("closeRand");
    document.getElementById("closeModal").classList.add("closeRand");
    document.getElementById("randWord").classList.add("randWord");
    document.getElementById("topB").classList.remove("dark-mode-button");
    document.getElementById("topB").classList.add("topB");
    document.getElementById("mode").innerHTML = "Tumma tila";
    document.getElementById("pseudoModal").classList.add("content");
    document.getElementById("pseudoModal").classList.remove("dark-mode-content");
    document.body.classList.remove("dark-mode-body");
  } else if(teema === "Tumma") {
    document.getElementById("feedback").classList.add("feedback-dark");
    document.getElementById("feedback").classList.remove("feedback");
    document.getElementById("content").classList.remove("content");
    document.getElementById("profile").classList.remove("content");
    document.getElementById("quiz").classList.remove("content");
    document.getElementById("closeRand").classList.remove("closeRand");
    document.getElementById("closeModal").classList.remove("closeRand");
    document.getElementById("randWord").classList.remove("randWord");
    document.getElementById("content").classList.add("dark-mode-content");
    document.getElementById("quiz").classList.add("dark-mode-content");
    document.getElementById("profile").classList.add("dark-mode-content");
    document.getElementById("closeRand").classList.add("closeRand-dark");
    document.getElementById("closeModal").classList.add("closeRand-dark");
    document.getElementById("randWord").classList.add("randWord-dark");
    document.getElementById("topB").classList.remove("topB");
    document.getElementById("topB").classList.add("dark-mode-button");
    document.getElementById("pseudoModal").classList.remove("content");
    document.getElementById("pseudoModal").classList.add("dark-mode-content");
    document.getElementById("mode").innerHTML = "Vaalea tila";
    
    document.body.classList.add("dark-mode-body");
  } else {
      teema = "Vaalea";
      if (teema != "" && teema != null) {
        setCookie("teema", teema, 30);
      }
  }
});

function Mode() {
    let flick = document.getElementById("mode");
    let content = document.getElementById("content");
    let contentQuiz = document.getElementById("quiz");
    let contentProfile = document.getElementById("profile");
    let topB = document.getElementById("topB");
    let closeRand = document.getElementById("closeRand");
    let randWord = document.getElementById("randWord");
    document.body.classList.toggle("dark-mode-body");

    if(document.body.classList.contains("dark-mode-body") == true) {
      document.getElementById("feedback").classList.add("feedback-dark");
      document.getElementById("feedback").classList.remove("feedback");
      content.classList.remove("content");
      contentProfile.classList.remove("content");
      contentQuiz.classList.remove("content");
      closeRand.classList.remove("closeRand");
      randWord.classList.remove("randWord");
      content.classList.add("dark-mode-content");
      contentQuiz.classList.add("dark-mode-content");
      contentProfile.classList.add("dark-mode-content");
      closeRand.classList.add("closeRand-dark");
      randWord.classList.add("randWord-dark");
      topB.classList.remove("topB");
      topB.classList.add("dark-mode-button");
      document.getElementById("pseudoModal").classList.remove("content");
      document.getElementById("pseudoModal").classList.add("dark-mode-content");
      document.getElementById("closeModal").classList.add("closeRand-dark");
      document.getElementById("closeModal").classList.remove("closeRand");
      flick.innerHTML = "Vaalea tila";
      setCookie("teema", "Tumma", 30);
    } else if (document.body.classList.contains("dark-mode-body") == false) {
      document.getElementById("feedback").classList.remove("feedback-dark");
      document.getElementById("feedback").classList.add("feedback");
      document.getElementById("closeModal").classList.remove("closeRand-dark");
      document.getElementById("closeModal").classList.add("closeRand");
      document.getElementById("pseudoModal").classList.add("content");
      document.getElementById("pseudoModal").classList.remove("dark-mode-content");
      content.classList.remove("dark-mode-content");
      contentProfile.classList.remove("dark-mode-content");
      contentQuiz.classList.remove("dark-mode-content");
      closeRand.classList.remove("closeRand-dark");
      randWord.classList.remove("randWord-dark");
      content.classList.add("content");
      contentProfile.classList.add("content");
      contentQuiz.classList.add("content");
      closeRand.classList.add("closeRand");
      randWord.classList.add("randWord");
      topB.classList.remove("dark-mode-button");
      topB.classList.add("topB");
      flick.innerHTML = "Tumma tila";
      setCookie("teema", "Vaalea", 30);
    }
}

document.getElementById("closeModal").addEventListener("click", () => {
  document.getElementById("pseudoModal").style.display = "none";
});

let topB = document.getElementById("topB");
window.onscroll = () => { scrollFunction(); };

const scrollFunction = () => {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    topB.style.display = "block";
  } else {
    topB.style.display = "none";
  }
};

const topFunction = () => {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};

const redirectToLogin = () => {
  location.href = "inc/signupForm.inc.php";
};