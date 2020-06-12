<?php

/**@var  $project Place */

use Entity\Place;
use Inc\General;
use Service\Helpers;

get_header(); ?>

    <div class="container">
        <div class="row" id="projects-wrapper">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post();
                    $post_id = get_the_ID(); ?>
                    <?php $link= get_permalink( $post_id); ?>
                    <div <?php post_class('col-12 col-sm-12 col-md-6 col-lg-4 project-item-block'); ?> >
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'project-main' ); ?>
                        <div class="project-item-image-block">
                            <img src="<?php echo $image[0]; ?>" alt="none" class="project-item-image">
                        </div>
                        <div class="">
                            <a href="<?php echo $link ?>">
                                <h3><?php print get_the_title($post_id); ?></h3>
                            </a>
                        </div>
                        <div class="project-atributes">
                            <p>
                                <?php $post_tags = get_the_terms( $post_id,  Place::$MACHINE_NAME . '-type' );
                                if ( ! empty( $post_tags ) && ! is_wp_error( $post_tags ) ) :
                                    $post_tags = join(', ', wp_list_pluck($post_tags, 'name'));
                                    print $post_tags;
                                endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
        <div class="row justify-content-center mt-3">

            <button class="button-call-fill" id="projects-load-more"><?php echo __( 'POKAŻ WIĘCEJ', 'cboost' ); ?><i class="icon-right-arrow ml-3"></i></button>

        </div>
    </div>

<?php

get_footer();
