<?php
/**
 * Footer.
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
    <?php if ($copyright = get_field('copyright', 'options')) { ?>
        <div class="footer__copy">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell ">
                        <?php echo $copyright; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
