const BLOCK_NAME = 'core/button';

wp.domReady(() => {
  wp.blocks.registerBlockStyle(BLOCK_NAME, [
    {
      name: '',
      label: wp.i18n.__('Primary', 'base-theme'),
      isDefault: true,
    },
    {
      name: 'secondary',
      label: wp.i18n.__('Secondary', 'base-theme'),
    },
  ]);
});
