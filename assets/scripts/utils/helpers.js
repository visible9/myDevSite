// Scroll to section
export const scrollIntoViewWithOffset = (el, offset = 0) => {
  if (!el) return;

  const headerHeight = document.querySelector('.header')?.offsetHeight || 0;

  window.scrollTo({
    top:
      el.getBoundingClientRect().top + window.scrollY - headerHeight - offset,
    behavior: 'smooth',
  });
};
