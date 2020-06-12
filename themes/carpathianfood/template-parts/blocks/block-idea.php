<?php

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<section class="container idea-block">
	<h2><?php _e('UNSERE IDEE:','cfood'); ?></h2>
	<div class="row idea-block-wrap ">
		<div class="col-md-3">
			<img width="65px" src="<?php echo get_template_directory_uri()?>/assets/images/taschenrechner.svg" alt="">
			<p><?php _e('1. Stromtarif <br> berechnen','cfood'); ?></p>
		</div>
		<div class="col-md-1 arrow-icon">
			<img src="<?php echo get_template_directory_uri()?>/assets/images/pfeil.png" alt="">
		</div>
		<div class="col-md-3">
			<img width="65px" src="<?php echo get_template_directory_uri()?>/assets/images/vertrag.svg" alt="">
			<p><?php _e('2. GRÜNEN STROMVERTRAG <br> ABSCHLIESSEN','cfood'); ?></p>
		</div>
		<div class="col-md-1 arrow-icon">
			<img src="<?php echo get_template_directory_uri()?>/assets/images/pfeil.png" alt="">
		</div>
		<div class="col-md-3">
			<img width="65px" src="<?php echo get_template_directory_uri()?>/assets/images/bonus.svg" alt="">
			<p><?php _e('3. DEIN VEREIN ERHÄLT','cfood'); ?> </p>
			<span class="bonus-price"><?php _e('20 € BONUS - ','cfood'); ?><span><?php _e('JEDES JAHR!','cfood'); ?></span></span>
		</div>
	</div>
</section>