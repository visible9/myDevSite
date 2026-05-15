<?php
/**
 * @var array  $block
 * @var string $content
 * @var bool   $is_preview
 * @var int    $post_id
 * @var array  $fields
 */
$classes = [
    'acf-popup-button',
    'js-acf-popup-button',
    $block['className'] ?? '',
    $is_preview ? 'is-editor' : '',
];
$classes_string = implode(' ', array_filter($classes));
$popup_id       = 'popup-' . ($block['id'] ?? uniqid());
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
>
    <button class="popup-button__btn" data-popup-id="<?php echo esc_attr($popup_id); ?>">
        <?php _e('Открыть', 'base-theme'); ?>
    </button>

    <div class="popup-button__overlay" id="<?php echo esc_attr($popup_id); ?>" aria-hidden="true">
        <div class="popup-button__dialog" role="dialog" aria-modal="true">
            <button class="popup-button__close" aria-label="<?php esc_attr_e('Закрыть', 'base-theme'); ?>">&times;</button>
            <p class="popup-button__text"><?php _e('привет я блок', 'base-theme'); ?></p>
        </div>
    </div>
</div>

