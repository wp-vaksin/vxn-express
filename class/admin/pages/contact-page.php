<?php
namespace VXN\Express\Core\Admin\Pages;

use VXN\Express\Core\Options_page\Abstracts\Page;
use VXN\Express\Core\Options_page\Fields\Email_Field;
use VXN\Express\Core\Options_page\Fields\Phone_Field;
use VXN\Express\Core\Options_page\Fields\Text_Area;
use VXN\Express\Core\Options_page\Fields\Text_field;
use VXN\Express\Core\Options_page\Section;

/**
 * Contact Admin Page
 * @package VXN\Express\Core\Admin\Pages
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */ 
class Contact_Page extends Page {

    /** @return void  */
    public function __construct()
    {        
        $this->title = 'Contact';
        // $this->description = 'no description';

        $this
            ->add_section($this->contact_detail_section())
            // ->add_section($this->adress_section())
            ->add_section($this->sosmed_section());
    }
    
    /** @return Section  */
    private function contact_detail_section(){
        return (new Section('contact'))
            ->set_title(__('Contact Detail', 'vxn-express'))
            ->add_hr_bottom()
            ->add_field((new Phone_Field('txt-phone'))            
                ->set_title(__('Phone', 'vxn-express'))
                ->set_description(__('Fill in with the complete telephone number e.g. +6281220003131', 'vxn-express')))
            ->add_field((new Email_Field('txt-email'))
                ->set_title(__('Email', 'vxn-express')))
            ->add_field((new Text_Area('txt-address'))
                ->set_title(__('Address', 'vxn-express')))
            ->add_field((new Text_field('txt-place'))
                ->set_title(__('Google Business Profile Name', 'vxn-express')));

    }

    /** @return Section  */
    private function sosmed_section(){
        return (new Section('sosmed'))
            ->set_title(__('Social Media', 'vxn-express'))
            ->add_field((new Text_Field('txt-facebook'))            
                ->set_title(__('Facebook URL', 'vxn-express')))
            ->add_field((new Text_Field('txt-instagram'))            
                ->set_title(__('Instagram URL', 'vxn-express')))
            ->add_field((new Text_Field('txt-twitter'))            
                ->set_title(__('Twitter URL', 'vxn-express')))
            ->add_field((new Text_Field('txt-youtube'))            
                ->set_title(__('Youtube URL', 'vxn-express')))        
            ->add_field((new Text_Field('txt-linkedin'))
                ->set_title(__('LinkedIn URL', 'vxn-express')));       
    }
}