<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'acf-example',
    'js-acf-example',
    $block['className'] ?? '',
    $is_preview ? 'is-editor' : '',
    !empty($block['align']) ? 'align' . esc_attr($block['align']) : 'alignnone',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));

$test_buttons = function_exists('render_gutenberg_buttons') ? render_gutenberg_buttons([
    [
        'title' => 'Test Button',
        'url' => '#',
        'target' => '_blank',
        'attrs' => [
            'data-example' => 'test',
        ],
    ],
    [
        'title' => 'Test Button 2',
        'url' => '#',
        'type' => 'secondary',
    ],
], 'example-button-wrapper') : '';
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
>
    <div class="inner">
        <h2><?php _e('Example Block', 'base-theme'); ?></h2>
        <?php echo $test_buttons; ?>
    </div>
</div>
