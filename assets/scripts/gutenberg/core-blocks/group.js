const BLOCK_NAME = 'core/group';

wp.domReady(() => {
  wp.blocks.registerBlockStyle(BLOCK_NAME, [
    {
      name: '',
      label: wp.i18n.__('With Space', 'base-theme'),
      isDefault: true,
    },
    {
      name: 'with-space-xl',
      label: wp.i18n.__('Large Space', 'base-theme'),
    },
    {
      name: 'without-space',
      label: wp.i18n.__('Without Space', 'base-theme'),
    },
  ]);
});
