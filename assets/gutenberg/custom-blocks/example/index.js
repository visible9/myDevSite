/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n'
import { useBlockProps, RichText } from '@wordpress/block-editor'

/**
 * Internal dependencies
 */
import './editor.scss'
import metadata from './block.json'
import BlockControls from './controls/BlockControls'
import InspectorControls from './controls/InspectorControls'
import ExampleComponent from '../../../scripts/components/ExampleComponent/index'

const { name } = metadata

export { name }

export const settings = {
  edit: props => {
    const { attributes, setAttributes, isSelected } = props
    const blockProps = useBlockProps({
      'data-align': attributes.align,
      className: metadata.editorStyle,
    })

    const richTexts = {
      text: (
        <RichText
          tagName={'p'}
          value={attributes.text}
          onChange={text => setAttributes({ text })}
          placeholder={__('Text...', 'dhsv_theme')}
          allowedFormats={[]}
        />
      ),
    }

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
    )
  },
}
