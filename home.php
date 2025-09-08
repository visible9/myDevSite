<?php
/**
 * Home.
 *
 * Standard loop for the blog-page
 */
get_header(); ?>

<main class="main-content">
    <div class="is-root-container">
        <div class="blog">
            <h1 class="blog__title">
                <?php echo get_the_title(); ?>
            </h1>
            <div class="blog__outer">
                <!-- BEGIN of Blog posts -->
                <div class="blog__inner">
                    <?php if (have_posts()) { ?>
                        <?php while (have_posts()) {
                            the_post(); ?>
                            <?php show_template('loop-post'); // Post item?>
                        <?php } ?>
                    <?php } ?>
                    <!-- BEGIN of pagination -->
                    <?php theme_pagination(); ?>
                    <!-- END of pagination -->
                </div>
                <!-- END of Blog posts -->

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
