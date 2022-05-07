<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editeur d'avatar</title>
	<?php include "includes/bdd.php" ?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="avatar/style-avatar.css?<?php echo time(); ?>">
</head>
<body>
	<div class="container">
		<div class="display d-flex justify-content-center">
			<div class="avatar">
				<div class="fshape">
					<svg class="face3 hide" version="1.1" id="face3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
					y="0px" viewBox="0 0 164 194" style="enable-background:new 0 0 164 194;" xml:space="preserve">
					<image width="164" height="194" id="face3_xA0_Image" xlink:href=<?php include "avatar/parts/faces/face3" ?>>
					</image>
				</svg>
				<svg class="face2 hide" version="1.1" id="face2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
				y="0px" viewBox="0 0 186 188" style="enable-background:new 0 0 186 188;" xml:space="preserve">
				<image width="186" height="188" id="face2_xA0_Image" xlink:href=<?php include "avatar/parts/faces/face2" ?>>
				</image>
			</svg>
			<svg class="show" version="1.1" id="face1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
			y="0px" viewBox="0 0 160 191" style="enable-background:new 0 0 160 191;" xml:space="preserve">
			<image width="160" height="191" id="face1_xA0_Image" xlink:href=<?php include "avatar/parts/faces/face1" ?>>
			</image>
		</svg>
	</div>
	<div class="hair">
		<svg class="hair3 hide" version="1.1" id="hair3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
		y="0px" viewBox="0 0 177 199" style="enable-background:new 0 0 177 199;" xml:space="preserve">
		<image width="177" height="199" id="hair3_xA0_Image" xlink:href=<?php include "avatar/parts/hair/hair3" ?>>
		</image>
	</svg>
	<svg class="hair2 hide" version="1.1" id="hair2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
	y="0px" viewBox="0 0 180 168" style="enable-background:new 0 0 180 168;" xml:space="preserve">
	<image width="180" height="168" id="hair2_xA0_Image" xlink:href=<?php include "avatar/parts/hair/hair2" ?>>
	</image>
</svg>
<svg class="show" version="1.1" id="hair1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
y="0px" viewBox="0 0 209 171" style="enable-background:new 0 0 209 171;" xml:space="preserve">
<image width="209" height="171" id="hair1_xA0_Image" xlink:href=<?php include "avatar/parts/hair/hair1" ?>>
</image>
</svg>
</div>
<div class="eyes">
	<svg class="eyes3 hide" version="1.1" id="eyes3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
	y="0px" viewBox="0 0 191 184" style="enable-background:new 0 0 191 184;" xml:space="preserve">
	<image width="191" height="184" id="eyes3_xA0_Image" xlink:href=<?php include "avatar/parts/eyes/eye3" ?>>
	</image>
</svg>
<svg class="eyes2 hide" version="1.1" id="eyes2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
y="0px" viewBox="0 0 186 186" style="enable-background:new 0 0 186 186;" xml:space="preserve">
<image width="186" height="186" id="eyes2_xA0_Image" xlink:href=<?php include "avatar/parts/eyes/eye2" ?>>
</image>
</svg>
<svg class="eyes1 show" version="1.1" id="eyes1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
y="0px" viewBox="0 0 184 192" style="enable-background:new 0 0 184 192;" xml:space="preserve">
<image width="184" height="192" id="eyes1_xA0_Image" xlink:href=<?php include "avatar/parts/eyes/eye1" ?>>
</image>
</svg>
</div>
<div class="eyebrow">
	<svg class="hide" version="1.1" id="ebrow3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	x="0px" y="0px" viewBox="0 0 173 189" style="enable-background:new 0 0 173 189;" xml:space="preserve">
	<image width="173" height="189" id="ebrow3_xA0_Image" xlink:href=<?php include "avatar/parts/ebrow/ebrow3" ?>>
	</image>
</svg>
<svg class="hide" version="1.1" id="ebrow2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
x="0px" y="0px" viewBox="0 0 186 192" style="enable-background:new 0 0 186 192;" xml:space="preserve">
<image width="186" height="192" id="ebrow2_xA0_Image" xlink:href=<?php include "avatar/parts/ebrow/ebrow2" ?>>
</image>
</svg>
<svg class="show" version="1.1" id="ebrow1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
x="0px" y="0px" viewBox="0 0 192 186" style="enable-background:new 0 0 192 186;" xml:space="preserve">
<image width="192" height="186" id="ebrow1_xA0_Image" xlink:href=<?php include "avatar/parts/ebrow/ebrow1" ?>>
</image>
</svg>
</div>
<div class="nose">
	<svg version="1.1" id="nose1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
	y="0px" viewBox="0 0 192 180" style="enable-background:new 0 0 192 180;" xml:space="preserve">
	<image width="192" height="180" id="nose1_xA0_Image" xlink:href=<?php include "avatar/parts/nose/nose1" ?>>
	</image>
</svg>
</div>
<div class="lips">
	<svg class="lips3 hide" version="1.1" id="lips3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
	y="0px" viewBox="0 0 191 194" style="enable-background:new 0 0 191 194;" xml:space="preserve">
	<image width="191" height="194" id="lips3_xA0_Image" xlink:href=<?php include "avatar/parts/lips/lips3" ?>>
	</image>
