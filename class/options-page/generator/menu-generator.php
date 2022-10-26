<?php
namespace VXN\Express\Core\Options_page\Generator;

use VXN\Express\Core\Options_page\Menu;

/**
 * WordPress Admin Menu Generator Class 
 * @package VXN\Express\Core\Options_page\Generator 
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Menu_Generator  {

    /** @var Menu $menu Menu that will be generated by this class. */
    private static Menu $menu;
    
    /**
     * @param Menu $menu 
     * @return void 
     */
    public static function generate(Menu $menu){
        self::$menu = $menu;

        $nav_tabs = self::get_nav_tabs();
        $is_single_page = (self::$menu['page'] && ! self::$menu['sub_menus']);

        add_menu_page(
            self::$menu['page']['title'], 
            self::$menu['title'], 
            self::$menu['capability'], 
            self::$menu['slug'],
            $is_single_page ? array(self::$menu['page'], 'content_callback') : '',
            self::$menu['icon'],
            self::$menu['position']
        );

        if( $is_single_page ) {
            // self::$menu['page']->set_arr_tabs($nav_tabs);
            self::$menu['page']->add_admin_init();
        }

        foreach(self::$menu['sub_menus'] as $sub_menu){
            $sub_menu['page']->set_arr_tabs($nav_tabs);
            
            //nanti kasih kondisi berdasarkan parameter
            $sub_menu['page']['title'] = self::$menu['title']; // supaya seragam
            $sub_menu['page']['description'] = self::$menu['page']['description']; // supaya seragam

            self::add_sub_menu_page($sub_menu);         
        }
    }

    /** @return array  */
    private static function get_nav_tabs() {
        $nav_tabs[self::$menu['slug']] = ['slug'=> self::$menu['slug'], 'title'=>self::$menu['page']['title']];

        foreach(self::$menu['sub_menus'] as $sub_menu){
            $nav_tabs[$sub_menu['slug']] = ['slug'=> $sub_menu['slug'], 'title'=>$sub_menu['page']['title']];
        }        
        return $nav_tabs;        
    }

    /**
     * @param Menu $sub_menu 
     * @return void 
     */
    private static function add_sub_menu_page(Menu $sub_menu)
    {
        add_submenu_page(
            self::$menu['slug'],
            $sub_menu['page']['title'], 
            $sub_menu['title'], 
            $sub_menu['capability'], 
            $sub_menu['slug'],
            array($sub_menu['page'], 'content_callback'), 
            $sub_menu['position']
        );
        $sub_menu['page']->add_admin_init();
    }
}