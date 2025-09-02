<?php
/**
 * Page.
 */
get_header(); ?>

<main class="main-content">
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) {
            the_post(); ?>
            <article <?php post_class(); ?>>
                <?php the_content('', true); ?>
            </article>
        <?php } ?>
    <?php } ?>
</main>

<?php get_footer(); ?>
