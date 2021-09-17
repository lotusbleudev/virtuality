import './styles/menu.scss';

'use strict';

const menuButton = document.querySelector('.menu-button');
const menuOverlay = document.querySelector('.menu-overlay');
const backgroundOverlay = document.querySelector('.background-overlay');

menuButton.addEventListener('click', function() {
    menuButton.classList.toggle('active');
    menuOverlay.classList.toggle('open');
    backgroundOverlay.classList.toggle('bg-overlay');
});