</svg>
<svg class="lips2 hide" version="1.1" id="lips2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
y="0px" viewBox="0 0 196 180" style="enable-background:new 0 0 196 180;" xml:space="preserve">
<image width="196" height="180" id="lips2_xA0_Image" xlink:href=<?php include "avatar/parts/lips/lips2" ?>>
</image>
</svg>
<svg class="show" version="1.1" id="lips1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
y="0px" viewBox="0 0 198 64" style="enable-background:new 0 0 198 64;" xml:space="preserve">
<image width="198" height="64" id="lips1_xA0_Image" xlink:href=<?php include "avatar/parts/lips/lips1" ?>>
</image>
</svg>
</div>
<div class="beard">
	<svg class="beard3 hide" version="1.1" id="beard3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	x="0px" y="0px" viewBox="0 0 178 180" style="enable-background:new 0 0 178 180;" xml:space="preserve">
	<image width="178" height="180" id="beard3_xA0_Image" xlink:href=<?php include "avatar/parts/beard/beard3" ?>>
	</image>
</svg>
<svg class="beard2 hide" version="1.1" id="beard2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
x="0px" y="0px" viewBox="0 0 198 174" style="enable-background:new 0 0 198 174;" xml:space="preserve">
<image width="198" height="174" id="beard2_xA0_Image" xlink:href=<?php include "avatar/parts/beard/beard2" ?>>
</image>
</svg>
<svg class="show" version="1.1" id="beard1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
x="0px" y="0px" viewBox="0 0 204 168" style="enable-background:new 0 0 204 168;" xml:space="preserve">
<image width="204" height="168" id="beard1_xA0_Image" xlink:href=<?php include "avatar/parts/beard/beard1" ?>>
</image>
</svg>
</div>
</div>
<img src="avatar/parts/main.png" class="mbody">
</div>
<div class="gender">
	<div class="fpart" onclick="face()" data-tilt data-tilt-scale="1.5"><p>Visage</p></div>
	<div class="hpart" onclick="hair()" data-tilt data-tilt-scale="1.5"><p>Cheveux</p></div>
	<div class="epart" onclick="eyes()" data-tilt data-tilt-scale="1.5"><p>Yeux</p></div>
</div>
<div class="features">
	<div id="fface">
		<div class="fface1" onclick="face1()"></div>
		<div class="fface2" onclick="face2()"></div>
		<div class="fface3" onclick="face3()"></div>
	</div>
	<div id="fhair">
		<div class="fhair1" onclick="hair1()"></div>
		<div class="fhair2" onclick="hair2()"></div>
		<div class="fhair3" onclick="hair3()"></div>
	</div>
	<div id="feyes">
		<div class="feyes1" onclick="eyes1()"></div>
		<div class="feyes2" onclick="eyes2()"></div>
		<div class="feyes3" onclick="eyes3()"></div>
	</div>
	<div id="febrow">
		<div class="febrow1" onclick="ebrow1()"></div>
		<div class="febrow2" onclick="ebrow2()"></div>
		<div class="febrow3" onclick="ebrow3()"></div>
	</div>
	<div id="flips">
		<div class="flips1" onclick="lips1()"></div>
		<div class="flips2" onclick="lips2()"></div>
		<div class="flips3" onclick="lips3()"></div>
	</div>
	<div id="fbeard">
		<div class="fbeard1" onclick="beard1()"></div>
		<div class="fbeard2" onclick="beard3()"></div>
		<div class="fbeard3" onclick="beard2()"></div>
	</div>
</div>
<div class="colors">
	<div class="ebpart" onclick="ebrow()" data-tilt data-tilt-scale="1.5"><p>Sourcils</p></div>
	<div class="lpart" onclick="lips()" data-tilt data-tilt-scale="1.5"><p>Bouche</p></div>
	<div class="bpart" onclick="beard()" data-tilt data-tilt-scale="1.5"><p>Barbe</p></div>
</div>

<?php

$query = $bdd -> query('SELECT id_visage, id_yeux, id_sourcil, id_cheveux, id_bouche, id_barbe FROM AVATAR WHERE email="'.$_GET['compte'].'"');
$avatar = $query -> fetch();

?>

<form action="verification_avatar.php" method="post">
	<input type="number" id="visage" name="visage" value="<?php echo $avatar['id_visage'] ?>" style="display:none">
	<input type="number" id="cheveux" name="cheveux" value="<?php echo $avatar['id_cheveux'] ?>" style="display:none">
	<input type="number" id="yeux" name="yeux" value="<?php echo $avatar['id_yeux'] ?>" style="display:none">
	<input type="number" id="sourcil" name="sourcils" value="<?php echo $avatar['id_sourcil'] ?>" style="display:none">
	<input type="number" id="bouche" name="bouche" value="<?php echo $avatar['id_bouche'] ?>" style="display:none">
	<input type="number" id="barbe" name="barbe" value="<?php echo $avatar['id_barbe'] ?>" style="display:none">
	<input type="text" name="email" value="<?php echo $_GET['compte'] ?>" style="display:none">
	<input class="btn btn-primary" type="submit" value="Sauvegarder" id="save">
</form>
<a href="profil.php" id="return" class="btn btn-secondary">Retour</a>
</div>
<script type="text/javascript" src="avatar/script-avatar.js?<?php echo time(); ?>"></script>
</body>
</html>
