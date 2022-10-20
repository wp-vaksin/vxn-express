<?php
namespace VXN\Express\Core\Admin;

use VXN\Express\Core\Admin\Pages\Contact_Page;
use VXN\Express\Core\Admin\Pages\Setup_Page;
use VXN\Express\Core\Admin\Pages\Whatsapp_Page;
use VXN\Express\Core\Options_page\Generator\Menu_Generator;
use VXN\Express\Core\Options_page\Menu;

/**
 * Admin menu setup class 
 * @package VXN\Express\Core\Admin 
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Admin_menu{
    /** @return void  */
    public static function add() {  
        $menu = new Menu('vxn-express-setup');
        $menu->set_title('Express Options')
            ->set_position(2)
            ->set_page(new Setup_Page());

        $sub_menus = apply_filters('vxn_express_sub_menus', self::get_core_sub_menus());

        foreach($sub_menus as $sub_menu){
            $menu->add_sub_menu($sub_menu);
        }
            
        add_action( 'admin_menu', function() use ($menu) {
            Menu_Generator::generate($menu);
        });
    }

    /** @return array  */
    private static function get_core_sub_menus(){
        return [
        'setup' => (new Menu('vxn-express-setup'))
            ->set_title('Setup')
            ->set_page(new Setup_Page()),

        'contact' => (new Menu('vxn-express-contact'))
            ->set_title(__('Contact', 'vxn-express'))
            ->set_page(new Contact_Page()),

        'whatsapp' => (new Menu('vxn-express-whatsapp'))
            ->set_title('WhatsApp')
            ->set_page(new Whatsapp_Page())
        ];
    }
}