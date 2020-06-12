<?php
/**
 * Template Name: FAQ page
 */

// Prevent direct script access.
use Entity\Faq;
use Entity\Faq\FaqRepository;

if ( ! defined( 'ABSPATH' ) ) {
    die( 'No direct script access allowed' );
}

get_header();

$faqs = FaqRepository::getAll();

if ( have_posts() ) : the_post();
?>

    <section class="faq-page_section container">
        <div class=" header-main-wrap">
            <div class="header-main-block">
               <div>
                   <h1 class="main-title-h2"><?php the_title()?></h1>
               </div>
            </div>
            <div class="gradient-line"></div>
        </div>

        <div class="intro-text">
            <div class= "row justify-content-center">
                <div class="col-md-10">
                    <p><?php the_content(); ?> </p>
                </div>
            </div>
        </div>
    </section>

    <?php print do_shortcode('[club-faq]') ?>

    <?php print do_shortcode('[club-logos]'); ?>

<?php
endif; // End of the loop.
get_footer();