import './bootstrap';
import '../css/app.css';

document.getElementById('mobile-menu-button').addEventListener('click', function () {
  const menu = document.getElementById('mobile-menu');
  menu.classList.toggle('hidden');
});



document.querySelectorAll('.dropdown').forEach(dropdown => {
  const btn = dropdown.querySelector('.dropdown-btn');
  const menu = dropdown.querySelector('.dropdown-menu');

  // toggle saat klik tombol
  btn.addEventListener('click', e => {
    e.stopPropagation();
    menu.classList.toggle('hidden');
  });

  // klik di luar menutup menu
  document.addEventListener('click', e => {
    if (!dropdown.contains(e.target)) {
      menu.classList.add('hidden');
    }
  });
});

