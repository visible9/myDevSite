import { __ } from '@wordpress/i18n'
import { BlockControls as GBBlockControls } from '@wordpress/block-editor'
import { Button } from '@wordpress/components'
import { swatch, check } from '@wordpress/icons'

const BlockControls = ({ attributes, setAttributes }) => (
  <>
    <GBBlockControls group={'block'}>
      <Button
        icon={attributes.test ? check : swatch}
        label={__('BlockControlExample', 'dhsv_theme')}
        onClick={() => setAttributes({ test: !attributes.test })}
      />
    </GBBlockControls>
  </>
)

export default BlockControls
