<?php
namespace VXN\Express\Core\Options_page\Fields;

use VXN\Express\Core\Options_page\Abstracts\Field;

/**
 * Checkbox input field for option page 
 * @package VXN\Express\Core\Options_page\Fields
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Checkbox extends Field {

    /** @var string $text_right Text that will be shown at the rigth of checkbox. */
    protected $text_right;
    
    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {
        $this->type = 'checkbox';
        parent::__construct($id);
    }

    /**
     * @param string $text_right 
     * @return $this 
     */
    public function set_text_right($text_right){
        $this->text_right = $text_right;
        return $this;
    }


    /** {@inheritdoc} */
    protected function render(): void {
        $checked = $this->value ? 'checked="checked"' : '';

        echo <<<EOT
            <label for="$this->id"><input type="checkbox" id="$this->id" name="$this->name" value="1" $checked />$this->text_right</label>
        EOT;
    }
}