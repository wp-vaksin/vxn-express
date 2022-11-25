<?php
namespace VXN\Express\Fields;

/**
 * Class Checkbox field 
 * @package VXN\Express\Fields
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
class Checkbox extends Field{
    /** @var string $text_right */
    protected $text_right;

    /**
     * @inheritDoc
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

    /**
     * @inheritDoc
     */
    public function get_sanitized_value(){
        return sanitize_text_field($this->value);
    }      

}