<?php
namespace VXN\Express\Core;

/**
 * Options, to set and get options for express add on  
 * @package VXN\Express\Core 
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Options {

	
	private static $options=[];

    /**
     * @param string $page 
     * @return mixed 
     */
    public static function get($page) {
		if( ! self::$options ){
			self::reload();
		}

		return self::$options[$page];
    }

	/** @return void  */
	public static function reload(){
		$options['contact'] = array_merge( self::contact_options_default(), get_option( 'vxn_express_contact_options' ) ? : []) ;
		$options['whatsapp'] = array_merge( self::whatsapp_options_default(), get_option( 'vxn_express_whatsapp_options' ) ? : [] );
		$options['setup'] = array_merge( self::setup_options_default(), get_option( 'vxn_express_setup_options' ) ? : [] );
		self::$options = apply_filters('vxn_express_options_val', $options);
	}

	/** @return string[]  */
	private static function setup_options_default(){
        return [
			'txt-phone-format' => '',
            'txt-wa-popup-id' => 'vxn-wa-popup',
			'txt-wa-me-class' => 'vxn-whatsapp-me',
            'txt-wa-me-att-text'=> 'vxn-wa-text',
            'txt-wa-me-att-show-form'=> 'vxn-wa-show-form',
			'txt-wa-form-id' => 'vxn-wa-form', 
			'txt-wa-form-field-name-id' => 'vxn-wa-name',
			'txt-wa-form-field-phone-id' => 'vxn-wa-phone',
			'txt-wa-form-field-text-id' => 'vxn-wa-text',
			'txt-wa-form-field-email-id' => 'vxn-wa-email',
			'txt-wa-form-submit-id' => 'vxn-btn-wa-submit',
			'txt-toolset-field-tokopedia' => 'tokopedia',
			'txt-toolset-field-bukalapak' => 'bukalapak',
			'txt-toolset-field-shopee' => 'shopee',
        ];
	}
	
	/** @return string[]  */
	private static function contact_options_default(){
        return [
			'txt-email'=> '',
			'txt-phone'=> '',			
			'txt-address'=> '',
			'txt-facebook'=> '',
			'txt-instagram'=> '',
			'txt-twitter'=> '',
			'txt-youtube'=> '',
			'txt-linkedin' => ''
        ];
	}	

	/** @return string[]  */
	private static function whatsapp_options_default(){
        return [
            'txt-wa-no' => '',
			'chk-show-form' => '0',
            'txt-wa-text-default'=> '',
			'txt-wa-text-order'=> '',
			'txt-wa-text-consult'=> '',			
			'txt-wa-text-consult-product'=> '',
			'txt-wa-text-appointment'=> ''
        ];
	}	

}
