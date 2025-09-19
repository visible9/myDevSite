//---------------Helper Function---------------//
function registerFormat(
  name,
  label,
  icon = 'block-default',
  namespace = 'devwp'
) {
  const { registerFormatType, toggleFormat } = wp.richText;
  const { RichTextToolbarButton } = wp.blockEditor || wp.editor;

  registerFormatType(namespace + '/' + name, {
    title: label,
    tagName: 'span',
    className: name,
    edit: function (props) {
      return wp.element.createElement(RichTextToolbarButton, {
        icon: icon,
        isActive: props.isActive,
        title: label,
        onClick: function () {
          props.onChange(
            toggleFormat(props.value, {
              type: namespace + '/' + name,
            })
          );
        },
      });
    },
  });
}

//--------------- Register Custom Format Types ---------------//
registerFormat('example-format', wp.i18n.__('Example Format', 'base-theme'));
