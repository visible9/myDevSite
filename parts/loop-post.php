<!-- BEGIN of Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class('preview preview--' . get_post_type()); ?>>
    <?php if (has_post_thumbnail()) { ?>
        <div class="">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('medium', ['class' => 'preview__thumb']); ?>
            </a>
        </div>
    <?php } ?>
    <div class="">
        <h3 class="preview__title">
            <a href="<?php the_permalink(); ?>"
               title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'base-theme'), the_title_attribute('echo=0'))); ?>"
               rel="bookmark"><?php echo get_the_title() ?: __('No title', 'base-theme'); ?>
            </a>
        </h3>
        <?php if (is_sticky()) { ?>
            <span class="secondary label preview__sticky"><?php _e('Sticky', 'base-theme'); ?></span>
        <?php } ?>
        <div class="preview__excerpt">
            <?php the_excerpt(); // Use wp_trim_words() instead if you need specific number of words?>
        </div>
        <p class="preview__meta"><?php echo sprintf(__('Written by %s on %s', 'base-theme'), get_the_author_posts_link(), get_the_time(get_option('date_format'))); ?></p>
    </div>
</article>
<!-- END of Post -->
