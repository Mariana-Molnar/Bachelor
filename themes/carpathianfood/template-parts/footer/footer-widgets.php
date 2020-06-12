<?php if (is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' )): ?>
	<div class="row">
		<div class="col-6 col-md-3  col-lg-3 footer-widget-1">
			<?php if ( is_active_sidebar( 'footer-1' )): ?>
				<?php dynamic_sidebar( 'footer-1' ); ?>
			<?php endif; ?>
		</div>
		<div class="col-6 col-md-3  col-lg-3 footer-widget-2">
			<?php if ( is_active_sidebar( 'footer-2' )): ?>
				<?php dynamic_sidebar( 'footer-2' ); ?>
			<?php endif; ?>
		</div>
		<div class="col-6 col-md-3 col-lg-3 footer-widget-3">
			<?php if ( is_active_sidebar( 'footer-3' )): ?>
				<?php dynamic_sidebar( 'footer-3' ); ?>
			<?php endif; ?>
		</div>
		<div class="col-6 col-md-3  col-lg-3 footer-widget-4">
			<?php if ( is_active_sidebar( 'footer-4' )): ?>
				<?php dynamic_sidebar( 'footer-4' ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>