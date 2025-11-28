<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'tabs-panel',
    $block['className'] ?? '',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));
$title = $fields['tab_title'] ?? __('Tab title', 'base-theme');
$template = [
    [
        'core/paragraph',
        [
            'placeholder' => __('Add tab content...', 'base-theme'),
        ],
    ],
];
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
    data-tab-title="<?php echo esc_html($title); ?>"
>
    <div class="tabs-panel__title">
        <?php echo esc_html($title); ?>
    </div>
    <div class="tabs-panel__content">
        <?php echo '<InnerBlocks template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
    </div>
</div>
