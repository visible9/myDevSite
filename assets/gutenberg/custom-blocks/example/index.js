import React from 'react';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor.scss';
import './style.scss';
import metadata from './block.json';
import BlockControls from './controls/BlockControls';
import InspectorControls from './controls/InspectorControls';
import ExampleComponent from '../../../scripts/components/ExampleComponent/index';

export const name = metadata.name;

export const settings = {
  edit: (props) => {
    const { attributes, setAttributes, isSelected } = props;
    const blockProps = useBlockProps({
      'data-align': attributes.align,
    });

    const richTexts = {
      text: (
        <RichText
          tagName={'p'}
          value={attributes.text}
          onChange={(text) => setAttributes({ text })}
          placeholder={__('Text...', 'base-theme')}
          allowedFormats={[]}
        />
      ),
    };

    console.log('richTexts', richTexts); //eslint-disable-line
    console.log('isSelected', isSelected); //eslint-disable-line

    return (
      <>
        <InspectorControls {...props} />
        <BlockControls {...props} />
        <div {...blockProps}>
          <ExampleComponent
            {...{
              isEditor: true,
              ...attributes,
              ...(isSelected ? { richTexts } : {}),
            }}
          />
        </div>
      </>
    );
  },
};
