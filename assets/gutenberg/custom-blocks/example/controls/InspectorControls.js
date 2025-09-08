import React from 'react';
import { __ } from '@wordpress/i18n';
import { InspectorControls as GBInspectorControls } from '@wordpress/block-editor';
import { SelectControl, PanelBody } from '@wordpress/components';

const InspectorControls = ({ attributes = {}, setAttributes = () => {} }) => (
  <GBInspectorControls>
    <PanelBody title={__('Settings', 'base-theme')}>
      <SelectControl
        label={__('Type attribute', 'base-theme')}
        value={attributes.testSelect}
        onChange={(testSelect) => setAttributes({ testSelect })}
        help={__('Helptext of the type control', 'base-theme')}
        options={[
          { label: __('Option 1', 'base-theme'), value: 'option-1' },
          { label: __('Option 2', 'base-theme'), value: 'option-2' },
          { label: __('Option 3', 'base-theme'), value: 'option-3' },
        ]}
      />
    </PanelBody>
  </GBInspectorControls>
);

export default InspectorControls;
