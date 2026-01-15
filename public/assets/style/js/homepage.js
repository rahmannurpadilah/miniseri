// Active Navigation Link on Scroll
document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".nav-glass .nav-item");
  const sections = Array.from(navLinks)
    .map(link => document.querySelector(link.getAttribute("href")))
    .filter(Boolean);

  const offset = 140; // tinggi navbar

  function setActive() {
    let currentSection = sections[0];

    sections.forEach(section => {
      if (window.scrollY >= section.offsetTop - offset) {
        currentSection = section;
      }
    });

    navLinks.forEach(link => {
      link.classList.toggle(
        "active",
        link.getAttribute("href") === `#${currentSection.id}`
      );
    });
  }

  window.addEventListener("scroll", setActive);
  window.addEventListener("load", setActive);
});


// Scroll to Top Button Functionality
const scrollBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", () => {
  if (window.scrollY > 400) {
    if (!checkBurger()){
      scrollBtn.classList.add("show");
    }
  } else {
    scrollBtn.classList.remove("show");
  }
});

scrollBtn





















.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

// Navbar Scroll Effect & Mobile Navigation Toggle
const navbar = document.getElementById('navbar');
const hero = document.getElementById('home');
const toggle = document.getElementById('navToggle');
const mobileNav = document.getElementById('mobileNav');
const navbarContent = document.getElementById('navbarContent');
const scrollTopButton = document.getElementById('scrollTopBtn');

function checkBurger(){
  return navbarContent.classList.contains('navbar-hide')
}

window.addEventListener('scroll', () => {
  if (!checkBurger()){
    navbar.classList.toggle(
      'navbar-scrolled',
      window.scrollY > hero.offsetHeight * 0.6
    );
  }
});

toggle.addEventListener('click', () => {
  toggle.classList.toggle('active');
  mobileNav.classList.toggle('show');
  navbarContent.classList.toggle('navbar-hide');
  if (checkBurger()){
    navbar.classList.remove('navbar-scrolled');
    scrollBtn.classList.remove('show');
  }
});

mobileNav.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    toggle.classList.remove('active');
    mobileNav.classList.remove('show');
    navbarContent.classList.remove('navbar-hide');
  });
});

// Hero Section Parallax Effect
const heroText = document.querySelector('.hero-text');

window.addEventListener('scroll', () => {
  heroText.style.transform =
    `translateY(${window.scrollY * 0.05}px)`;
});

// Reveal Elements on Scroll
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll('.reveal');

  if (!items.length) return;

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;

        // stagger berdasarkan index
        const index = [...items].indexOf(el);

        setTimeout(() => {
          el.classList.add('show');
        }, index * 120);

        // stop observing elemen ini aja
        obs.unobserve(el);
      }
    });
  }, {
    root: null,
    threshold: 0.2,
    rootMargin: '0px 0px -80px 0px'
  });

  items.forEach(item => observer.observe(item));
});

// Auto-hide Toast Message
setTimeout(() => {
    document.querySelectorAll('.toast-glass').forEach(t => t.remove());
}, 5000);