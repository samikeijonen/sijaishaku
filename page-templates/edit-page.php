<?php
/**
 * Template Name: Edit Page
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
					
						<?php if ( isset( $_GET['gform_post_id'] ) && is_user_logged_in() && current_user_can( 'edit_post', $_GET['gform_post_id'] ) ) { ?>

							<?php the_content(); ?>
							
						<?php } elseif ( isset( $_GET['delete_id'] ) && is_user_logged_in() && 'on' == $_GET['delete'] && current_user_can( 'edit_post', $_GET['delete_id'] ) ) {
								
								/* Delete a post when have rights to do that. */
								wp_delete_post( $_GET['delete_id'] );
								echo '<p class="sijaishaku-post-deleted">' . __( 'Post was deleted succesfully.', 'sijaishaku' ) . '</p>';
								
							} else { ?>

								<p>
									<?php _e( 'You do not have privileges to edit this post.', 'sijaishaku' ); ?>
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