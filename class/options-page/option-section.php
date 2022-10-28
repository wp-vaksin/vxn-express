<?php
namespace VXN\Express\Core\Options_page;

use VXN\Express\Core\Abstracts\Section;

/**
 * WordPress Page Section Class 
 * @package VXN\Express\Core\Options_page
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.1 change class name from Section to Option_Section, extend Section
 * @since 1.0.0
 */
class Option_Section extends Section  {

    /** @return void  */
    public function section_info_callback(): void {
        echo  $this->info ? esc_textarea($this->info) : '';
    }
}