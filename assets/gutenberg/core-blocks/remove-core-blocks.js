import domReady from '@wordpress/dom-ready'; // eslint-disable-line

const disabledCoreBlocks = [
  // add blocks to remove (keep this comment)
  //'buttons', // => core/buttons
]

const disableCoreFormats = [
  // add formats to remove (keep this comment)
]

domReady(() => {
  //unregister blocks
  disabledCoreBlocks.forEach(block =>
    wp.blocks.unregisterBlockType(`core/${block}`)
  )

  //unregister formats
  disableCoreFormats.forEach(format =>
    wp.richText.unregisterFormatType(`core/${format}`)
  )
})
