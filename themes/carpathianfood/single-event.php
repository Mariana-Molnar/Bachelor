<?php
use Inc\General;

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
    die( 'No direct script access allowed' );
}

get_header();

if ( have_posts() ):
    while ( have_posts() ):
        the_post();

$id = get_the_ID();
?>
    
    <section class="container">
        <div class="row event-hero-block">
            <div class="col-3 col-md-3 cutlery-block">
                <div class="fork-cutlery-block">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/fork.svg' ?>" alt="">
                </div>
            </div>
            <div class="col-6 col-md-4 event-hero-img-block">
                <div class="event-hero-wrap">
                    <div class="event-hero-img" style="background-image: url('<?php echo get_the_post_thumbnail_url($id) ?>')"></div>
                </div>
            </div>
            <div class="col-3 col-md-3 cutlery-block">
                <div class="knife-cutlery-block">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/knife.svg' ?>" alt="">
                </div>
            </div>
        </div>
    </section>

<section class="container event-main-body">
    <h1 class="event-main-title"><?php the_title()?></h1>
    <div class="row event-main-description">
        
    </div>
</section>

<?php
    
    endwhile;
    endif;

get_footer();
