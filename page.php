<?php
/**
 * Page.
 */
get_header(); ?>

<main class="main-content">
    <div class="is-root-container">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content('', true);
            }
        } ?>
    </div>
</main>

<?php get_footer(); ?>
