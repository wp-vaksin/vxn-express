<?php
namespace VXN\Express\Core\Options_page;

use VXN\Express\Core\Options_page\Abstracts\Array_Access;
use VXN\Express\Core\Options_page\Abstracts\Page;

/**
 * WordPress Admin Menu Class 
 * @package VXN\Express\Core\Options_page
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Menu extends Array_Access  {
    
    /** 
     * @var string $slug he slug name to refer to this menu by. 
     * Should be unique for this menu page and only include lowercase alphanumeric, dashes, 
     * and underscores characters to be compatible with sanitize_key(). 
     */
    protected $slug;

    /** @var string $title The text to be used for the menu. */
    protected $title;

    /** @var string $icon The URL to the icon to be used for this menu. */
    protected $icon;

    /**
     * @var string $capability The capability required for this menu to be displayed to the user. 
     * @default 'manage_options'
    */
    protected $capability = 'manage_options';

    /** @var int|float $position The position in the menu order this item should appear.. */
    protected $position;

    /** @var Page $page The page of the menu. */
    protected $page;

    /** @var array $sub_menus Array of submenu of the menu. */
    protected $sub_menus = [];

    /**
     * @param string $slug 
     * @return void 
     */
    public function __construct($slug) {
        $this->slug = $slug;
    }
    
    /**
     * @param string $icon 
     * @return $this 
     */
    public function set_icon($icon) {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param string $title 
     * @return $this 
     */
    public function set_title($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @param Menu $sub_menu 
     * @return $this 
     */
    public function add_sub_menu( Menu $sub_menu ) {
        $this->sub_menus[$sub_menu['slug']] = $sub_menu;
        return $this;
    }
    
    /**
     * @param Page $page 
     * @return $this 
     */
    public function set_page(Page $page) {
        $page->set_menu_slug($this->slug);
        $this->page = $page;
        return $this;
    }    

    /**
     * @param int|float $position 
     * @return $this 
     */
    public function set_position($position) {
        $this->position = $position;
        return $this;
    }    

    /** @return void  */
    public function get_nav_tabs_html(){
        $nav_tabs = [];

        foreach($this->sub_menus as $sub_menu){
            $nav_tabs[] = ['slug'=> $sub_menu['slug'], 'title'=>$sub_menu['page']['title']];
        }
  
        echo '<nav class="nav-tab-wrapper">';
        foreach($nav_tabs as $tab) {
            printf('<a href="?page=%s" class="nav-tab %s">%s</a>', 
                $tab['slug'], 
                $tab['slug'] == $this->slug ? 'nav-tab-active' : '',
                $tab['title']
            );
        }
        echo '</nav>';          
    }
}