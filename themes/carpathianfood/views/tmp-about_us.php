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

    <div class="about-page_section">

        <section class="container description-about-block">
            <div class="header-title-block">
                <h2 class="main-title-h2"><?php print the_title() ?></h2>
            </div>

            <div class=" description-about-block-wrap">
                <?php the_content(); ?>
            </div>
            <div class="gradient-line row"></div>
        </section>


        <?php print do_shortcode('[club-logos]'); ?>
        <?php print do_shortcode('[club-faq]'); ?>

    </div>

<?php
endif; // End of the loop.

get_footer();