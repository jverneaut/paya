const items = document.querySelectorAll('.faq__item');

items.forEach(item => {
  let active = item.classList.contains('faq__item--active');

  const title = item.querySelector('.faq__item-title');
  title.addEventListener('click', () => {
    active = !active;

    if (active) {
      item.classList.add('faq__item--active');
    } else {
      item.classList.remove('faq__item--active');
    }
  });
});
