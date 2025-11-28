import { onDocumentReady } from '../../../scripts/utils/events';
import { scrollIntoViewWithOffset } from '../../../scripts/utils/helpers';

const initTabsBlock = (tabsBlock) => {
  const nav = tabsBlock.querySelector('.tabs-nav');
  const panels = Array.from(tabsBlock.querySelectorAll('.tabs-panel'));

  if (!nav || panels.length === 0) {
    return;
  }

  nav.innerHTML = '';

  const buttons = panels.map((panel) => {
    const title = panel.dataset.tabTitle?.trim() || 'Tab title';

    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'tabs-nav__button';
    button.textContent = title;

    nav.appendChild(button);
    return button;
  });

  const activateTab = (index) => {
    panels.forEach((panel, i) => {
      panel.classList.toggle('is-active', i === index);
      panel.hidden = i !== index;
    });

    buttons.forEach((button, i) => {
      button.classList.toggle('is-active', i === index);
    });
  };

  buttons.forEach((button, index) => {
    button.addEventListener('click', () => activateTab(index));
  });

  activateTab(0);

  // Get anchor from URL and open accordion item
  const urlHash = window.location.hash;
  if (urlHash) {
    const targetTabItem = document.querySelector(
      `.js-acf-tabs .tabs-panel${urlHash}`
    );
    if (targetTabItem) {
      // Find the index of the target tab item
      const targetIndex = panels.indexOf(targetTabItem);
      if (targetIndex !== -1) {
        setTimeout(() => {
          // Scroll to the tabs block
          scrollIntoViewWithOffset(nav);
          // Activate the target tab
          activateTab(targetIndex);
        }, 300);
      }
    }
  }
};

onDocumentReady(() => {
  document.querySelectorAll('.js-acf-tabs').forEach(initTabsBlock);
});
