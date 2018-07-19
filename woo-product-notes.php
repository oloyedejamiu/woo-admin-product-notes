<?php 
/**
 * Plugin Name: Woo Admin Product Notes
 * Plugin URI: https://kankoz.com/woo-admin-product-notes
 * Description: This woocommerce plugin add custom text area on all products within the admin section.  It's sweet & simple.
 * Version: 1.0.0
 * Author: WooCommerce
 * Author URI: http://woocommerce.com
 * Developer: Jamiu Oloyede
 * Developer URI: https://kankoz.com/
 * Text Domain: woo-admin-product-notes
 * Domain Path: /languages
 *
 * Woo: 12345:342928dfsfhsf8429842374wdf4234sfd
 * WC requires at least: 3.4.3
 * WC tested up to: 3.4.3
 *
 * Copyright: © 2009-2015 WooCommerce.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {    
    // General fields
    // Let create the product note field
    add_action('woocommerce_product_options_general_product_data','kankoz_woo_admpnotes_add_custom_fields' );
    // Let save the data
    add_action('woocommerce_process_product_meta','kankoz_woo_admpnotes_save_custom_fields' );

    function kankoz_woo_admpnotes_add_custom_fields(){
    	global $woocommerce, $post;

    	echo '<div class="kankoz_woo_admpnotes_options_group">';

    	// Create textarea custom fields
		woocommerce_wp_textarea_input( 
			array( 
				'id'          => '_kankoz_woo_admpnotes', 
				'label'       => __( 'Product Note', 'woocommerce' ), 
				'placeholder' => 'Please enter product note', 
				'desc_tip'    => 'true',
				'description' => __( 'This is only visible to admins.', 'woocommerce' ) 
			)
		);
    	
    	echo '</div>';
    }
    	
    function kankoz_woo_admpnotes_save_custom_fields( $post_id ){
    	
    	// Textarea
	$woocommerce_textarea = $_POST['_kankoz_woo_admpnotes'];
	if( !empty( $woocommerce_textarea ) )
		update_post_meta( $post_id, '_kankoz_woo_admpnotes', esc_html( $woocommerce_textarea ) );
    }
}