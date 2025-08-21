import './bootstrap';
import '../css/app.css';

document.getElementById('mobile-menu-button').addEventListener('click', function () {
  const menu = document.getElementById('mobile-menu');
  menu.classList.toggle('hidden');
});


document.querySelectorAll('.dropdown').forEach(dropdown => {
  const btn = dropdown.querySelector('.dropdown-btn');
  const menu = dropdown.querySelector('.dropdown-menu');
    if (!btn || !menu) return;

  btn.addEventListener('click', e => {
    e.stopPropagation();

    // tutup semua dropdown lain
    document.querySelectorAll('.dropdown-menu').forEach(m => {
      if (m !== menu) m.classList.add('hidden');
    });

    // toggle dropdown ini
    menu.classList.toggle('hidden');
  });
});

document.addEventListener('click', () => {
  document.querySelectorAll('.dropdown-menu').forEach(menu => {
    menu.classList.add('hidden');
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const dropdownSoalBtn = document.getElementById("dropdownSoalBtn");
  const dropdownSoalMenu = document.getElementById("dropdownSoalMenu");

  const dropdownContohBtn = document.getElementById("dropdownContohBtn");
  const dropdownContohMenu = document.getElementById("dropdownContohMenu");

  // toggle dropdown utama
  dropdownSoalBtn.addEventListener("click", () => {
    dropdownSoalMenu.classList.toggle("hidden");
  });

  // toggle nested submenu
  dropdownContohBtn.addEventListener("click", (e) => {
    e.stopPropagation(); // biar tidak nutup menu utama
    dropdownContohMenu.classList.toggle("hidden");
  });

  // klik di luar → tutup semua
  document.addEventListener("click", (e) => {
    if (!dropdownSoalBtn.contains(e.target) && !dropdownSoalMenu.contains(e.target)) {
      dropdownSoalMenu.classList.add("hidden");
      dropdownContohMenu.classList.add("hidden");
    }
  });
});


