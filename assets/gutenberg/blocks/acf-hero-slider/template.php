<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'acf-hero-slider',
    'js-acf-hero-slider',
    !empty($block['align']) ? 'align' . esc_attr($block['align']) : 'alignnone',
    $block['className'] ?? '',
    $is_preview ? 'is-editor' : '',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));

$allowed_blocks = ['acf/hero-slide'];
$template = [['acf/hero-slide']];

$hero_slider_effect = $fields['hero_slider_effect'] ?? 'fade';
$autoplay_field = $fields['hero_slider_autoplay'];
$autoplay_enabled = filter_var($autoplay_field, FILTER_VALIDATE_BOOLEAN);
$swiper_speed = (int) $fields['hero_slider_speed'] ?: 1000;
$hero_slider_delay = (int) $fields['hero_slider_delay'] ?: 5000;
$hero_slider_overlay = $fields['hero_slider_overlay'] ?? false;
$hero_slider_overlay_color = $hero_slider_overlay ? $fields['hero_slider_overlay_color'] : 'transparent';

$hero_slider_navigation = $fields['hero_slider_navigation'];
$show_arrows = in_array('arrow', $hero_slider_navigation);
$show_dots = in_array('dots', $hero_slider_navigation);
$swiper_options = [
    'speed' => $swiper_speed,
    'effect' => $hero_slider_effect,
    'navigation' => $show_arrows,
    'pagination' => $show_dots,
];


$swiper_options = [
    'speed' => $swiper_speed,
    'effect' => $hero_slider_effect,
];


if ($autoplay_enabled) {
    $swiper_options['autoplay'] = [
        'delay' => $hero_slider_delay,
    ];
} else {
    $swiper_options['autoplay'] = false;
}
?>

<div <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    style="--overlay-color: <?php echo $hero_slider_overlay_color; ?>"
    class="<?php echo esc_attr($classes_string); ?>"
    data-swiper-options='<?php echo wp_json_encode($swiper_options); ?>'>
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php echo '
            <InnerBlocks
            orientation="horizontal"
            allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" /> ';
            ?>
        </div>
        <?php if ($show_dots) : ?>
            <div class="swiper-pagination"></div>
        <?php endif; ?>
        <?php if ($show_arrows) : ?>
            <div class="swiper-button-prev swiper-button"></div>
            <div class="swiper-button-next swiper-button"></div>
        <?php endif; ?>

    </div>
</div>
