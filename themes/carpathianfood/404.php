<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package creativeboost
 */

get_header();
?>

	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main error-404" role="main">

				<section class="not-found default-page">
					<div class="container main-content">
						<div class="row main-content-wrap">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'creativeboost' ); ?></h1>
							</header><!-- .page-header -->

							<div class="entry-content col-md-10">
								<p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location.', 'creativeboost' ); ?></p>
								<p class="text-center"><img src="<?php print ASSETSURL ?>/images/smilie.png" alt="smilie"></p>
							</div><!-- .page-content -->

						</div>
						<div class="gradient-line row"></div>
					</div>

				</section><!-- .error-404 -->



			</main><!-- #main -->

		</div><!-- #primary -->
	</div><!-- .wrap -->


<?php
get_footer();
