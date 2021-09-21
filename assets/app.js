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
