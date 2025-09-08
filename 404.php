<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
get_header(); ?>

<!-- BEGIN of 404 page -->
<main class="main-content">
    <div class="is-root-container not-found">
        <h1><?php _e('404: Page Not Found', 'base-theme'); ?></h1>
        <h2><?php _e('Keep on looking...', 'base-theme'); ?></h2>
        <p>
            <?php printf(
                __('Double check the URL or head back to the <a class="label" href="%1s">HOMEPAGE</a>', 'base-theme'),
                get_bloginfo('url')
            ); ?>
        </p>
    </div>
</main>
<!-- END of 404 page -->

<?php get_footer(); ?>
