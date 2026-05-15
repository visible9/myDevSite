<?php
/**
 * @var array  $block
 * @var string $content
 * @var bool   $is_preview
 * @var int    $post_id
 * @var array  $fields
 */
$classes = [
    'acf-two-images',
    $block['className'] ?? '',
    $is_preview ? 'is-editor' : '',
    !empty($block['align']) ? 'align' . esc_attr($block['align']) : 'alignnone',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
    function_exists('get_acf_block_content_width_class') ? get_acf_block_content_width_class($block) : '',
];
$classes_string = implode(' ', array_filter($classes));

?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
>
    <?php echo '<InnerBlocks />'; ?>
</div>
