<?php
use Entity\Club;
use Entity\Club\ClubRepository;
use Service\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$club = ClubRepository::find(get_the_ID());

?>

<section class="container call-calculator-block">
	<div class="row call-calculator-block-wrap">
		<div class="col-11 col-md-9">
			<h1><?php print (empty($club) ? '' : $club->title);?> <?php _e('freut sich über deine Unterstützung.','cfood'); ?></h1>
			<a href="<?php echo Helpers::getTemplatePageLink('views/tmp-tarif.php');?>"> <button><?php _e('STROMTARIF BERECHNEN','cfood'); ?></button></a>
		</div>
	</div>
</section>
