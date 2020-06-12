<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container site-info">
            <div class="footer-blocks">
                <div class="site-branding footer-logo">
                    <?php the_custom_logo(); ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </div><!-- .site-branding -->

                <div>
                    <p>Ми у соцмережах:</p>
                    <?php echo do_shortcode('[addtoany]')?>
                </div>

            </div>

		</div><!-- .site-info -->
        <div class="copyright">
            <div class="container copyright-block">
                <div class="copyright-text-block">
                    <p class=""><?php echo __( '© 2020 Carpathian food', 'cfood' ); ?></p>
                </div>
            </div>
        </div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
