<?php
/**
 * This is child themes functions.php file. All modifications should be made in this file.
 *
 * All style changes should be in child themes style.css file.
 *
 * @package Sijaishaku
 * @subpackage Functions
 */

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'sijaishaku_theme_setup', 11 );

/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove 
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 *
 * @since 0.1.0
 */
function sijaishaku_theme_setup() {

	/* Get the theme prefix ("kalervo"). */
	$prefix = hybrid_get_prefix();
	
}

?>