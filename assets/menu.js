import './styles/menu.scss';

'use strict';

const menuButton = document.querySelector('.menu-button');
const menuOverlay = document.querySelector('.menu-overlay');
const mainWidth = document.querySelector('.main-width');
const footerWidth = document.querySelector('.footer-width');
const menuOuverture = document.querySelector('.ouverture');

// const backgroundOverlay = document.querySelector('.background-overlay');

menuButton.addEventListener('click', function() {
    menuButton.classList.toggle('active');
    menuOverlay.classList.toggle('open');
    mainWidth.classList.toggle('reduce');
    footerWidth.classList.toggle('reduce');
    menuOuverture.classList.toggle('reduce');
    // backgroundOverlay.classList.toggle('bg-overlay');
});