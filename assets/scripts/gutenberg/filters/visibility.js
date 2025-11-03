/* global globalData */
const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, ToggleControl } = wp.components;
const { createHigherOrderComponent } = wp.compose;
const { createElement, Fragment } = wp.element;
// Get all ACF registered blocks name
const acfBlocks = Object.keys(globalData?.acfBlocks.length > 0)
  ? Object.keys(globalData.acfBlocks)
  : [];

// Define the blocks that will have visibility options
const visibilityBlocks = [
  ...acfBlocks,
  'core/column',
  'core/spacer',
  'core/buttons',
];

wp.hooks.addFilter(
  'blocks.registerBlockType',
  'devwp/add-visibility-attributes',
  (settings, name) => {
    if (typeof settings.attributes !== 'undefined') {
      if (visibilityBlocks.includes(name)) {
        settings.attributes = Object.assign(settings.attributes, {
          hideOnDesktop: {
            type: 'boolean',
          },
          hideOnTablet: {
            type: 'boolean',
          },
          hideOnMobile: {
            type: 'boolean',
          },
        });
      }
    }

    return settings;
  }
);

const visibilityInspectorControl = createHigherOrderComponent((BlockEdit) => {
  const Wrapped = (props) => {
    const attributes = props.attributes || {};
    const {
      hideOnDesktop = false,
      hideOnTablet = false,
      hideOnMobile = false,
    } = attributes;

    const inspector =
      props.isSelected && visibilityBlocks.includes(props.name)
        ? createElement(
            InspectorControls,
            null,
            createElement(
              PanelBody,
              {
                icon: 'visibility',
                title: __('Visibility', 'base-theme'),
                initialOpen: false,
              },
              createElement(ToggleControl, {
                checked: !!hideOnDesktop,
                label: __('Hide on desktop', 'base-theme'),
                onChange: () =>
                  props.setAttributes({ hideOnDesktop: !hideOnDesktop }),
              }),
              createElement(ToggleControl, {
                checked: !!hideOnTablet,
                label: __('Hide on tablet', 'base-theme'),
                onChange: () =>
                  props.setAttributes({ hideOnTablet: !hideOnTablet }),
              }),
              createElement(ToggleControl, {
                checked: !!hideOnMobile,
                label: __('Hide on mobile', 'base-theme'),
                onChange: () =>
                  props.setAttributes({ hideOnMobile: !hideOnMobile }),
              })
            )
          )
        : null;

    return createElement(
      Fragment,
      null,
      createElement(BlockEdit, props),
      inspector
    );
  };

  Wrapped.displayName = 'VisibilityInspectorControl';
  return Wrapped;
}, 'visibilityInspectorControl');

wp.hooks.addFilter(
  'editor.BlockEdit',
  'devwp/visibility-inspector-control',
  visibilityInspectorControl
);

wp.hooks.addFilter(
  'blocks.getSaveContent.extraProps',
  'devwp/add-visibility-classes',
  (extraProps, blockType, attributes) => {
    const { hideOnDesktop, hideOnTablet, hideOnMobile } = attributes;

    if (typeof hideOnMobile !== 'undefined' && hideOnMobile) {
      extraProps.className = extraProps.className + ' hide-on-mobile';
    }

    if (typeof hideOnTablet !== 'undefined' && hideOnTablet) {
      extraProps.className = extraProps.className + ' hide-on-tablet';
    }

    if (typeof hideOnDesktop !== 'undefined' && hideOnDesktop) {
      extraProps.className = extraProps.className + ' hide-on-desktop';
    }

    return extraProps;
  }
);
