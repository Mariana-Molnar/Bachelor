<?php

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$title = get_field('about_title', get_the_ID());
$description = get_field('about_description', get_the_ID());

?>

<section class="container about-club-block">
    <div class="row about-club-block-wrap ">
        <h2><?php print (empty($title) ? __('ABOUT US:','cfood') : $title); ?></h2>
        <div class="about-club-description">
            <?php print $description; ?>
        </div>
    </div>
</section>