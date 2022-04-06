<?php
if ($liste == 1) {
  $jour = strftime("%d", strtotime($date[$i]));
  $mois = strftime("%m", strtotime($date[$i]));
  $annee = strftime("%G", strtotime($date[$i]));

  switch ($mois) {
    case '01':
    $mois = 'Janvier';
    break;

    case '02':
    $mois = 'Février';
    break;

    case '03':
    $mois = 'Mars';
    break;

    case '04':
    $mois = 'Avril';
    break;

    case '05':
    $mois = 'Mai';
    break;

    case '06':
    $mois = 'Juin';
    break;

    case '07':
    $mois = 'Juillet';
    break;

    case '08':
    $mois = 'Août';
    break;

    case '09':
    $mois = 'Semptembre';
    break;

    case '10':
    $mois = 'Octobre';
    break;

    case '11':
    $mois = 'Novembre';
    break;

    case '12':
    $mois = 'Décembre';
    break;
  }
}

if ($liste != 1) {
  $jour = strftime("%d", strtotime($date[0]));
  $mois = strftime("%m", strtotime($date[0]));
  $annee = strftime("%G", strtotime($date[0]));

  switch ($mois) {
    case '01':
    $mois = 'Janvier';
    break;

    case '02':
    $mois = 'Février';
    break;

    case '03':
    $mois = 'Mars';
    break;

    case '04':
    $mois = 'Avril';
    break;

    case '05':
    $mois = 'Mai';
    break;

    case '06':
    $mois = 'Juin';
    break;

    case '07':
    $mois = 'Juillet';
    break;

    case '08':
    $mois = 'Août';
    break;

    case '09':
    $mois = 'Semptembre';
    break;

    case '10':
    $mois = 'Octobre';
    break;

    case '11':
    $mois = 'Novembre';
    break;

    case '12':
    $mois = 'Décembre';
    break;
  }
}
?>
