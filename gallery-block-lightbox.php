<?php
/**
 * Plugin Name:  Lightbox for Gallery & Image Block
 * Plugin URI:
 * Description:  Adds a Lightbox to the Block Editor (Gutenberg) Gallery & Image Block.
 * Author:       Johannes Kinast <johannes@travel-dealz.de>
 * Author URI:   https://go-around.de
 * Version:     1.5.0
 */
namespace Gallery_Block_Lightbox;

function register_assets() {
	wp_register_script( 'baguettebox', plugin_dir_url( __FILE__ ) . 'dist/baguetteBox.min.js', [], '1.11.1', true );
	wp_add_inline_script( 'baguettebox', 'window.addEventListener("load", function() {var options={captions:function(t){var e=t.parentElement.getElementsByTagName("figcaption")[0];return!!e&&e.innerHTML},filter:/.+\.(gif|jpe?g|png|webp|svg)/i};baguetteBox.run(".wp-block-gallery",options);baguetteBox.run(".gallery",options);baguetteBox.run(".wp-block-image",options);});' );
	wp_register_style( 'baguettebox-css', plugin_dir_url( __FILE__ ) . 'dist/baguetteBox.min.css', [], '1.11.1' );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\register_assets' );

function enqueue_assets() {
	if ( has_block( 'gallery' ) || has_block( 'image' ) || get_post_gallery() ) {
		wp_enqueue_script( 'baguettebox' );
		wp_enqueue_style( 'baguettebox-css' );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
