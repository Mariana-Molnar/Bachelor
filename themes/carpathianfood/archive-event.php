<?php
/**@var  $project Event */

use Entity\Event;
use Entity\Event\EventRepository;
use Inc\General;
use Service\Helpers;

//if (have_posts()): the_post();
//    $events = \Entity\Event\EventRepository::getAll();
    $filters = EventRepository::getAllTerms(Event::$MACHINE_NAME . '-type', '');
get_header(); ?>

<?php $mainPost =  get_field('main_event', 'option'); ?>

<section class="hero-image-section event-hero-image" style="background-image: url('<?php echo get_the_post_thumbnail_url($mainPost)?>')">
    <div class="main-title">
        <h1><?php echo get_the_title($mainPost)?></h1>
    </div>
</section>

<section class="container my-4">
    <div class="filter-block mb-4 text-center">
        <h2><?php echo __('Filter:', 'cfood') ?></h2>
        <form id="project-filters-wrapper" data-project_name="<?php print Event::$MACHINE_NAME;?>">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input project-filter-checkbox" id="<?php print Event::$MACHINE_NAME . '-type-all';?>" name="checkbox1" checked>
                <label class="custom-control-label" for="<?php print Event::$MACHINE_NAME . '-type-all';?>"><?php echo __('All', 'cfood') ?></label>
            </div>

            <?php foreach ($filters as $filter_term): ?>
                <?php if (have_rows('filter_label',$filter_term)) : ?>
                    <?php while (have_rows('filter_label',$filter_term)) :
                        the_row();?>
                            <?php $filter_label = get_sub_field('title',$filter_term); ?>
                    <?php endwhile; ?>
                <?php elseif(!have_rows('filter_label',$filter_term)): $filter_label =  $filter_term->name;
                endif ;?>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input project-filter-checkbox" id="<?php print Event::$MACHINE_NAME . '-type-' .  $filter_term->slug?>" name="checkbox2">
                    <label class="custom-control-label" for="<?php print Event::$MACHINE_NAME . '-type-' .  $filter_term->slug?>"><?php echo $filter_label; ?></label>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
</section>

<section class="container">
    <div class="row" id="projects-wrapper">
<!--         --><?php //foreach ($events as $event):
//         $link= get_permalink( $event->id); ?>
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();
        $post_id = get_the_ID(); ?>
        <?php $link= get_permalink( $post_id); ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'project-main' ); ?>
        <div class="col-md-3 my-4 event-item-block">
            <div class="event-item-image-block">
                <a href="<?php echo  $link; ?>" ><img src="<?php echo $image[0]; ?>" alt="none" class="event-item-image"></a>
            </div>
            <div class="event-item-title-block">
                <a href="<?php echo  $link; ?>" class="event-item-title"><h2><?php echo get_the_title($post_id)?></h2></a>
            </div>
            <div class="project-atributes">
                <p>
                    <?php $post_tags = get_the_terms( $post_id,  Event::$MACHINE_NAME . '-type' );
                    if ( ! empty( $post_tags ) && ! is_wp_error( $post_tags ) ) :
                        $post_tags = join(', ', wp_list_pluck($post_tags, 'name'));
                        print $post_tags;
                    endif; ?>
                </p>
            </div>
            <div class="event-item-excerpt-block">
                <p><?php echo get_the_excerpt($post_id);?></p>
            </div>
        </div>
<!--         --><?php //endforeach;?>
        <?php endwhile;
    endif; ?>
    </div>
    <div class="row justify-content-center mt-3">
        <button class="button-call-fill" id="projects-load-more"><?php echo __( 'POKAŻ WIĘCEJ', 'cboost' ); ?><i class="icon-right-arrow ml-3"></i></button>
    </div>
</section>


<?php
//endif;
get_footer(); ?>