import Diapositive from 'diapositive';

const contentSlider = new Diapositive('.tabs__contents', {
  activeClassName: 'tabs__content--active',
});

const tabsSlider = new Diapositive('.tabs__tabs', {
  activeClassName: 'tabs__tab--active',
});

document.querySelectorAll('.tabs__tab').forEach((tab, index) => {
  tab.addEventListener('click', () => {
    contentSlider.goTo(index);
    tabsSlider.goTo(index);
  });
});
