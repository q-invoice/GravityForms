<?php
/*
Plugin Name: Gravity Forms Qinvoice Connect Add-On
Plugin URI: http://www.q-invoice.com
Description: Fully integrate Gravity Forms with Qinvoice for sending invoices
Version: 2.0.1
Author: qinvoice
Author URI: http://www.q-invoice.com
Text Domain: gravityforms-qinvoice-connect
Domain Path: /languages

*/

define( 'GF_QINVOICECONNECT_VERSION', '2.0.1' );

add_action( 'gform_loaded', array( 'GF_QinvoiceConnect_Bootstrap', 'load' ), 5 );

// hook to payments
add_action( 'gform_ideal_fulfillment', array ('GF_QinvoiceConnect_Bootstrap', 'update'), 5);
add_action( 'gform_paypal_fulfillment', array ('GF_QinvoiceConnect_Bootstrap', 'update'), 5);




class GF_QinvoiceConnect_Bootstrap {

	public static function load(){

		if ( ! method_exists( 'GFForms', 'include_feed_addon_framework' ) ) {
			return;
		}

		require_once( 'class-gf-qinvoice-connect.php' );

		GFAddOn::register( 'GFQinvoiceConnect' );
		//self::get_get();
	}

	public static function update($entry){

		$gfqc = new GFQinvoiceConnect();
		$gfqc->export_after_payment($entry);

	}

}

function gf_qinvoiceconnect(){
	return GFQinvoiceConnect::get_instance();
}