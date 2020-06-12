
<div class="site-info">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
	<a href="<?php echo esc_url( __( 'https://ffflabel.com/', 'cfood' ) ); ?>" class="imprint">
		<?php printf( __( 'Proudly powered by %s', 'cfood' ), 'White Label' ); ?>
	</a>
</div><!-- .site-info -->
