<?php
namespace VXN\Express\Core\Options_page\Fields;

use VXN\Express\Core\Options_page\Abstracts\Field;

/**
 * Email input field for option page 
 * @package VXN\Express\Core\Options_page\Fields
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Email_Field extends Field {

    /** @var string $placeholder Text that will be shown inside of input. */
    protected $placeholder;
    
    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {
        $this->type = 'email';
        parent::__construct($id);
    }

    /**
     * @param string $placeholder 
     * @return $this 
     */
    public function set_placeholder($placeholder) {
        $this->placeholder = $placeholder;
        return $this;
    }
    
    /** {@inheritdoc} */
    protected function render(): void {
        $placeholder = $this->placeholder ? 'placeholder="' . esc_attr($this->placeholder) . '"' : '';

        printf(
            '<input class="regular-text" type="email" name="%s" id="%s" value="%s" %s>',
            esc_attr($this->name),
            esc_attr($this->id),
            esc_attr($this->value),
            esc_html($placeholder)
        );
            
        
    }
}