<?php
/**
 * Template Name: Send Page
 *
 * User can only post one post and that's it.
 *
 * @package Sijaishaku
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">
	
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article <?php hybrid_post_attributes(); ?>>

					<header class="entry-header">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
					
						<?php if ( is_user_logged_in() && get_the_author_posts() >= 1 ) { // User can only post one article ?>
								
								<p class="sijaishaku-post-max">
									<?php _e( 'You have already left a message. Only one is allowed.', 'sijaishaku' ); ?>
								</p>

							<?php } else { ?>

								<?php the_content(); ?>

							<?php } ?>
							
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
					</footer><!-- .entry-footer -->

				</article><!-- .hentry -->

				<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>