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

$title = $fields['title'] ?? __('Item title', 'block-theme');
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
    </div>
    <div class="accordion-content">
        <div class="accordion-content__inner">
            <?php echo '<InnerBlocks template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
        </div>
    </div>
</div>
