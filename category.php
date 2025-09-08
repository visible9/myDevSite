<?php
/**
 * Category.
 *
 * Standard loop for the category page
 */
get_header(); ?>

<main class="main-content">
    <div class="is-root-container">
        <div class="blog">
            <h1 class="blog__title blog__title--archive">
                <?php echo get_the_archive_title(); ?>
            </h1>
            <div class="blog__outer">
                <!-- BEGIN of Archive Content -->
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
                <!-- END of Archive Content -->
                <!-- BEGIN of Sidebar -->
                <div class="blog__sidebar">
                    <?php get_sidebar('right'); ?>
                </div>
                <!-- END of Sidebar -->
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
