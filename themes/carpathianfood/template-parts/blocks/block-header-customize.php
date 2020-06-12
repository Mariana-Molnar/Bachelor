<?php

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}


$header_image_src = '';

if (has_post_thumbnail() ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	if (!empty($image)) {
		$header_image_src = $image[0];
	}
}

?>

<section class="container header-main-wrap" style="<?php print (empty($header_image_src) ? '' : 'background-image: url(\'' . $header_image_src . '\');'); ?>">
	<?php if (get_field('header_use_logo') && $logo = get_field('header_logo')): ?>
		<?php print wp_get_attachment_image($logo['id'],'thumbnail', false, ['class'=>'club-main-logo']); ?>
	<?php endif; ?>

	<div class="header-main-block">
		<?php if ($description1 = get_field('header_description_1')): ?>
			<div><h2 class="main-title-h2"><?php print $description1; ?></h2></div>
		<?php endif; ?>
		<?php if ($description2 = get_field('header_description_2')): ?>
			<div><h2 class="main-title-h1"><?php print $description2; ?></h2></div>
		<?php endif; ?>
	</div>
	<div class="gradient-line row"></div>
</section>
