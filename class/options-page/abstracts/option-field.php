<?php
namespace VXN\Express\Core\Options_page\Abstracts;

use VXN\Express\Core\Abstracts\Field;

/**
 * Abstract class for option field 
 * @package VXN\Express\Core\Options_page\Abstracts
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.1 extend from Field
 */
abstract class Option_Field extends Field {
    
    /** @return void  */
    public function render_callback (): void {
        $this->render();

        if($this->description){
            echo '<p class="description">' . esc_textarea($this->description) . '</p>';
        }
    }

    /** @return void  */
    abstract protected function render(): void;
}