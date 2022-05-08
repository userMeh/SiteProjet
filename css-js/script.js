var state = "light"; // le state du button pas de la page
var launch = "instant";

window.addEventListener('load', (event) => {
  receive = localStorage.getItem("mode");
  if (receive == "light") {
    state = "light";
    var launch = "instant"
    switchMode();
    launch = "slow"
  }
});

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

    //Change les background
    let background = document.getElementsByClassName("bg-light");

    while (background.length > 0) {
      background.item(0).classList.add('bg-dark');
      background[0].classList.remove('bg-light');
    }
    let table = document.getElementsByClassName("table-light");

    while (table.length > 0) {
      table.item(0).classList.add('table-dark');
      table[0].classList.remove('table-light');
    }
    let text = document.getElementsByClassName("text-dark");

    while (text.length > 0) {
      text.item(0).classList.add('text-light');
      text[0].classList.remove('text-dark');
    }

    document.getElementById("searchbar").classList.remove("btn-outline-dark");
    document.getElementById("searchbar").classList.add("btn-outline-light");
    const elementSeeAll = document.getElementById("seeAll");
    if (elementSeeAll) {
      elementSeeAll.classList.add("btn-outline-light");
      elementSeeAll.classList.remove("btn-outline-dark");
    }

    //Transfert
    let mode = "dark"
    localStorage.setItem("mode", mode);

    state = "light";
//------------------------------------------------------------------------------
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

    //Change la couleur du background
    let background = document.getElementsByClassName("bg-dark");

    while (background.length > 0) {
      background.item(0).classList.add('bg-light');
      background[0].classList.remove('bg-dark');
    }
    let table = document.getElementsByClassName("table-dark");

    while (table.length > 0) {
      table.item(0).classList.add('table-light');
      table[0].classList.remove('table-dark');
    }
    let text = document.getElementsByClassName("text-light");

    while (text.length > 0) {
      text.item(0).classList.add('text-dark');
      text[0].classList.remove('text-light');
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
    const elementSeeAll = document.getElementById("seeAll");
    if (elementSeeAll) {
      elementSeeAll.classList.add("btn-outline-dark");
      elementSeeAll.classList.remove("btn-outline-light");
    }

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
  // removeEventListenerToAllStars()
  let note = e.target.dataset.value;
  let jeu = document.getElementById('nomJeu');

  window.open('verification_notation.php?note=' + note + '/' +jeu.innerHTML, "_self");
}

/* Useless sert a garder les etoiles quand tu clique mais vu que tu change de page ca sert a rien
function removeEventListenerToAllStars() {
  stars.forEach(star => {
    star.removeEventListener("click", saveRating);
    star.removeEventListener("mouseover", selected);
    star.removeEventListener("mouseleave", unselected);
  });
}
*/
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

//----------------------SEARCH BAR----------------------------------------------

function searchGame() {
  let url = 'suggestion.php';
  const searchInput = document.getElementById('search');

  url += '?search=' + searchInput.value;

  const request = new XMLHttpRequest();
  request.open('GET', url);
  request.onreadystatechange = function() {
    if (request.readyState === XMLHttpRequest.DONE) {
      const conteneur = document.getElementById('suggestion');
      conteneur.innerHTML = request.responseText;
    }
  };
  request.send();
}

//---------------------------LIKE DISLIKE---------------------------------------

function like() {
  const likeButton = document.getElementById('like');
  if (likeButton.classList == "bi bi-hand-thumbs-up-fill mx-3") {
    likeButton.classList = "bi bi-hand-thumbs-up mx-3";
    likeButton.style = "color:none; font-size:2rem; transition:0.5s";
    logsLikeDislike('retiré son like');
    numberLike = likeButton.innerHTML;
    likeButton.innerHTML = parseInt(numberLike)-1;

  } else {
    likeButton.classList = "bi bi-hand-thumbs-up-fill mx-3";
    likeButton.style = "color:blue; font-size:2rem; transition:0.5s";
    logsLikeDislike('like');
    numberLike = likeButton.innerHTML;
    likeButton.innerHTML = parseInt(numberLike)+1;

    const dislikeButton = document.getElementById('dislike');
    if (dislikeButton.classList == "bi bi-hand-thumbs-down-fill mx-3") {
      dislikeButton.classList = "bi bi-hand-thumbs-down mx-3";
      dislikeButton.style = "color:none; font-size:2rem; transition:0.5s";
      numberDislike = dislikeButton.innerHTML;
      dislikeButton.innerHTML = parseInt(numberDislike)-1;
    }
  }
}

