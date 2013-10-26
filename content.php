<article <?php hybrid_post_attributes(); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
			<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "]', 'sijaishaku' ) . '</div>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<p>
				<?php echo sijaishaku_plugin_output_name_email_phone(); ?>
			</p>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'sijaishaku' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms before="City " taxonomy="city"] [entry-terms before="| Subject " taxonomy="subject"] [entry-terms before="| Academy level " taxonomy="academy_level"]', 'sijaishaku' ) . '</div>' ); ?>
		</footer><!-- .entry-footer -->

	<?php } else { ?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
			<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "]', 'sijaishaku' ) . '</div>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_content(); ?>								
			<p>
				<?php echo sijaishaku_plugin_output_name_email_phone(); ?>
			</p>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'sijaishaku' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms before="City " taxonomy="city"] [entry-terms before="| Subject " taxonomy="subject"] [entry-terms before="| Academy level " taxonomy="academy_level"]', 'sijaishaku' ) . '</div>' ); ?>
		</footer><!-- .entry-footer -->

	<?php } ?>

</article><!-- .hentry -->