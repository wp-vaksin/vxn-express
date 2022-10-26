<?php
namespace VXN\Express\Core\Admin\Pages;

use VXN\Express\Core\Options_page\Fields\Text_field;
use VXN\Express\Core\Options_page\Abstracts\Page;
use VXN\Express\Core\Options_page\Section;

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
        $this->title = 'Setup';
        // $this->description = 'no description';
        
        $this
            ->add_section($this->main_setup_section());
    }
    
    /** @return Section  */
    private function main_setup_section(){
        return (new Section('setup'))
            // ->set_title('Contact Detail')
            // ->add_hr_bottom()
            
            ->add_field((new Text_field('txt-phone-format'))            
                ->set_title(__('Phone Display Format', 'vxn-express')));
            
    }
}