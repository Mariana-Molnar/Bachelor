<?php
// Prevent direct script access.
use Entity\Club;
use Entity\Club\ClubRepository;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}


$clubs = ClubRepository::getAll();


?>
<section class="container association-block">
	<h2><?php _e('WÄHLE DEINEN VEREIN:','cfood'); ?></h2>
	<div class="row association-block-wrap">
		<?php foreach ($clubs as $club): ?>
			<?php /** @var $club Club */ ?>
			<div class="logotype-block">
				<a href="<?php print $club->getPermalink() ?>"><?php print $club->getLogo(); ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</section>