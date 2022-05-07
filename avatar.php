
<?php

include "includes/bdd.php";

$query = $bdd -> query('SELECT id_bouche, id_barbe, id_yeux, id_sourcil, id_visage, id_cheveux FROM AVATAR WHERE email="'.$_SESSION['compte'].'"');
$avatar = $query -> fetch();

 ?>

<div class="display-avatar-profil">
  <div class="avatar">
    <div class="fshape">
      <svg class="show" version="1.1" id="face1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
      y="0px" viewBox="0 0 160 191">
      <image width="160" height="191" id="face1_xA0_Image" xlink:href=<?php include 'avatar/parts/faces/face'.$avatar['id_visage'] ?>>
      </image>
    </svg>
  </div>
  <div class="hair">
    <svg class="show" version="1.1" id="hair1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
    y="0px" viewBox="0 0 209 171">
    <image width="209" height="171" id="hair1_xA0_Image" xlink:href=<?php include 'avatar/parts/hair/hair'.$avatar['id_cheveux'] ?>>
    </image>
  </svg>
</div>
<div class="eyes">
  <svg class="eyes1 show" version="1.1" id="eyes1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
  y="0px" viewBox="0 0 184 192">
  <image width="184" height="192" id="eyes1_xA0_Image" xlink:href=<?php include 'avatar/parts/eyes/eye'.$avatar['id_yeux'] ?>>
  </image>
</svg>
</div>
<div class="eyebrow">
  <svg class="show" version="1.1" id="ebrow1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
  x="0px" y="0px" viewBox="0 0 192 186">
  <image width="192" height="186" id="ebrow1_xA0_Image" xlink:href=<?php include 'avatar/parts/ebrow/ebrow'.$avatar['id_sourcil'] ?>>
  </image>
</svg>
</div>
<div class="nose">
  <svg version="1.1" id="nose1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
  y="0px" viewBox="0 0 192 180">
  <image width="192" height="180" id="nose1_xA0_Image" xlink:href=<?php include "avatar/parts/nose/nose1" ?>>
  </image>
</svg>
</div>
<div class="lips">
  <svg class="show" version="1.1" id="lips1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
  y="0px" viewBox="0 0 198 64">
  <image width="198" height="64" id="lips1_xA0_Image" xlink:href=<?php include 'avatar/parts/lips/lips1' ?>>
  </image>
</svg>
</div>
<div class="beard">
  <svg class="show" version="1.1" id="beard1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
  x="0px" y="0px" viewBox="0 0 204 168">
  <image width="204" height="168" id="beard1_xA0_Image" xlink:href=<?php include 'avatar/parts/beard/beard'.$avatar['id_barbe'] ?>>
  </image>
</svg>
</div>
</div>
</div>
