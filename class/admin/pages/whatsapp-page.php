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
 * @version 1.0.0
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
            ->set_title('Setting WhatsApp')
            ->add_hr_bottom()
            ->add_field(
                (new Phone_Field('txt-wa-no'))            
                ->set_title('No. WhatsApp')
                ->set_description('Isi dengan no nomor WhatsApp lengkap, contoh: 628123456789')
                ->set_placeholder('628123456789')
            )
            ->add_field(
                (new Checkbox('chk-show-form'))
                ->set_title('Show Form')
                ->set_text_right('Tampilkan form sebelum memanggil WhatsApp')
            );        
    }

    /** @return Section  */
    protected function template_section() {
        return (new Section('template'))
            ->set_title('Text Template')
            ->add_hr_bottom()       
            ->add_field(
                (new Text_Area('txt-wa-text-default'))            
                ->set_title('Default Text')
            )
            ->add_field(
                (new Text_Area('txt-wa-text-order'))            
                ->set_title('Order Text')
            )
            ->add_field(
                (new Text_Area('txt-wa-text-consult'))            
                ->set_title('Konsultasi')
            )
            ->add_field(
                (new Text_Area('txt-wa-text-consult-product'))            
                ->set_title('Konsultasi Produk')
            )
            ->add_field(
                (new Text_Area('txt-wa-text-appointment'))            
                ->set_title('Appointment')
            );
    }      

}