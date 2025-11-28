<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'acf-tabs',
    'js-acf-tabs',
    $block['className'] ?? '',
    $is_preview ? 'is-editor' : '',
    !empty($block['align']) ? 'align' . esc_attr($block['align']) : 'alignnone',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));

$allowed_blocks = ['acf/tabs-item'];
$template = [['acf/tabs-item']];
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
>
    <div class="tabs-nav"></div>
    <div class="tabs-panels">
        <?php
        echo '
            <InnerBlocks
                allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '"
                template="' . esc_attr(wp_json_encode($template)) . '"
            />
        ';
        ?>
    </div>
</div>
