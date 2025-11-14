import { onDocumentReady } from '../../../scripts/utils/events';
onDocumentReady(() => {
  document
    .querySelectorAll('.js-acf-accordion-block')
    .forEach(function (accordion) {
      const accordionItems = accordion.querySelectorAll('.accordion-item');
      const multipleExtended = accordion.getAttribute('data-multiple-extended');

      accordionItems.forEach(function (item) {
        const title = item.querySelector('.accordion-title');

        if (item.classList.contains('is-active')) {
          extendItem(item);
        }

        title.addEventListener('click', () => {
          if (item.classList.contains('is-active')) {
            item.classList.remove('is-active');
            item.querySelector('.accordion-content').style.height = 0 + 'px';
          } else {
            if (!multipleExtended) {
              accordionItems.forEach((otherItem) => {
                otherItem.classList.remove('is-active');
                otherItem.querySelector('.accordion-content').style.height =
                  0 + 'px';
              });
            }
            item.classList.add('is-active');
            extendItem(item);
          }
        });
      });
    });
});

// Extend accordion item
const extendItem = (item) => {
  item.classList.add('is-active');
  item.querySelector('.accordion-content').style.height =
    item.querySelector('.accordion-content').scrollHeight + 'px';
};

// Get anchor from URL and open accordion item
const urlHash = window.location.hash;
if (urlHash) {
  console.log('urlHash', urlHash); //eslint-disable-line
  const targetAccordionItem = document.querySelector(
    `.js-acf-accordion-block .accordion-item${urlHash}`
  );
  if (targetAccordionItem) {
    targetAccordionItem.classList.add('is-active');
    extendItem(targetAccordionItem);
    // Scroll to the accordion item
    setTimeout(() => {
      targetAccordionItem.scrollIntoView({ behavior: 'smooth' });
    }, 300);
  }
}
