<?php
/**
 * Single.
 *
 * Loop container for single post content
 */
get_header(); ?>

<main class="main-content">
    <div class="is-root-container">
        <div class="blog">
            <div class="blog__outer">
                <!-- BEGIN of post content -->
                <?php if (have_posts()) { ?>
                    <div class="blog__inner">
                        <?php while (have_posts()) {
                            the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                                <h1 class="entry__title"><?php the_title(); ?></h1>
                                <?php if (has_post_thumbnail()) { ?>
                                    <div title="<?php the_title_attribute(); ?>" class="entry__thumb">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php } ?>
                                <p class="entry__meta"><?php echo sprintf(__('Written by %s on %s', 'base-theme'), get_the_author_posts_link(), get_the_time(get_option('date_format'))); ?></p>
                                <div class="entry__content">
                                    <?php the_content('', true); ?>
                                </div>
                                <h6 class="entry__cat"><?php _e('Posted Under: ', 'base-theme'); ?><?php the_category(', '); ?></h6>
                                <?php comments_template(); ?>
                            </article>
                        <?php } ?>
                    </div>
                <?php } ?>
                <!-- END of post content -->

                <!-- BEGIN of sidebar -->
                <div class="blog__sidebar">
                    <?php get_sidebar('right'); ?>
                </div>
                <!-- END of sidebar -->
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
