<?php
/**
 * Template Name: Account Page
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
					
						<?php if ( is_user_logged_in() ) { ?>
						
							<?php
							/* Get current user post(s). Should be only one. */
							$sijaishaku_author_posts =  get_posts( 'author=' . get_current_user_id() . '&posts_per_page=-1' );
							if( $sijaishaku_author_posts ) {
								echo '<ul>';
								foreach ( $sijaishaku_author_posts as $sijaishaku_author_post )  {
									echo '<li>' . $sijaishaku_author_post->post_title . ' | <a href="editoi?gform_post_id='. $sijaishaku_author_post->ID . '">'. __( 'Click to edit', 'sijaishaku' ) . '</a> | <a href="editoi?delete=on&delete_id=' . $sijaishaku_author_post->ID . '">' . __( 'Delete', 'sijaishaku' ) . '</a></li>';
								}
								echo '</ul>';
							}
							?>

							<?php the_content(); ?>

							<?php } else { ?>

								<p>
									<?php _e( 'Login to the site.', 'sijaishaku' ); ?>
								</p>
								<p>
									<?php wp_login_form(); ?>
								</p>
								<p>
									<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php _e( 'Lost password?', 'sijaishaku' ); ?>"><?php _e( 'Lost password?', 'sijaishaku' ); ?></a>
								</p>

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