<?php
/**
 * Plugin Name:       AILB Product Gallery
 * Description:       A custom plugin created with @wordpress/scripts to display Items on AI Luxury Boutique
 * Version:           1.1.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Ross Findlay & Sadok Gable
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ailb-product-gallery
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once plugin_dir_path( __FILE__ ) . 'ailb-product-gallery-render.php';

function create_block_ailb_product_gallery_block_init() {
	register_block_type( __DIR__ . '/build/ailb-product-gallery', array( 'render_callback' => 'render_dynamic_ailb_product_gallery_block' ) );
}
add_action( 'init', 'create_block_ailb_product_gallery_block_init' );
