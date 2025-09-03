import { __ } from '@wordpress/i18n';
import { InspectorControls as GBInspectorControls } from '@wordpress/block-editor';
import { SelectControl, PanelBody } from '@wordpress/components';

const InspectorControls = ({ attributes = {}, setAttributes = () => {} }) => (
  <GBInspectorControls>
    <PanelBody title={__('Settings', 'dhsv_theme')}>
      <SelectControl
        label={__('Type attribute', 'dhsv_theme')}
        value={attributes.testSelect}
        onChange={testSelect => setAttributes({ testSelect })}
        help={__('Helptext of the type control', 'dhsv_theme')}
        options={[
          { label: __('Option 1', 'dhsv_theme'), value: 'option-1' },
          { label: __('Option 2', 'dhsv_theme'), value: 'option-2' },
          { label: __('Option 3', 'dhsv_theme'), value: 'option-3' },
        ]}
      />
    </PanelBody>
  </GBInspectorControls>
)

export default InspectorControls;
