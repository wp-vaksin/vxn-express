<?php
namespace VXN\Express\Core;

/**
 * Class to add shortcodes related express add on
 * @package VXN\Express\Core 
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Shortcodes {
	
	/** @return void  */
	public static function add() {
		self::add_vxn_shortcodes();
	}

	/** @return void  */
	private static function add_vxn_shortcodes() {
		
		if ( ! shortcode_exists( 'format-idr' ) ){
			add_shortcode( 'format-idr', function( $atts, $content ) {
				$content = do_shortcode($content);
				return 'Rp. ' . number_format($content,0,",",".");
			} );	
		}

		if ( ! shortcode_exists( 'url-encode' ) ){
			add_shortcode( 'url-encode', function( $atts, $content ) {
				return urlencode(do_shortcode($content));
			} );	
		}

		if ( ! shortcode_exists( 'vxn-wp-request' ) ){
			add_shortcode( 'vxn-wp-request', function() {
				global $wp;
				return $wp->request;
			} );
		}

		if ( ! shortcode_exists( 'vxn-wa-url' ) ){
			// var_dump(Options::get('whatsapp'));
			// exit;
			add_shortcode( 'vxn-wa-url', function() {
				return 'https://api.whatsapp.com/send/?phone=' . Options::get('whatsapp')['txt-wa-no'];
			} );
		}

		if ( ! shortcode_exists( 'vxn-contact-phone' ) ){
			add_shortcode( 'vxn-contact-phone', function() {
				return Options::get('contact')['txt-phone'];
			} );		
		}

		if ( ! shortcode_exists( 'vxn-contact-phone-display' ) ){
			add_shortcode( 'vxn-contact-phone-display', function() {
				$phone = Options::get('contact')['txt-phone'];
				$format = Options::get('setup')['txt-phone-format'];
				// return $phone;
				return Util::format_phone($phone, $format);
			} );		
		}

		if ( ! shortcode_exists( 'vxn-contact-email' ) ){
			add_shortcode( 'vxn-contact-email', function() {
				return Options::get('contact')['txt-email'];
			} );
		}

		if ( ! shortcode_exists( 'vxn-contact-address' ) ){
			add_shortcode( 'vxn-contact-address', function() {
				return Options::get('contact')['txt-address'];
			} );
		}

		if ( ! shortcode_exists( 'vxn-wa-text' ) ){
			add_shortcode( 'vxn-wa-text', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-default' );
				return self::parse_dynamic_var( $text );
			} );
		}

		if ( ! shortcode_exists( 'vxn-wa-text-order' ) ){
			add_shortcode( 'vxn-wa-text-order', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-order' );

				$args = shortcode_atts( array(     
					'product' => '',
				), $attr );

				// if($attr['decode']){
				// 	$args['product'] = urldecode($args['product']);
				// }
				
				$text = self::replace_dynamic_var_with_atts( $text, $args );
				
				return self::parse_dynamic_var( $text );
			} );	
		}

		if ( ! shortcode_exists( 'vxn-wa-text-consult' ) ){
			add_shortcode('vxn-wa-text-consult', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-consult' );			
				return self::parse_dynamic_var( $text );
			} );
		}		

		if ( ! shortcode_exists( 'vxn-wa-text-consult-product') ){
			add_shortcode( 'vxn-wa-text-consult-product', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-consult-product' );

				$args = shortcode_atts( array(     
					'product' => ''
				), $attr );
				
				$text = self::replace_dynamic_var_with_atts( $text, $args );
				
				return self::parse_dynamic_var( $text );
			} );
		}

		if (!shortcode_exists( 'vxn-wa-text-appointment' ) ){
			add_shortcode( 'vxn-wa-text-appointment', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-appointment' );			
				return self::parse_dynamic_var( $text );
			} );
		}

	}

	/**
	 * @param string $text 
	 * @return string 
	 */
	public static function parse_dynamic_var( $text ) {

		if ( strpos( $text, '{page_title}' ) !== false ) {
			$dynamic_var['page_title'] = get_the_title();
		}		

		if ( strpos( $text, '{url}' ) !== false ) {
			$dynamic_var['url'] = get_permalink( get_the_ID() );
		}

		if ( !empty( $dynamic_var ) ) {
			foreach ( $dynamic_var as $key => $value ) {
				$text = str_replace( '{' . $key . '}', $value, $text );
			}
		}

		return $text;
	}

	/**
	 * @param string $field 
	 * @return string 
	 */
	public static function get_wa_text( $field ) {
		return Options::get('whatsapp')[$field] ?? Options::get('whatsapp')['txt-wa-text-default'];
	}

	/**
	 * @param string $text 
	 * @param array $args 
	 * @return string 
	 */
	public static function replace_dynamic_var_with_atts( $text, $args ) {
		if ( !empty( $args ) ) {
			foreach ( $args as $key => $value ) {
				if ( $value ) {
					$text = str_replace( '{' . $key . '}', do_shortcode( $value ), $text );
				}
			}
		}

		return $text;
	}	
}

