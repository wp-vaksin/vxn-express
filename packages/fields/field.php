<?php
namespace VXN\Express\Fields;

use ArrayAccess;
use VXN\Express\Array_Access;

/**
 * Abstract Class Fields 
 * @package VXN\Express\Fields
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
abstract class Field implements ArrayAccess {
use Array_Access;
    
    /** @var string $id */
    protected $id;
    
    /** @var string $type */
    protected $type;

    /** @var string $name */
    protected $name;

    /** @var string $title */
    protected $title;

    /** @var string $value */
    protected $value;

    /** @var string $default */
    protected $default;    

    /** @var string $placeholder */
    protected $placeholder;

    /** @var string $description */
    protected $description;

    /** @var bool $disabled default = false */
    protected $disabled = false;

    /** @var string $class */
    protected $class;

    /** @return mixed  */
    abstract public function get_sanitized_value();
    
    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {        
        $this->id = $id;        
    }

    /**
     * @param string $name 
     * @return void 
     */
    public function set_name($name) {
        $this->name = $name;
    }
    
    /**
     * @param string $title 
     * @return $this 
     */
    public function set_title($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $value 
     * @return $this 
     */
    public function set_value($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $value 
     * @return $this 
     */
    public function set_default_value($value) {
        $this->default = $value;
        return $this;
    }    

    /**
     * @param string $value 
     * @return $this 
     */
    public function set_placeholder($placeholder) {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @param string $description 
     * @return $this 
     */
    public function set_description($description) {
        $this->description = $description;
        return $this;
    } 
    
    /**
     * @param string $class 
     * @return $this 
     */
    public function set_class($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * @param bool $disabled 
     * @return $this 
     */
    public function set_disabled(bool $disabled) {
        $this->disabled = $disabled;
        return $this;
    }    
}