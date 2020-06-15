<?php
/**
 * Template Name: About us
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
    die( 'No direct script access allowed' );
}

get_header();


if ( have_posts() ) :  the_post();

?>

	<section class="contact-main-block">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6">
					<h1><?php echo __('Зв\'яжіться з нами! ', 'cfood') ?></h1>
					<div  class="contact-wrap-block">
						<div class="contact-background"></div>
						<div class="contact-info-block">
							<div class="row meet-block">
								<div class="col-2 col-md-2"><i class="icon-map"></i></div>
								<p class="col-10 col-md-10"><?php echo __('Ми знаходимося в Ужгороді', 'cfood') ?></p>
							</div>
							<h2><?php echo __('Наші контакти:', 'cfood') ?></h2>
							<div class="contact-info-item">
								<i class="icon-coffee-black"></i>
								<p><?php the_field('work_time', 'option'); ?></p>
							</div>
							<div class="contact-info-item">
								<i class="icon-location-black"></i>
								<p><?php the_field('location', 'option'); ?></p>
							</div>
							<div class="contact-info-item">
								<i class="icon-mail-black"></i>
								<p><?php the_field('mail', 'option'); ?></p>
							</div>
							<div class="contact-info-item">
								<i class="icon-phone-black" style="color: #000;"></i>
								<p><?php the_field('phone', 'option'); ?></p>
							</div>
							<div class="contact-info-item contact-info-description">
								<p class=""><?php the_field('company_info', 'option'); ?></p>
							</div>
						</div>
					</div>
					<div style="clear: both"></div>
				</div>
				<div class="col-12 col-md-6">
					<h1><?php echo __('Повідомлення:', 'cfood') ?></h1>
					<div class="mail-block">
						<?php echo do_shortcode('[contact-form-7 id="332" title="send_message"]') ?>
					</div>
					<div style="clear: both"></div>
				</div>
			</div>
		</div>
	</section>

<?php
endif; // End of the loop.

get_footer();