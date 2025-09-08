import { __ } from '@wordpress/i18n';
import domReady from '@wordpress/dom-ready'; // eslint-disable-line
import { registerBlockStyle } from '@wordpress/blocks';

const BLOCK_NAME = 'core/group';

domReady(() => {
  registerBlockStyle(BLOCK_NAME, [
    {
      name: '',
      label: __('With Space', 'base-theme'),
      isDefault: true,
    },
    {
      name: 'with-space-xl',
      label: __('Large Space', 'base-theme'),
    },
    {
      name: 'without-space',
      label: __('Without Space', 'base-theme'),
    },
  ]);
});
