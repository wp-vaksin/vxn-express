<?php
namespace VXN\Express\Core\Admin\Pages;

use VXN\Express\Core\Options_page\Fields\Text_field;
use VXN\Express\Core\Options_page\Abstracts\Page;
use VXN\Express\Core\Options_page\Fields\Email_Field;
use VXN\Express\Core\Options_page\Fields\Phone_Field;
use VXN\Express\Core\Options_page\Fields\Text_Area;
use VXN\Express\Core\Options_page\Section;

/**
 * Contact Admin Page
 * @package VXN\Express\Core\Admin\Pages
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */ 
class Contact_Page extends Page {

    /** @return void  */
    public function __construct()
    {        
        $this->title = 'Contact';
        // $this->description = 'no description';

        $this
            ->add_section($this->contact_detail_section())
            ->add_section($this->sosmed_section());

    }
    
    /** @return Section  */
    private function contact_detail_section(){
        return (new Section('contact'))
            ->set_title('Contact Detail')
            ->add_hr_bottom()
            ->add_field((new Phone_Field('txt-phone'))            
                ->set_title('No. Telepon'))
            ->add_field((new Email_Field('txt-email'))
                ->set_title('Email'))
            ->add_field((new Text_Area('txt-address'))
                ->set_title('Alamat'));
    }

    /** @return Section  */
    private function sosmed_section(){
        return (new Section('sosmed'))
            ->set_title('Sosial Media')
            ->add_field((new Text_Field('txt-facebook'))            
                ->set_title('Facebook URL'))
            ->add_field((new Text_Field('txt-instagram'))            
                ->set_title('Instagram URL'))
            ->add_field((new Text_Field('txt-twitter'))            
                ->set_title('Twitter URL'))
            ->add_field((new Text_Field('txt-youtube'))            
                ->set_title('Youtube URL'))        
            ->add_field((new Text_Field('txt-linkedin'))
                ->set_title('LinkedIn URL'));       
    }
}