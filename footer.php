<?php
/**
 * Footer.
 */
?>

<!-- BEGIN of footer -->
<footer class="footer is-root-container">
    <div class="footer__top">
        <div class="footer__logo">
            <?php if ($footer_logo = get_field('footer_logo', 'options')) {
                echo wp_get_attachment_image($footer_logo['id'], 'medium');
            } else {
                show_custom_logo();
            } ?>
        </div>
        <?php if (has_nav_menu('footer-menu')) {
            wp_nav_menu(['theme_location' => 'footer-menu', 'menu_class' => 'footer-menu', 'depth' => 1]);
        } ?>
        <?php if (!empty(get_field('socials', 'options'))) { ?>
            <div class="footer__sp">
                <?php show_template('socials'); // Social profiles?>
            </div>
        <?php } ?>
    </div>

    <?php if ($copyright = get_field('copyright', 'options')) { ?>
        <div class="footer__copy">
            <?php echo $copyright; ?>
        </div>
    <?php } ?>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
