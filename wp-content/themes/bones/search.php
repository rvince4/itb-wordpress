<?php
if(isset($_GET['livesearch'])):

    // if livesearch is used then generate results in list only
    echo '<ul id="live-search-results" class="clearfix">';

    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            $format = get_post_format();
            if( false === $format ) { $format = 'standard'; }
            if($post->post_type == 'faq'){ $format = 'faq'; }
            if($post->post_type == 'topic'){ $format = 'topic'; }
            if($post->post_type == 'reply'){ $format = 'reply'; }
            if($post->post_type == 'forum'){ $format = 'forum'; }

            ?>
            <li class="search-result <?php echo $format; ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php if($post->post_type == 'post'):?>
                <?php endif; ?>
            </li>
            <?php
        endwhile;
    else :
        ?>
        <li class="no-result"><?php _e('No Results Found!', 'framework'); ?></li>
        <?php
    endif;

    echo '</ul>';   // end of list

// else generate full page markup
else:
get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">
						<h1 class="archive-title"><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="article-header">

									<h3 class="search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                  <p class="byline vcard">
                    <?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
                  </p>

								</header>

								<section class="entry-content">
										<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>

								</section>

								<footer class="article-footer">
									
									<?php if(get_the_category_list(', ') != ''): ?>
                  					<?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>
                  					<?php endif; ?>

                 					<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer> <!-- end article footer -->

							</article>

						<?php endwhile; ?>

								<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Sorry, No Results.', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Try your search again.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the search.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

							<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer();
endif;
?>
