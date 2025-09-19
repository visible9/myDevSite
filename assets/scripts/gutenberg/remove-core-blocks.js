const disabledCoreBlocks = [
  // add blocks to remove (keep this comment)
  //'buttons', // => core/buttons
];

const disableCoreFormats = [
  // add formats to remove (keep this comment)
];

const disableCoreStyles = [
  // add block styles to remove (keep this comment)
  //{ name: 'button', style: 'outline' }, // => core/button style=outline
];

wp.domReady(() => {
  //unregister blocks
  disabledCoreBlocks.forEach((block) =>
    wp.blocks.unregisterBlockType(`core/${block}`)
  );

  disableCoreStyles.forEach((block) =>
    wp.blocks.unregisterBlockStyle(`core/${block.name}`, block.style)
  );

  //unregister formats
  disableCoreFormats.forEach((format) =>
    wp.richText.unregisterFormatType(`core/${format}`)
  );
});
