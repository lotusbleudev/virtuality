/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";

// start the Stimulus application
import "./bootstrap";
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');


// Animation -css du boutton dans le registrationForm
var animateButton = function (e) {
	e.preventDefault;
	//reset animation
	e.target.classList.remove("animate");

	e.target.classList.add("animate");
	setTimeout(function () {
		e.target.classList.remove("animate");
	}, 700);
};

var bubblyButtons = document.getElementsByClassName("butn");

for (var i = 0; i < bubblyButtons.length; i++) {
	bubblyButtons[i].addEventListener("click", animateButton, false);
}



//--------------------------------Récupération du nb des joueurs et dynamisation du prix dans réservation

var input_date = document.getElementById("reservation_date");
var input_showPrix = document.getElementById("prix");
var input_joueurs = document.getElementById("reservation_nb_joueurs");
var input_espace = document.getElementById("radio");
var prixTotal;

input_date.addEventListener("change", calcul_prix);
input_joueurs.addEventListener("change", calcul_prix);
input_espace.addEventListener("change", calcul_prix);


function calcul_prix() {
	var date = document.getElementById("reservation_date_date").value;
	var dayDate = new Date(date);
	var dayOfWeek = dayDate.getDay();
	var isWeekend = (dayOfWeek === 6) || (dayOfWeek  === 0); // 6 = Saturday, 0 = Sunday

	var prixUnitaire;
	var prixTotal;
	var joueurs = input_joueurs.value;
	var espace = input_espace.value;

	if(espace == "box") {

		if(isWeekend) {
			prixUnitaire = 25;
		}
		else if (!isWeekend) {
			prixUnitaire = 20;
		}

		prixTotal = prixUnitaire * joueurs;
	}

	else if (espace == "hall") {

		if(isWeekend) {
			prixTotal = 350;
		}
		else if (!isWeekend) {
			prixTotal = 250;
		}
	}


	if(date !== null && date !== '') {
		input_showPrix.innerHTML = prixTotal;
	}
	else {
		input_showPrix.innerHTML = "Veuillez choisir une date";
	}
}

