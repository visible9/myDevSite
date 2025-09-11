export const onDocumentReady = (readyCallback) => {
  if (document.readyState !== 'loading') {
    readyCallback();
  } else {
    window.addEventListener('DOMContentLoaded', readyCallback, false);
  }
};
