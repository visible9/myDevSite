<?php
/**
 * Index.
 *
 * Standard loop for the search result page
 */
get_header(); ?>

<main class="main-content">
    <div class="is-root-container">
        <div class="search">
            <h1 class="search__title">
                <?php printf(__('Search Results for: %s', 'base-theme'), '<span>' . esc_html(get_search_query()) . '</span>'); ?>
            </h1>
            <?php get_search_form(); ?>
            <!-- BEGIN of search results -->
            <div class="search__list">
                <?php if (have_posts()) { ?>
                    <?php while (have_posts()) {
                        the_post(); ?>
                        <?php show_template('loop-post'); // Post item?>
                    <?php } ?>
                <?php } else { ?>
                    <p>
                        <?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'base-theme'); ?>
                    </p>
                <?php } ?>
                <!-- BEGIN of pagination -->
                <?php theme_pagination(); ?>
                <!-- END of pagination -->
            </div>
            <!-- END of search results -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
