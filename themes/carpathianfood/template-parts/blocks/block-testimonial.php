<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}


?>

<section class="container testimonial-block">
	<div class="row justify-content-center">
		<?php if ($message = get_field('testimonial_message')): ?>
			<div class="col-12 col-md-6 testimonial-comment-block">
				<div class="testimonial-comment">
					<?php if ($avatar = get_field('testimonial_author_avatar')): ?>
						<div class="testimonial-circle-image" style="background-image: url('<?php print $avatar['url']; ?>');"></div>
					<?php endif; ?>
					<p>„<?php print $message; ?>“</p>
				</div>
				<?php if ($author = get_field('testimonial_author')): ?>
					<div class="testimonial-author">
						<p><?php print $author; ?></p>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="col-12 col-md-5">
			<div class="row testimonial-icons-block">
				<div class="col-6 col-md-6">
					<p><?php _e('15 STROMVERTRÄGE','cfood'); ?></p>
					<img  src="<?php echo get_template_directory_uri()?>/assets/images/crowd.png" alt="">
				</div>
				<div class="col-2 col-md-2 equal-icon-block">
					<span class="equal-icon"></span>
				</div>
				<div class="col-4 col-md-4">
					<p><?php _e('300 € / Jahr','cfood'); ?></p>
					<img  src="<?php echo get_template_directory_uri()?>/assets/images/bonus.png" alt="">
				</div>
			</div>
			<div class="testimonial-description-block">
				<p><?php _e('Aktuell sind 15 Mitglieder des TSV Schott Mainz dabei. Der Verein erhält dafür jedes Jahr eine Unterstützung in Höhe von 300 €.','cfood'); ?></p>
			</div>
		</div>
	</div>
</section>
