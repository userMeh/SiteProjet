var state = "light"; // le state du button pas de la page

let receive = localStorage.getItem("mode");
if (receive == "light") {
  state = "light";
  var launch = "instant"
  switchMode();
  launch = "slow"
}

function switchMode() {
  let element = document.body;

  if (state === "dark") {

    element.className = "dark-mode";

    //Change la couleur des containers
    document.getElementById("lightDark").classList.remove('btn-dark');
    document.getElementById("lightDark").classList.add("btn-light");
    if (launch != "instant") {
      document.getElementById("lightDark").style.transition = "0.5s";
    } else {
      document.getElementById("lightDark").style.transition = "none";
    }


    //Change l'icone
    document.getElementById("lightDark-icon").classList.remove('bi-moon');
    document.getElementById("lightDark-icon").classList.remove('dark');
    document.getElementById("lightDark-icon").classList.add('bi-sun');
    document.getElementById("lightDark-icon").classList.add('light');

    //Change la navbar
    document.getElementById("navbar").classList.remove("navbar-light");
    document.getElementById("navbar").classList.remove("bg-light");
    document.getElementById("navbar").classList.add("navbar-dark");
    document.getElementById("navbar").classList.add("bg-dark");
    if (launch != "instant") {
      document.getElementById("navbar").style.transition = "0.5s";
    } else {
      document.getElementById("navbar").style.transition = "none";
    }

    //Change les boutons
    let button = document.getElementsByClassName("btn-outline-light");

    while (button.length > 0) {
      button.item(0).classList.add('btn-outline-dark');
      button[0].classList.remove('btn-outline-light');
    }
    document.getElementById("searchbar").classList.remove("btn-outline-dark");
    document.getElementById("searchbar").classList.add("btn-outline-light");

    //Transfert
    let mode = "dark"
    localStorage.setItem("mode", mode);

    state = "light";
  } else {

    element.className = "light-mode";

    //Change la couleur des containers
    document.getElementById("lightDark").classList.remove('btn-light');
    document.getElementById("lightDark").classList.add("btn-dark");
    if (launch != "instant") {
      document.getElementById("lightDark").style.transition = "0.5s";
    } else {
      document.getElementById("lightDark").style.transition = "none";
    }

    //Change l'icone
    document.getElementById("lightDark-icon").classList.remove('bi-sun');
    document.getElementById("lightDark-icon").classList.remove('light');
    document.getElementById("lightDark-icon").classList.add('bi-moon');
    document.getElementById("lightDark-icon").classList.add('dark');

    //Change la navbar
    document.getElementById("navbar").classList.remove("navbar-dark");
    document.getElementById("navbar").classList.remove("bg-dark");
    document.getElementById("navbar").classList.add("navbar-light");
    document.getElementById("navbar").classList.add("bg-light");
    if (launch != "instant") {
      document.getElementById("navbar").style.transition = "0.5s";
    } else {
      document.getElementById("navbar").style.transition = "none";
    }


    //Change les boutons
    let button = document.getElementsByClassName("btn-outline-dark");

    while (button.length > 0) {
      button.item(0).classList.add('btn-outline-light');
      button[0].classList.remove('btn-outline-dark');
    }
    document.getElementById("searchbar").classList.remove("btn-outline-light");
    document.getElementById("searchbar").classList.add("btn-outline-dark");

    //Transfer
    let mode = "light"
    localStorage.setItem("mode", mode);

    state = "dark"
  }
}
