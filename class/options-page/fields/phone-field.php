<?php
namespace VXN\Express\Core\Options_page\Fields;

use VXN\Express\Core\Options_page\Abstracts\Field;

/**
 * Phone input field for option page 
 * @package VXN\Express\Core\Options_page\Fields
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Phone_Field extends Field {
    
    /** @var string $placeholder Text that will be shown inside of input. */
    protected $placeholder;

    /** @var string $pattern Pattern format of input phone. */
    protected $pattern;
    
    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {
        $this->type = 'phone';
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
        $placeholder = $this->placeholder ? 'placeholder="' . $this->placeholder . '"' : '';
        $pattern = $this->pattern ? 'pattern="' . $this->pattern . '"' : '';

        echo <<<EOT
            <input class="regular-text" type="tel" name="$this->name" id="$this->id" value="$this->value" $placeholder $pattern>
        EOT;
    }
}