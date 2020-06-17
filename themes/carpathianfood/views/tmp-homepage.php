<?php
/**
 * Template Name:  Homepage
 */

// Prevent direct script access.
if (!defined('ABSPATH')) {
	die('No direct script access allowed');
}

get_header();
if (have_posts()): the_post();
	$events = \Entity\Event\EventRepository::getLatest(4);
	?>
	<section class="hero-image-section" style="background-image: url('<?php the_field('header_image') ?>')">
		<div class="main-title">
			<h1><?php the_field('header_title') ?></h1>
			<h2><?php the_field('header_subtitle') ?></h2>
		</div>
	</section>

	<section class="container offer-block">
		<!--        <div class="offer-block-title">-->
		<!--            <h3>--><?php //the_field('offer_block_title'); ?><!--</h3>-->
		<!--        </div>-->
		<div class="row my-4 justify-content-around">
			<?php if (have_rows('offer_block')) : ?>
				<?php while (have_rows('offer_block')) :
					the_row(); ?>
					<div class="col-md-3 col-10 offer-item-block ">
						<div class="offer-item-image-block <?php echo get_sub_field('offer_item_color') ?>">
							<img src="<?php echo get_sub_field('offer_item_image') ?>" alt="">
						</div>
						<h4><?php the_sub_field('offer_item_title'); ?></h4>
						<p class="mt-2"><?php the_sub_field('offer_item_description'); ?> </p>
						<?php $link = get_sub_field('offer_item_link') ?>
						<a href="<?php echo $link['url']; ?>" class="btn-classic"><?php echo $link['title']; ?></a>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section>

	<section class=" testimonial-block ">
		<div class="container">
			<div class="testimonial-comment">
				<div class="testimonial-autor">
					<img src="<?php echo get_template_directory_uri() ?>/assets/images/quotes.svg" alt="" class="quotes">
					<span><?php the_field('testimonial_author') ?></span>
				</div>
				<p><?php the_field('testimonial_comment') ?></p>
				<img src="<?php echo get_field('testimonial_author_image') ?>" alt="" class="testimonial-autor-image">
			</div>
		</div>
	</section>

	<section class=" slogan-block" style="background-image: url('<?php the_field('slogan_block_image') ?>;">
		<div class="slogan-title">
			<h1><?php the_field('slogan_block_title') ?></h1>
			<h2><?php the_field('header_subtitle') ?></h2>
		</div>
	</section>

	<section class="container mb-4 recent-event-block">
		<div class="offer-block-title">
			<h3><?php echo __('Актуальні події', 'cfood') ?></h3>
		</div>
		<div class="row justify-content-between align-items-baseline">
			<?php foreach ($events as $event):
				$link = get_permalink($event->id); ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($event->id), 'project-main'); ?>
				<div class="col-md-3 event-item-block">
					<div class="event-item-image-block">
						<a href="<?php echo $link; ?>"><img src="<?php echo $image[0]; ?>" alt="none" class="event-item-image"></a>
					</div>
					<div>
						<a href="<?php echo $link; ?>" class="event-item-title"><h2><?php echo $event->title ?></h2></a>
					</div>
					<div class="event-item-excerpt-block">
						<p><?php echo $event->excerpt ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

<?php
endif;
get_footer();