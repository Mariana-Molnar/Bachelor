<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$all_blocks = apply_filters('clubebergy/view/main/blocks', ['header', 'about', 'idea','clubs' , 'cta',  'calc', 'testimonial', 'support', 'article', 'statistic', 'logos', 'faq', 'banner']);

$enable_blocks = get_field('enable_blocks');
if (empty($enable_blocks)) $enable_blocks = [];

?>

<div class="homepage-blocks">

	<?php foreach ($all_blocks as $block): if (in_array($block,$enable_blocks)):
		get_template_part( 'template-parts/blocks/block-' . $block, get_field($block . '_customize') ? 'customize' : '' );
	endif; endforeach; ?>

</div>