<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'acf-accordion',
    'js-acf-accordion',
    $block['className'] ?? '',
    $is_preview ? 'is-editor' : '',
    !empty($block['align']) ? 'align' . esc_attr($block['align']) : 'alignnone',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));

$multiple_extended = $fields['multiple_extended'] ?? false;
$selected_element = $fields['selected_element'] ?? '-1';
$allowed_blocks = ['acf/accordion-item'];
$template = [
    ['acf/accordion-item'],
];
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
    data-multiple-extended="<?php echo $multiple_extended; ?>"
    data-selected-element="<?php echo esc_attr($selected_element); ?>"
>
    <?php
    echo '
        <InnerBlocks
            allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '"
            template="' . esc_attr(wp_json_encode($template)) . '"
        />
    ';
    ?>
</div>
