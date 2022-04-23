var liste = [1, 2, 3, 4, 5, 6, 7, 8, 9];

function random() {
  liste = liste.sort(() => Math.random() - 0.5)
  arrange(liste);
  document.getElementById("check").classList.remove('bi-square');
  document.getElementById("check").classList.add('bi-three-dots');
}

function arrange(arrange) {
  let i;

  for (i = 1; i < arrange.length+1; i++) {
    let e = document.getElementById('cap' + i + '-' + i).id = 'cap' + arrange[i-1] + '-' + i;
  }
  for (i = 1; i < arrange.length+1; i++) {
    let e = document.getElementById('cap' + arrange[i-1] + '-' + i).id;
    let remove = e.split("-");
    document.getElementById('cap' + arrange[i-1] + '-' + i).id = remove[0];
  }

  for (i = 1; i < arrange.length+1; i++) {
    document.getElementById('cap' + arrange[i-1]).src = 'captcha/debug/' + arrange[i-1] + '.jpg';
  }
}

var complete;
var selected;
var exchange = 0;

function captcha(select) {
  verif = select.split("-");
  if (!verif[1]) {
    if (complete !== 1) {
      selected = select.split("cap");
      if (exchange === 0) {
        exchange = selected[1];
        add = document.getElementById("cap"+exchange)
        add.style.border = "thin solid #000000";
      } else {
        exchangePlace();
      }
    }
  }
}

function exchangePlace() {

  document.getElementById('cap' + exchange).src = 'captcha/debug/' + selected[1] + '.jpg';
  document.getElementById('cap' + selected[1]).src = 'captcha/debug/' + exchange + '.jpg';

  let e1=document.getElementById('cap' + exchange);
  let e2=document.getElementById('cap' + selected[1]);

  e1.id = 'cap' + selected[1];
  e2.id = 'cap' + exchange;

  document.getElementById('cap' + exchange).style.border = "";
  document.getElementById('cap' + selected[1]).style.border = "";

  let temp;

  for (i = 0; i < liste.length; i++) {
    if(liste[i] == selected[1]){
      position1 = i;
    }
    if (liste[i] == exchange) {
      position2 = i;
    }
  }
  temp = liste[position1];
  liste[position1] = liste[position2];
  liste[position2] = temp;

  for (i = 0; i < liste.length; i++) {
    if (liste[i] === i+1) {
      complete = 1;
    } else {
      complete = 0;
      break;
    }
  }

  if (complete === 1) {
    element = document.getElementById('modalFooter');
    content = element.innerHTML;
    remove = content.split('--');
    element.innerHTML = remove[1];
    document.getElementById("check").classList.remove('bi-three-dots');
    document.getElementById("check").classList.add('bi-check-lg');
    document.getElementById("btnCheck").classList.remove('btn-secondary');
    document.getElementById("btnCheck").classList.add('btn-success');

    document.getElementById('checkCaptcha').id = "checkDone"
  }
  exchange = 0;
  selected[1] = 0;
}
