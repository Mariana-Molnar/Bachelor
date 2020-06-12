<?php
// Prevent direct script access.
use Entity\Article;
use Entity\Article\ArticleRepository;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$articles = ArticleRepository::getShowOnMainPage(3, get_the_ID());

if (!empty($articles) && !is_wp_error($articles)) :

?>

<section class="container article-block">
	<h2 class="title-bottom-line"><?php _e('ERFOLGSGESCHICHTEN','cfood'); ?></h2>
	<div class="row article-block-wrap">

		<?php foreach ($articles as  $article): ?>
			<?php /** @var $article Article */ ?>
			<div class=" single-article-block">
				<div class="article-image-block">
					<?php print $article->getThumbnail(); ?>
					<p class="article-image-text">BEKOMMEN 600 € / JAHR</p>
				</div>
				<div class="article-text-block">
					<h3><?php print $article->title; ?></h3>
					<p><?php print $article->excerpt; ?></p>
					<a href="<?php print $article->getPermalink(); ?>"><?php _e('WEITERLESEN','cfood'); ?> ›</a>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
</section>

<?php endif; ?>