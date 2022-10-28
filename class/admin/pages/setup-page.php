<?php
namespace VXN\Express\Core\Admin\Pages;

use VXN\Express\Core\Options_page\Fields\Text_field;
use VXN\Express\Core\Options_page\Abstracts\Page;
use VXN\Express\Core\Options_page\Option_Section;

/**
 * Setup Admin Page
 * @package VXN\Express\Core\Admin\Pages
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */ 
class Setup_Page extends Page {

    /** @return void  */
    public function __construct()
    {        
        $this->title = __('Setup', 'vxn-express');

        $setup_page_sections['main'] = $this->main_setup_section();

        $setup_page_sections = apply_filters('setup_page_sections', $setup_page_sections);

        foreach($setup_page_sections as $section){
            $this->add_section($section);
        }
    }
    
    /** @return Option_Section  */
    private function main_setup_section(){
        return (new Option_Section('setup'))
            ->add_hr_bottom()
            ->add_field((new Text_field('txt-phone-format'))            
                ->set_title(__('Phone Display Format', 'vxn-express')));
            
    }
}