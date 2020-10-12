import Swiper from 'swiper/bundle';

const swiper = new Swiper('.swiper-container', {
  slidesPerView: 3,

  // Optional parameters
  direction: 'horizontal',
  loop: false,
  grabCursor: true,
  spaceBetween: 30,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
