<?php
/**
 * Template Name: Facet Page
 *
 * @package Kalervo
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
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms before="City " taxonomy="city"] [entry-terms before="| Subject " taxonomy="subject"] [entry-terms before="| Academy level " taxonomy="academy_level"]', 'sijaishaku' ) . '</div>' ); ?>
					</footer><!-- .entry-footer -->

				</article><!-- .hentry -->

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>
		
		<article <?php hybrid_post_attributes(); ?>>
		
			<?php echo do_shortcode( '[facetwp facet="paikkakunnat"]' ); ?>
		
			<?php echo do_shortcode( '[facetwp facet="oppiaineet"]' ); ?>
		
			<?php echo do_shortcode( '[facetwp facet="kouluasteet"]' ); ?>
		
		</article><!-- .hentry -->
		
		<?php echo do_shortcode( '[facetwp template="sijaishaku"]' ); ?>
		
		<article <?php hybrid_post_attributes(); ?>>
		
			<?php echo do_shortcode( '[facetwp pager="true"]' ); ?>
			
		</article><!-- .hentry -->

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>