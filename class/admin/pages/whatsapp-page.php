<?php
namespace VXN\Express\Core\Admin\Pages;

use VXN\Express\Core\Options_page\Abstracts\Page;
use VXN\Express\Core\Options_page\Fields\Checkbox;
use VXN\Express\Core\Options_page\Fields\Phone_Field;
use VXN\Express\Core\Options_page\Fields\Text_Area;
use VXN\Express\Core\Options_page\Section;

/**
 * WhatsApp Admin Page
 * @package VXN\Express\Core\Admin\Pages
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */ 
class Whatsapp_Page extends Page {

    /** @return void  */
    public function __construct()
    {        
        $this->title = 'WhatsApp';

        $this
            ->add_section($this->settings_section())
            ->add_section($this->template_section());        
    }
    
    /** @return Section  */
    protected function settings_section() {
        return (new Section('settings'))
            ->set_title(__('WhatsApp Setting', 'vxn-express'))
            ->add_hr_bottom()
            ->add_field(
                (new Phone_Field('txt-wa-no'))            
                ->set_title(__('WhatsApp Number', 'vxn-express'))
                ->set_description(__('Fill in with the complete WhatsApp number e.g. 6281220003131', 'vxn-express'))
            )
            ->add_field(
                (new Checkbox('chk-show-form'))
                ->set_title(__('Show Form', 'vxn-express'))
                ->set_text_right(__('Show Popup form before redirect to WhatsApp', 'vxn-express'))
                ->set_description(__('You need to create Breakdance Popup for this function, please read our documentation', 'vxn-express'))
            );        
    }

    /** @return Section  */
    protected function template_section() {
        return (new Section('template'))
            ->set_title(__('Text Template', 'vxn-express'))
            ->add_hr_bottom()       
            ->add_field(
                (new Text_Area('txt-wa-text-default'))            
                ->set_title(__('Default Text', 'vxn-express'))
            )
            ->add_field(
                (new Text_Area('txt-wa-text-order'))            
                ->set_title(__('Order Text', 'vxn-express'))
            )
            ->add_field(
                (new Text_Area('txt-wa-text-consult'))            
                ->set_title(__('Consult Text', 'vxn-express'))
            )
            ->add_field(
                (new Text_Area('txt-wa-text-consult-product'))            
                ->set_title(__('Product Consult Text', 'vxn-express'))
            )
            ->add_field(
                (new Text_Area('txt-wa-text-appointment'))            
                ->set_title(__('Appointment Text', 'vxn-express'))
            );
    }      

}