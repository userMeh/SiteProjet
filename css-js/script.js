var state = "light"; // le state du button pas de la page

receive = localStorage.getItem("mode");
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

    //Transfert
    let mode = "light"
    localStorage.setItem("mode", mode);

    state = "dark"
  }
}

//-----------------------NOTE---------------------------------------------------

stars = document.querySelectorAll(".bi-star-fill");

init();

function init() {
  stars.forEach(stars => {
    stars.addEventListener("click", saveRating);
    stars.addEventListener("mouseover", selected);
    stars.addEventListener("mouseleave", unselected);
  });
}

function saveRating(e) {
  removeEventListenerToAllStars();
  console.log(e.target.dataset.value);
}
function removeEventListenerToAllStars() {
  stars.forEach(star => {
    star.removeEventListener("click", saveRating);
    star.removeEventListener("mouseover", selected);
    star.removeEventListener("mouseleave", unselected);
  });

}
function selected(e, css = "hover-star") {
  const hoveredStar = e.target;
  hoveredStar.classList.add(css);
  const previousSiblings = getPreviousSiblings(hoveredStar);
  previousSiblings.forEach((elem) => elem.classList.add(css));
}
function unselected(e, css = "hover-star") {
  const hoveredStar = e.target;
  hoveredStar.classList.remove(css);
  const previousSiblings = getPreviousSiblings(hoveredStar);
  previousSiblings.forEach((elem) => elem.classList.remove(css));
}
function getPreviousSiblings(elem) {
  let siblings = [];
  const spanNodeType = 1;
  while (elem = elem.previousSibling) {
    if (elem.nodeType === spanNodeType) {
      siblings = [elem, ...siblings];
    }
  }
  return siblings;
}
