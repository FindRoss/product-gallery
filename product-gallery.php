<?php
/**
 * Plugin Name:       Product Gallery
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       product-gallery
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once plugin_dir_path( __FILE__ ) . 'product-gallery-render.php';

function create_block_product_gallery_block_init() {
	register_block_type( __DIR__ . '/build/product-gallery', array( 'render_callback' => 'render_dynamic_product_gallery_block' ) );
}
add_action( 'init', 'create_block_product_gallery_block_init' );
