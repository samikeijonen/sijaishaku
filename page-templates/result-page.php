<?php
/**
 * Template Name: Result Page
 *
 * @package Kalervo
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed" role="main">
	
		<h2><?php _e( 'Custom search', 'sijaishaku' ); ?></h2>
		
		<p><?php _e( 'Select at least one from each group.', 'sijaishaku' ); ?></p>
					
		<form role="search" method="post" class="search-form" action="#sijaishaku-latest-posts">
			<div class="sijaishaku-search">
				<?php wp_nonce_field( 'sijaishaku-nonce', 'sijaishaku-nonce' ); ?>
				<input type="hidden" name="set-search" id="set-search" value="on">
				
				<div id="sijaishaku-cat-check">
				<p><strong><?php _e( 'Towns', 'sijaishaku' ); ?></strong></p>
					<?php
						$categories = get_categories(); 
						foreach ( $categories as $category ) {
							//$checkboxes ='<li>';
							$checkboxes = '<input type="checkbox" name="filter_cat[]" id="filter_cat_' . $category->cat_ID . '" value="'. $category->cat_ID . '"';
							if ( isset( $_POST['filter_cat'] ) ) {
								if ( in_array( $category->cat_ID, $_REQUEST['filter_cat'] ) ) { $checkboxes .= 'checked="checked"'; }
							}
							$checkboxes .= ' />';
							$checkboxes .= '<label for="filter_cat_' . $category->cat_ID . '">';
							$checkboxes .= $category->cat_name;
							$checkboxes .= '</label>';
							//$checkboxes .= '</li>';
							echo $checkboxes;
						}
					?>
				</div>
							
				<div id="sijaishaku-tag-check">
				<p><strong><?php _e( 'Subjects', 'sijaishaku' ); ?></strong></p>
					<?php
						$categories = get_categories( array( 'taxonomy' => 'post_tag' ) ); 
						foreach ( $categories as $category ) {
							//$checkboxes ='<li>';
							$checkboxes = '<input type="checkbox" name="filter_tag[]" id="filter_tag_' . $category->cat_ID . '" value="'. $category->cat_ID . '"';
							if ( isset( $_POST['filter_tag'] ) ) { 
								if ( in_array( $category->cat_ID, $_REQUEST['filter_tag'] ) ) { $checkboxes .= 'checked="checked"'; } 
							}
							$checkboxes .= ' />';
							$checkboxes .= '<label for="filter_tag_' . $category->cat_ID . '">';
							$checkboxes .= $category->cat_name;
							$checkboxes .= '</label>';
							//$checkboxes .= '</li>';
							echo $checkboxes;
						}
					?>
				</div>
				
				<div id="sijaishaku-level-check">
				<p><strong><?php _e( 'Levels', 'sijaishaku' ); ?></strong></p>
					<?php
						$categories = get_categories( array( 'taxonomy' => 'academy_level' ) ); 
						foreach ( $categories as $category ) {
							//$checkboxes ='<li>';
							$checkboxes = '<input type="checkbox" name="filter_level[]" id="filter_level_' . $category->cat_ID . '" value="'. $category->cat_ID . '"';
							if ( isset( $_POST['filter_level'] ) ) { 
								if ( in_array( $category->cat_ID, $_REQUEST['filter_level'] ) ) { $checkboxes .= 'checked="checked"'; } 
							}
							$checkboxes .= ' />';
							$checkboxes .= '<label for="filter_level_' . $category->cat_ID . '">';
							$checkboxes .= $category->cat_name;
							$checkboxes .= '</label>';
							//$checkboxes .= '</li>';
							echo $checkboxes;
						}
					?>
				</div>
				
				<div style="clear:both;">&nbsp;</div>
							
				<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'sijaishaku' ); ?>" />
			</div>
		</form>
		
		<?php if ( isset( $_POST['set-search'] ) && 'on' == esc_attr( $_POST['set-search'] ) && wp_verify_nonce( $_POST['sijaishaku-nonce'], 'sijaishaku-nonce' ) ) : ?>
		
		<?php
		/* Set custom query to show post from get method. */
		$sijaishaku_posts_args = apply_filters( 'sijaishaku_result_page_post_arguments', array(
			'post_type'           => 'post',
			'posts_per_page'      => 9999,
			//'paged'               => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
			'ignore_sticky_posts' => 1,
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => isset( $_POST['filter_cat'] ) ? $_POST['filter_cat'] : ''
				),
				array(
					'taxonomy' => 'post_tag',
					'field' => 'id',
					'terms' => isset( $_POST['filter_tag'] ) ? $_POST['filter_tag'] : ''
				),
				array(
					'taxonomy' => 'academy_level',
					'field' => 'id',
					'terms' => isset( $_POST['filter_level'] ) ? $_POST['filter_level'] : ''
				)
			)
		) );
			
		$sijaishaku_posts = new WP_Query( $sijaishaku_posts_args );
		?>
		
		<br /><h3 id="sijaishaku-latest-posts"><?php _e( 'Search results', 'sijaishaku' ); ?></h3>
		
		<div class="sijaishaku-latest-wrap">
			
			<?php if ( $sijaishaku_posts->have_posts() ) : ?>

				<?php while ( $sijaishaku_posts->have_posts() ) : $sijaishaku_posts->the_post(); ?>
				
					<div class="sijaishaku-post">
				
						<article <?php hybrid_post_attributes(); ?>>
	
							<header class="entry-header">
								<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
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
								<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms before="Posted in " taxonomy="category"] [entry-terms before="| Tagged "] [entry-terms before="| Academy level " taxonomy="academy_level"]', 'sijaishaku' ) . '</div>' ); ?>
							</footer><!-- .entry-footer -->

						</article><!-- .hentry -->
					
					</div><!-- .sijaishaku-post -->

				<?php endwhile; ?>
				
				<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; wp_reset_query(); // reset query. ?>
							
		</div><!-- .sijaishaku-latest-wrap -->
		
		<?php endif; ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>