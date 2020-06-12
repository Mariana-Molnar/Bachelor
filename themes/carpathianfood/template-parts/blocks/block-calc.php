<?php

use Service\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$plz = Helpers::issetor($_REQUEST['plz'], '');
$usage = Helpers::issetor($_REQUEST['usage'], '3000');
?>

<section class="container calculator-block">
	<form action="<?php echo Helpers::getTemplatePageLink('views/tmp-tarif.php');?>" method="get">
		<div class="calculator-header-block">
			<h2><?php _e('Jetzt STROMTarif berechnen','cfood'); ?></h2>
		</div>
		<div class="row calculator-block-wrap">
			<div class="plz-input-block">
				<p>PLZ</p>
				<input type="text" name="plz" class="plz-input" value="<?php print $plz; ?>">
				<span class="form-error">Bitte geben Sie eine Postleitzahl ein.</span>
			</div>
			<div class="calculator-slider-block">
				<p><?php _e('Geschätzter Jahresverbrauch','cfood'); ?></p>
				<div class="range-picker-block">
					<div class="range-slider-block">
						<input type="text" class="range-slider" data-slider-handle="rectangle" data-slider-min="1500" data-slider-max="8000" data-slider-step="50" data-slider-value="3000" >
					</div>
					<div class="raiting-icons-block">
						<ul>
							<li class="raiting-icon selected"></li>
							<li class="raiting-icon selected"></li>
							<li class="raiting-icon"></li>
							<li class="raiting-icon"></li>
							<li class="raiting-icon"></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="kilowatt-input-block">
				<p><?php _e('Personen im Haushalt','cfood'); ?></p>
				<div class="input-group">
					<input type="text" name="usage" class="form-control range-slider-input" aria-label="Amount (to the nearest dollar)" value="<?php print $usage; ?>">
					<div class="input-group-append">
						<span class="input-group-text">kwh</span>
					</div>
				</div>
			</div>
			<div class=" calculator-button-block">
				<a href="<?php echo get_permalink( get_page_by_path( 'tariff-page' ) )?>"><button><?php _e('Jetzt berechnen!','cfood'); ?></button></a>
			</div>
		</div>
	</form>
</section>
