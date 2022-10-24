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
		
		if ( ! shortcode_exists( 'vxn-format-idr' ) ){
			add_shortcode( 'vxn-format-idr', function( $atts, $content ) {
				$content = do_shortcode($content);
				return esc_html('Rp. ' . number_format($content,0,",","."));
			} );	
		}
				
		// Contact Shortcodes
		if ( ! shortcode_exists( 'vxn-contact-phone' ) ){
			add_shortcode( 'vxn-contact-phone', function() {
				return esc_html(Options::get('contact')['txt-phone']);
			} );		
		}

		if ( ! shortcode_exists( 'vxn-contact-phone-url' ) ){
			add_shortcode( 'vxn-contact-phone-url', function() {
				return esc_url('tel:' . Options::get('contact')['txt-phone']);
			} );		
		}

		if ( ! shortcode_exists( 'vxn-contact-phone-display' ) ){
			add_shortcode( 'vxn-contact-phone-display', function() {
				$phone = Options::get('contact')['txt-phone'];
				$format = Options::get('setup')['txt-phone-format'];
				return esc_html(Util::format_phone($phone, $format));
			} );		
		}

		if ( ! shortcode_exists( 'vxn-contact-email' ) ){
			add_shortcode( 'vxn-contact-email', function() {
				return esc_html(Options::get('contact')['txt-email']);
			} );
		}

		if ( ! shortcode_exists( 'vxn-contact-email-url' ) ){
			add_shortcode( 'vxn-contact-email-url', function() {
				return esc_url('mailto:' . Options::get('contact')['txt-email']);
			} );
		}

		if ( ! shortcode_exists( 'vxn-contact-address' ) ){
			add_shortcode( 'vxn-contact-address', function() {
				return esc_textarea(Options::get('contact')['txt-address']);
			} );
		}
	
		if ( ! shortcode_exists( 'vxn-google-map-url' ) ){
			add_shortcode( 'vxn-google-map-url', function() {
				$url = 'https://www.google.com/maps/search/?api=1&query='. urlencode(Options::get('contact')['txt-place']);
				return esc_url($url);
			} );
		}

		if ( ! shortcode_exists( 'vxn-facebook-url' ) ){
			add_shortcode( 'vxn-facebook-url', function() {
				return esc_url(Options::get('contact')['txt-facebook']);
			} );
		}	
		
		if ( ! shortcode_exists( 'vxn-instagram-url' ) ){
			add_shortcode( 'vxn-instagram-url', function() {
				return esc_url(Options::get('contact')['txt-instagram']);
			} );
		}	
		
		if ( ! shortcode_exists( 'vxn-twitter-url' ) ){
			add_shortcode( 'vxn-twitter-url', function() {
				return esc_url(Options::get('contact')['txt-twitter']);
			} );
		}	

		if ( ! shortcode_exists( 'vxn-youtube-url' ) ){
			add_shortcode( 'vxn-youtube-url', function() {
				return esc_url(Options::get('contact')['txt-youtube']);
			} );
		}	

		if ( ! shortcode_exists( 'vxn-linkedin-url' ) ){
			add_shortcode( 'vxn-linkedin-url', function() {
				return esc_url(Options::get('contact')['txt-linkedin']);
			} );
		}	

		// WhatsApp Shortcodes
		if ( ! shortcode_exists( 'vxn-wa-url' ) ){
			add_shortcode( 'vxn-wa-url', function( $attr ) {
				
				$args = shortcode_atts( array(     
					'text' => '',
				), $attr );

				$text = (string) $args['text'];

				if($text){
					do_shortcode($args['text']);
					$text = '&text=' . $text;
				}
				
				$url = 'https://api.whatsapp.com/send/?phone=' . Options::get('whatsapp')['txt-wa-no'] . $text;
				return esc_url($url);
			} );
		}

		if ( ! shortcode_exists( 'vxn-wa-is-popup' ) ){
			add_shortcode( 'vxn-wa-is-popup', function() {
				return esc_html(Options::get('whatsapp')['chk-show-form']);
			} );
		}

		if ( ! shortcode_exists( 'vxn-wa-text' ) ){
			add_shortcode( 'vxn-wa-text', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-default' );
				return esc_textarea(self::parse_dynamic_var( $text ));
			} );
		}

		if ( ! shortcode_exists( 'vxn-wa-text-order' ) ){
			add_shortcode( 'vxn-wa-text-order', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-order' );

				$args = shortcode_atts( array(     
					'product' => '',
				), $attr );
				
				$text = self::replace_dynamic_var_with_atts( $text, $args );
				
				return esc_textarea(self::parse_dynamic_var( $text ));
			} );	
		}

		if ( ! shortcode_exists( 'vxn-wa-text-consult' ) ){
			add_shortcode('vxn-wa-text-consult', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-consult' );			
				return esc_textarea(self::parse_dynamic_var( $text ));
			} );
		}		

		if ( ! shortcode_exists( 'vxn-wa-text-consult-product') ){
			add_shortcode( 'vxn-wa-text-consult-product', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-consult-product' );

				$args = shortcode_atts( array(     
					'product' => ''
				), $attr );
				
				$text = self::replace_dynamic_var_with_atts( $text, $args );
				
				return esc_textarea(self::parse_dynamic_var( $text ));
			} );
		}

		if (!shortcode_exists( 'vxn-wa-text-appointment' ) ){
			add_shortcode( 'vxn-wa-text-appointment', function( $attr ) {
				$text = self::get_wa_text( 'txt-wa-text-appointment' );			
				return esc_textarea(self::parse_dynamic_var( $text ));
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

