<?php
namespace VXN\Express\Core;

/**
 * Asset Enqueue 
 * @package VXN\Express\Core 
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Assets {
    private static $version = '0.0.1';

    /** @return void  */
    public static function enqueue() {
        if( is_admin() ){
            self::enqueue_admin_script();
        } else {
            self::enqueue_front_script();
        }

    }

    /** @return void  */
    private static function enqueue_admin_script(){
        //belum ada
    }

    /** @return void  */
    private static function enqueue_front_script(){
        add_action( 'wp_enqueue_scripts', function () {

            // if ( !wp_script_is( 'custom-style' ) ){
            //     wp_register_style( 'custom-style', plugins_url( '/css/style.css' , __FILE__ ) );
            //     wp_enqueue_style( 'custom-style' );
            // }

            if( (Options::get('whatsapp')['chk-show-form']) && (! wp_script_is( 'vxn-wa-form' ))){
                self::enq_script_vxn_wa_form();
            }
        
        } );
    }

    /** @return void  */
    private static function enq_script_vxn_wa_form() {

        $setup = Options::get('setup');
        
        wp_register_script( 'vxn-wa-form', VXN_EXPRESS_CORE_URL . '/inc/js/wa-form.js', array(), self::$version );
        wp_enqueue_script( 'vxn-wa-form' );

        $wa_data = [
            'url' => do_shortcode( '[vxn-wa-url]' ),
            'text_default' => do_shortcode('[vxn-wa-text]'),
            'wrapper_id' => $setup['txt-wa-popup-id'],
            'el' => [
                'class' => $setup['txt-wa-me-class'],
                'att_text'=> $setup['txt-wa-me-att-text'],
                'att_show_form'=> $setup['txt-wa-me-att-show-form'],
            ],
            'form' => [
                'show' => Options::get('whatsapp')['chk-show-form'] ? true : false ,
                'id' => $setup['txt-wa-form-id'],
                'wa_name_id' => $setup['txt-wa-form-field-name-id'],
                'wa_phone_id' => $setup['txt-wa-form-field-phone-id'],
                'wa_text_id' => $setup['txt-wa-form-field-text-id'],
                'wa_email_id' => $setup['txt-wa-form-field-email-id'],
                'btn_submit_id' => $setup['txt-wa-form-submit-id']
            ]        
        ];
    
        wp_localize_script('vxn-wa-form','_vxn_wa_form_data', $wa_data);    
    }

}
