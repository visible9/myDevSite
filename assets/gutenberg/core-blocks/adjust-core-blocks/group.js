import { __ } from '@wordpress/i18n'; // eslint-disable-line
import domReady from '@wordpress/dom-ready'; // eslint-disable-line
import { registerBlockStyle } from '@wordpress/blocks';

const BLOCK_NAME = 'core/group';

domReady(() => {
  registerBlockStyle(BLOCK_NAME, [
    {
      name: '',
      label: __('With Space', 'dev-theme'),
      isDefault: true,
    },
    {
      name: 'with-space-xl',
      label: __('Large Space', 'dev-theme'),
    },
    {
      name: 'without-space',
      label: __('Without Space', 'dev-theme'),
    },
  ]);
});
