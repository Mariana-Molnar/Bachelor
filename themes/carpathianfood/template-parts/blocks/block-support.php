<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

?>
<section class="container support-block">
	<div class="row align-items-center">
		<div class="col-md-6 support-diagram-block">
			<h3><?php _e('So setzt sich der <br> Strompreis zusammen:','cfood'); ?></h3>
			<div class="diagram-bar-block">
				<div class="first-bar">
					<img src="<?php echo get_template_directory_uri()?>/assets/images/bar-1.png" alt="bar">
					<p><?php _e('andere  Stromanbieter','cfood'); ?></p>
				</div>
				<div class="bar-description">
					<div class="color-lines-left">
						<span class="green"></span>
					</div>
					<div class="diagram-text">
						<p style="margin-top: 0; line-height: 14px;"><?php _e('20 € <br> Unterstützung <br> pro Jahr','cfood'); ?></p>
						<p style="margin-top: 25px;"><?php _e('Werbekosten','cfood'); ?></p>
						<p style="margin-top: 75px;"><?php _e('Stromkosten','cfood'); ?></p>
					</div>
					<div class="color-lines-right">
						<span class="green"></span>
					</div>
				</div>
				<div class="second-bar">
					<img class="bar-text" src="<?php echo get_template_directory_uri()?>/assets/images/bar-2-text-crop.png" alt="">
					<img class="bar-none_text" src="<?php echo get_template_directory_uri()?>/assets/images/bar-2.png" alt="">
					<p><?php _e('Vereinsstrom','cfood'); ?></p>
				</div>
			</div>
		</div>

		<div class="col-md-6 support-description-block">
			<?php print get_field('support_content'); ?>
		</div>
	</div>
</section>