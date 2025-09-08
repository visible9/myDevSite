<?php
/**
 * Template Name: Example Template.
 */
get_header(); ?>

<!-- BEGIN of main content -->
<main class="main-content">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content('', true);
        }
    }
    ?>
</main>
<!-- END of main content -->

<?php get_footer(); ?>
