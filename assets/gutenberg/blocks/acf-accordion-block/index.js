import { onDocumentReady } from '../../../scripts/utils/events';
import { scrollIntoViewWithOffset } from '../../../scripts/utils/helpers';
onDocumentReady(() => {
  document
    .querySelectorAll('.js-acf-accordion-block')
    .forEach(function (accordion) {
      const accordionItems = accordion.querySelectorAll('.accordion-item');
      const multipleExtended = accordion.getAttribute('data-multiple-extended');
      const selectedItem = accordion.getAttribute('data-selected-element');

      accordionItems.forEach(function (item, index) {
        const title = item.querySelector('.accordion-title');

        // Open selected item on load
        if (selectedItem && parseInt(selectedItem, 10) === index) {
          extendItem(item);
        }

        // Toggle accordion item on title click
        title.addEventListener('click', () => {
          if (item.classList.contains('is-active')) {
            closeItem(item);
          } else {
            if (!multipleExtended) {
              accordionItems.forEach((otherItem) => {
                closeItem(otherItem);
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

// Close accordion item
const closeItem = (item) => {
  item.classList.remove('is-active');
  item.querySelector('.accordion-content').style.height = 0 + 'px';
};

// Get anchor from URL and open accordion item
const urlHash = window.location.hash;
if (urlHash) {
  const targetAccordionItem = document.querySelector(
    `.js-acf-accordion-block .accordion-item${urlHash}`
  );
  if (targetAccordionItem) {
    targetAccordionItem.classList.add('is-active');
    extendItem(targetAccordionItem);
    // Scroll to the accordion item
    setTimeout(() => {
      scrollIntoViewWithOffset(targetAccordionItem);
    }, 300);
  }
}
