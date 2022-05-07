function face () {
	document.getElementById('fface').style.bottom = '2%';
	document.getElementById('fhair').style.bottom = '-32%';
	document.getElementById('feyes').style.bottom = '-32%';
	document.getElementById('febrow').style.bottom = '-32%';
	document.getElementById('flips').style.bottom = '-32%';
	document.getElementById('fbeard').style.bottom = '-32%';
}
function hair () {
	document.getElementById('fface').style.bottom = '-32%';
	document.getElementById('fhair').style.bottom = '2%';
	document.getElementById('feyes').style.bottom = '-32%';
	document.getElementById('febrow').style.bottom = '-32%';
	document.getElementById('flips').style.bottom = '-32%';
	document.getElementById('fbeard').style.bottom = '-32%';
}
function eyes () {
	document.getElementById('fface').style.bottom = '-32%';
	document.getElementById('fhair').style.bottom = '-32%';
	document.getElementById('feyes').style.bottom = '2%';
	document.getElementById('febrow').style.bottom = '-32%';
	document.getElementById('flips').style.bottom = '-32%';
	document.getElementById('fbeard').style.bottom = '-32%';
}
function ebrow () {
	document.getElementById('fface').style.bottom = '-32%';
	document.getElementById('fhair').style.bottom = '-32%';
	document.getElementById('feyes').style.bottom = '-32%';
	document.getElementById('febrow').style.bottom = '2%';
	document.getElementById('flips').style.bottom = '-32%';
	document.getElementById('fbeard').style.bottom = '-32%';
}
function lips () {
	document.getElementById('fface').style.bottom = '-32%';
	document.getElementById('fhair').style.bottom = '-32%';
	document.getElementById('feyes').style.bottom = '-32%';
	document.getElementById('febrow').style.bottom = '-32%';
	document.getElementById('flips').style.bottom = '2%';
	document.getElementById('fbeard').style.bottom = '-32%';
}
function beard () {
	document.getElementById('fface').style.bottom = '-32%';
	document.getElementById('fhair').style.bottom = '-32%';
	document.getElementById('feyes').style.bottom = '-32%';
	document.getElementById('febrow').style.bottom = '-32%';
	document.getElementById('flips').style.bottom = '-32%';
	document.getElementById('fbeard').style.bottom = '2%';
}
function face1 () {
	var element = document.getElementById('face3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('face2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('face1');
	element.classList.remove("hide");
	element.classList.add("show");

	let input = document.getElementById('visage');
	input.value = 1;
}
function face2 () {
	var element = document.getElementById('face3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('face2');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('face1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('visage');
	input.value = 2;
}
function face3 () {
	var element = document.getElementById('face3');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('face2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('face1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('visage');
	input.value = 3;
}
function hair1 () {
	var element = document.getElementById('hair3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('hair2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('hair1');
	element.classList.remove("hide");
	element.classList.add("show");

	let input = document.getElementById('cheveux');
	input.value = 1;
}
function hair2 () {
	var element = document.getElementById('hair3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('hair2');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('hair1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('cheveux');
	input.value = 2;
}
function hair3 () {
	var element = document.getElementById('hair3');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('hair2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('hair1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('cheveux');
	input.value = 3;
}
function eyes1 () {
	var element = document.getElementById('eyes3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('eyes2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('eyes1');
	element.classList.remove("hide");
	element.classList.add("show");

	let input = document.getElementById('yeux');
	input.value = 1;
}
function eyes2 () {
	var element = document.getElementById('eyes3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('eyes2');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('eyes1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('yeux');
	input.value = 2;
}
function eyes3 () {
	var element = document.getElementById('eyes3');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('eyes2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('eyes1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('yeux');
	input.value = 3;
}
function ebrow1 () {
	var element = document.getElementById('ebrow3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('ebrow2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('ebrow1');
	element.classList.remove("hide");
	element.classList.add("show");

	let input = document.getElementById('sourcil');
	input.value = 1;
}
function ebrow2 () {
	var element = document.getElementById('ebrow3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('ebrow2');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('ebrow1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('sourcil');
	input.value = 2;
}
function ebrow3 () {
	var element = document.getElementById('ebrow3');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('ebrow2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('ebrow1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('sourcil');
	input.value = 3;
}
function lips3 () {
	var element = document.getElementById('lips3');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('lips2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('lips1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('bouche');
	input.value = 1;
}
function lips2 () {
	var element = document.getElementById('lips3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('lips2');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('lips1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('bouche');
	input.value = 2;
}
function lips1 () {
	var element = document.getElementById('lips3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('lips2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('lips1');
	element.classList.remove("hide");
	element.classList.add("show");

	let input = document.getElementById('bouche');
	input.value = 3;
}
function beard1 () {
	var element = document.getElementById('beard3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('beard2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('beard1');
	element.classList.remove("hide");
	element.classList.add("show");

	let input = document.getElementById('barbe');
	input.value = 1;
}
function beard2 () {
	var element = document.getElementById('beard3');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('beard2');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('beard1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('barbe');
	input.value = 2;
}
function beard3 () {
	var element = document.getElementById('beard3');
	element.classList.remove("hide");
	element.classList.add("show");
	element = document.getElementById('beard2');
	element.classList.remove("show");
	element.classList.add("hide");
	element = document.getElementById('beard1');
	element.classList.remove("show");
	element.classList.add("hide");

	let input = document.getElementById('barbe');
	input.value = 3;
}
