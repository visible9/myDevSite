<?php
/**
 * @var array $block
 * @var string $content
 * @var bool $is_preview
 * @var int $post_id
 * @var array $fields contains all ACF fields
 */
$classes = [
    'hero-slide',
    'swiper-slide',
    'skip-lazy',
    'bg-cover',
    $block['className'] ?? '',
    function_exists('get_acf_block_visibility_classes') ? get_acf_block_visibility_classes($block) : '',
];
$classes_string = implode(' ', array_filter($classes));
$bg_image = $fields['background'] ?? '';
$video_url = $fields['video_url'] ?? '';
$template = [
    ['core/paragraph', [
        'placeholder' => 'Add slide content...',
    ]],
];
?>

<div
    <?php echo !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '"' : ''; ?>
    class="<?php echo esc_attr($classes_string); ?>"
    <?php bg($bg_image, 'full_hd'); ?>
>
    <?php
    if (!empty($video_url)) {
        echo '<div class="hero-slide__video-overlay">';

        if (preg_match('/(youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $matches)) { // YouTube
            $id = isset($matches[2]) ? $matches[2] : '';
            if ($id) {
                echo '<iframe src="https://www.youtube.com/embed/' . $id . '?autoplay=1&mute=1&loop=1&playlist=' . $id . '&controls=0&showinfo=0&rel=0" frameborder="0" allow="autoplay; fullscreen"></iframe>';
            }
        } else if (preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches)) { // Vimeo
            $id = isset($matches[1]) ? $matches[1] : '';
            if ($id) {
                echo '<iframe src="https://player.vimeo.com/video/' . $id . '?autoplay=1&loop=1&autopause=0&muted=1&background=1" frameborder="0" allow="autoplay; fullscreen"></iframe>';
            }
        } else {
            // Local video
            $ext = pathinfo($video_url, PATHINFO_EXTENSION);
            echo '<video autoplay muted loop playsinline><source src="' . esc_url($video_url) . '" type="video/' . $ext . '"></video>';
        }


        echo '</div>';
    }
    ?>

    <div class="hero-slide__inner">
        <?php echo '<InnerBlocks template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
    </div>
</div>
