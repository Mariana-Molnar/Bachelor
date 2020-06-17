<?php

/**@var  $project Place */

use Entity\Place;
use Entity\Place\PlaceRepository;
use Inc\General;
use Service\Helpers;

$filters = PlaceRepository::getAllTerms(Place::$MACHINE_NAME . '-type', '');
get_header(); ?>

<?php $mainPost =  get_field('main_place', 'option'); ?>

	<section class="hero-image-section event-hero-image" style="background-image: url('<?php the_field('main_place_image', 'option');?>')">
		<div class="main-title">
			<h1><?php echo get_the_title($mainPost)?></h1>
		</div>
	</section>

	<section class="mt-3 portfolio-main-block">
		<div class="container filter-block mb-4 text-center">
			<h2><?php echo __('Фільтрувати:', 'cfood') ?></h2>
			<form id="project-filters-wrapper" data-project_name="<?php print Place::$MACHINE_NAME;?>">
				<div class="custom-control custom-checkbox custom-control-inline">
					<input type="checkbox" class="custom-control-input project-filter-checkbox" id="<?php print Place::$MACHINE_NAME . '-type-all';?>" name="checkbox1" checked>
					<label class="custom-control-label" for="<?php print Place::$MACHINE_NAME . '-type-all';?>"><?php echo __('Всі', 'cboost') ?></label>
				</div>

				<?php foreach ($filters as $filter_term): ?>
					<?php if (have_rows('filter_label',$filter_term)) : ?>
						<?php while (have_rows('filter_label',$filter_term)) :
							the_row();
							$filter_label = get_sub_field('title',$filter_term); ?>
						<?php endwhile; ?>
					<?php elseif(!have_rows('filter_label',$filter_term)): $filter_label =  $filter_term->name;
					endif ;?>
					<div class="custom-control custom-checkbox custom-control-inline">
						<input type="checkbox" class="custom-control-input project-filter-checkbox" id="<?php print Place::$MACHINE_NAME . '-type-' .  $filter_term->slug?>" name="checkbox2">
						<label class="custom-control-label" for="<?php print Place::$MACHINE_NAME . '-type-' .  $filter_term->slug?>"><?php echo $filter_label; ?></label>
					</div>

				<?php endforeach; ?>
			</form>
		</div>

		<div class="container">
			<div class="row" id="projects-wrapper">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post();
						$post_id = get_the_ID(); ?>
						<?php $link= get_permalink( $post_id); ?>
						<div <?php post_class('col-md-3 my-4 project-item-block event-item-block'); ?> >
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'project-main' ); ?>
							<div class="project-item-image-block event-item-image-block">
								<img src="<?php echo $image[0]; ?>" alt="none" class="project-item-image">
							</div>
							<div class="event-item-title-block">
								<a href="<?php echo $link ?>">
									<h2><?php print get_the_title($post_id); ?></h2>
								</a>
							</div>
							<div class="row project-atributes ">
								<p>
									<?php $post_tags = get_the_terms( $post_id, Place::$MACHINE_NAME . '-type' );
									if ( ! empty( $post_tags ) && ! is_wp_error( $post_tags ) ) :
										foreach ($post_tags as $post_tag):
											echo $post_tag->name;
										endforeach;
									endif; ?>
								</p>
							</div>
							<div class="event-item-excerpt-block">
								<p><?php echo get_the_excerpt($post_id);?></p>
							</div>
						</div>
					<?php endwhile;
				endif; ?>
			</div>
			<div class="row justify-content-center mt-3">
				<button class="button-call-fill btn-classic" id="projects-load-more"><?php echo __( 'Всі публікації', 'cboost' ); ?><i class="icon-right-arrow ml-3"></i></button>
			</div>
		</div>
	</section>

<?php

get_footer();