function dislike() {
  const dislikeButton = document.getElementById('dislike');
  if (dislikeButton.classList == "bi bi-hand-thumbs-down-fill mx-3") {
    dislikeButton.classList = "bi bi-hand-thumbs-down mx-3";
    dislikeButton.style = "color:none; font-size:2rem; transition:0.5s";
    logsLikeDislike('retiré son dislike');
    numberDislike = dislikeButton.innerHTML;
    dislikeButton.innerHTML = parseInt(numberDislike)-1;

  } else {
    dislikeButton.classList = "bi bi-hand-thumbs-down-fill mx-3";
    dislikeButton.style = "color:red; font-size:2rem; transition:0.5s";
    logsLikeDislike('dislike');
    numberDislike = dislikeButton.innerHTML;
    dislikeButton.innerHTML = parseInt(numberDislike)+1;

    const likeButton = document.getElementById('like');

    if (likeButton.classList == "bi bi-hand-thumbs-up-fill mx-3") {
      likeButton.classList = "bi bi-hand-thumbs-up mx-3";
      likeButton.style = "color:none; font-size:2rem; transition:0.5s";
      numberLike = likeButton.innerHTML;
      likeButton.innerHTML = parseInt(numberLike)-1;
    }
  }
}

function verifLike() {
  const elementIdPoste = document.getElementById('idPoste');
  const idPoste = elementIdPoste.innerHTML;
  const elementIdCompte = document.getElementById('idCompte');
  const idCompte = elementIdCompte.innerHTML;

  const request = new XMLHttpRequest();
  request.open('GET', 'verification_like.php?id='+ idPoste +'&nature=recherche&compte=' + idCompte);
  request.onreadystatechange = function() {
    if (request.readyState===XMLHttpRequest.DONE) {
      if (parseInt(request.responseText) === 1) {
        const likeButton = document.getElementById('like');
        likeButton.classList = "bi bi-hand-thumbs-up-fill mx-3";
        likeButton.style = "color:blue; font-size:2rem; transition:0.5s";
      } else if (parseInt(request.responseText) === 2){
        const dislikeButton = document.getElementById('dislike');
        dislikeButton.classList = "bi bi-hand-thumbs-down-fill mx-3";
        dislikeButton.style = "color:red; font-size:2rem; transition:0.5s";
      }
    }
  };
  request.send();
}

function logsLikeDislike(nature) {
  const elementIdPoste = document.getElementById('idPoste');
  const idPoste = elementIdPoste.innerHTML;
  const elementIdCompte = document.getElementById('idCompte');
  const idCompte = elementIdCompte.innerHTML;

  const request = new XMLHttpRequest();
  request.open('GET', 'verification_like.php?id='+ idPoste +'&nature='+ nature +'&compte='+ idCompte);
  request.send();
}

//-----------------------------SEARCH POST--------------------------------------

function searchPost(info) {

  const compte = document.getElementById('compte').innerHTML;
  const searchInput = document.getElementById('searchPost');
  let url = 'search_post.php?session=' + compte;

  if (typeof info !== 'undefined') {
    url += '&search=' + info;
  } else if (searchInput.value.length > 1) {
    url += '&search=' + searchInput.value;
  }

  const request = new XMLHttpRequest();
  request.open('GET', url);
  console.log(url);
  request.onreadystatechange = function() {
    if (request.readyState===XMLHttpRequest.DONE) {
      const conteneur = document.getElementById('post');
      conteneur.innerHTML = request.responseText;
    }
  };
  request.send();
}

//----------------------------COMMENTAIRE---------------------------------------

// function commentaire() {
//   const commentaireInput = document.getElementById('commentaire');
//   const commentaire = commentaireInput.value;
//   const elementIdPoste = document.getElementById('idPoste');
//   const idPoste = elementIdPoste.innerHTML;
//   const elementIdCompte = document.getElementById('idCompte');
//   const idCompte = elementIdCompte.innerHTML;
//
//   const request = new XMLHttpRequest();
//   request.open('POST', 'verification_commentaire_poste.php');
//   request.onreadystatechange = function(){
//     const verification = (request.responseText)
//     if (verification === "oui") {
//
//     }
//   };
//   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   request.send(`contenu=${COMMENTAIRE.commentaire}& \
//                 id_poste=${COMMENTAIRE.idPoste}& \
//                 email=${COMMENTAIRE.idCompte}`);
//
//   const liste = document.getElementById('liste_commentaire');
//
// }
