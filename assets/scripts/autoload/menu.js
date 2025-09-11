import { onDocumentReady } from '../utils/events';

onDocumentReady(() => {
  const menuButton = document.querySelector('.menu-icon');
  const menu = document.getElementById('main-menu');

  menuButton.addEventListener('click', () => {
    menuButton.classList.toggle('is-active');
    menu.classList.toggle('is-active');
  });
});
