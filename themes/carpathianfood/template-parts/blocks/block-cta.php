<?php
// Prevent direct script access.
use Service\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

?>
<section class="container call-attention-block">
	<div class="row">
		<div class="col-md-6">
			<button data-toggle="modal" data-target="#tariff-popup"><?php _e('VEREIN VORSCHLAGEN','cfood'); ?></button>
		</div>
		<div class="col-md-6">
            <button class="scroll-logo-block"><?php _e('VEREIN SUCHEN','cfood'); ?></button>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="tariff-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content pop-up-block">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle"><?php _e('VEREIN VORSCHLAGEN','cfood'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="close-icon">&times; </span> <span> Close </span>
					</button>
				</div>
				<div class="modal-body">
					<form class="needs-validation" novalidate>
						<div class="form-group">
							<label for="formGroupExampleInput2"><?php _e('Verein','cfood'); ?></label>
							<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlSelect1"><?php _e('Kategorie','cfood'); ?></label>
							<select class="form-control" id="exampleFormControlSelect1" required>
								<option>Fußball</option>
								<option>2</option>
								<option>3</option>
							</select>
						</div>
						<div class="form-group">
							<label for="formGroupExampleInput2"><?php _e('Ihr Name','cfood'); ?></label>
							<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1"><?php _e('E-Mail Adresse','cfood'); ?></label>
							<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="" required>
							<div class="invalid-feedback">
								<?php _e('Please provide a valid zip.','cfood'); ?>
							</div>
						</div>
						<div class="custom-control custom-checkbox mr-sm-2">
							<input type="checkbox" class="custom-control-input" id="customControlAutosizing" required>
							<label class="custom-control-label" for="customControlAutosizing"><?php _e('AGB akzeptieren','cfood'); ?></label>
							<div class="invalid-feedback">
								<?php _e('You must agree before submitting.','cfood'); ?>
							</div>
						</div>
						<button type="submit"><?php _e('JETZT ABSCHICKEN','cfood'); ?></button>
					</form>
				</div>
				<div class="modal-footer">

				</div>
			</div>
		</div>
	</div>
</section>