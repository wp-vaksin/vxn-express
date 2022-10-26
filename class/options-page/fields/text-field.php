<?php
namespace VXN\Express\Core\Options_page\Fields;

use VXN\Express\Core\Options_page\Abstracts\Field;

/**
 * Text input field for option page 
 * @package VXN\Express\Core\Options_page\Fields
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Text_field extends Field {
    
    /** @var string $placeholder Text that will be shown inside of input. */
    protected $placeholder;
    
    /** @var string $pattern Pattern format of input text. */
    protected $pattern;

    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {
        $this->type = 'text';
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
    
    /**
     * @param string $pattern 
     * @return $this 
     */
    public function set_pattern($pattern) {
        $this->pattern = $pattern;
        return $this;
    }

    /** {@inheritdoc} */
    protected function render(): void {
        $placeholder = $this->placeholder ? 'placeholder="' . esc_attr($this->placeholder) . '"' : '';
        $pattern = $this->pattern ? 'pattern="' . esc_attr($this->pattern) . '"' : '';        

        printf(
            '<input class="regular-text" type="text" name="%s" id="%s" value="%s" %s %s>',
            esc_attr($this->name),
            esc_attr($this->id),
            esc_attr($this->value),
            esc_html($placeholder),
            esc_html($pattern)
        );
    }    
}