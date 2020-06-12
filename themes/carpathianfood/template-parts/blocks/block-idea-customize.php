<?php

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$title = get_field('idea_title');
$elements = get_field('idea_elements');
if (empty($elements)) $elements = [];

$elements_count = count($elements);

$grid_size = floor((13 - $elements_count)/$elements_count);
if ($grid_size < 1) $grid_size = 1;

?>

<section class="container idea-block">
	<h2><?php print $title; ?></h2>
	<div class="row idea-block-wrap">
		<?php for ($i=0; $i<$elements_count;$i++): ?>
			<?php $element = $elements[$i]; ?>
			<?php if ($i > 0): ?>
				<div class="col-md-1 arrow-icon">
					<img src="<?php echo get_template_directory_uri()?>/assets/images/pfeil.png" alt="">
				</div>
			<?php endif; ?>
			<div class="col-md-<?php print $grid_size ?>">
				<?php if (!empty($element['icon']) && !empty($element['icon']['url'])): ?>
					<img width="65px" src="<?php print $element['icon']['url']; ?>" alt="<?php print $element['icon']['title']; ?>">
				<?php endif; ?>
				<p><?php print $element['title']; ?></p>
			</div>
		<?php endfor; ?>
	</div>
</section>