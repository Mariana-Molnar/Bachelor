<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <section class="default-page">
        <div class="container main-content">
            <div class="row main-content-wrap">
                <header class="entry-header">
<!--                    --><?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content col-md-10">
                    <?php
                    the_content();
                    ?>
                </div><!-- .entry-content -->

            </div>
        </div>
    </section>


</article><!-- #post-<?php the_ID(); ?> -->