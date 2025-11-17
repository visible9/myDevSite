<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'accordion-item',
    $block['className'] ?? '',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));
$arrow_icon = asset_path('images/icons/arrow-down.svg');
$title = $fields['title'] ?? __('Item title', 'base-theme');
$template = [
    ['core/paragraph', [
        'placeholder' => 'Add item content...',
    ]],
];
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
>
    <div class="accordion-title">
        <?php echo esc_html($title); ?>
        <?php echo file_get_contents($arrow_icon); ?>
    </div>
    <div class="accordion-content">
        <div class="accordion-content__inner">
            <?php echo '<InnerBlocks template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
        </div>
    </div>
</div>
