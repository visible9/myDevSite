/* global globalData */
const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, ToggleControl } = wp.components;
const { createHigherOrderComponent } = wp.compose;
const { createElement, Fragment } = wp.element;

const acfBlocks = Object.keys(globalData?.acfBlocks.length > 0)
  ? Object.keys(globalData.acfBlocks)
  : [];

wp.hooks.addFilter(
  'blocks.registerBlockType',
  'devwp/add-content-width-attribute',
  (settings, name) => {
    if (
      typeof settings.attributes !== 'undefined' &&
      acfBlocks.includes(name)
    ) {
      settings.attributes = Object.assign(settings.attributes, {
        useContentWidth: {
          type: 'boolean',
          default: false,
        },
      });
    }

    return settings;
  }
);

const contentWidthInspectorControl = createHigherOrderComponent((BlockEdit) => {
  const Wrapped = (props) => {
    if (!acfBlocks.includes(props.name)) {
      return createElement(BlockEdit, props);
    }

    const { useContentWidth = false } = props.attributes || {};

    const inspector = props.isSelected
      ? createElement(
          InspectorControls,
          null,
          createElement(
            PanelBody,
            {
              icon: 'align-center',
              title: __('Layout', 'base-theme'),
              initialOpen: true,
            },
            createElement(ToggleControl, {
              checked: !!useContentWidth,
              label: __('Use content width', 'base-theme'),
              onChange: () =>
                props.setAttributes({ useContentWidth: !useContentWidth }),
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

  Wrapped.displayName = 'ContentWidthInspectorControl';
  return Wrapped;
}, 'contentWidthInspectorControl');

wp.hooks.addFilter(
  'editor.BlockEdit',
  'devwp/content-width-inspector-control',
  contentWidthInspectorControl
);
