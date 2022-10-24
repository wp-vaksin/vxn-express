<?php
namespace VXN\Express\Core\Options_page\Abstracts;

/**
 * Abstract class for option field 
 * @package VXN\Express\Core\Options_page\Abstracts
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
abstract class Field extends Array_Access {
    
    /** @var string $id ID of input field. */
    protected $id;
    
    /** @var string $type Type of input field. */
    protected $type;

    /** @var string $name Field name, will be used as option name. */
    protected $name;

    /** @var string $title Field label, will be shown at the left of input. */
    protected $title;

    /** @var string $value Field value, will be shown inside of input. */
    protected $value;

    /** @var string $description Field description, will be shown in the below of input. */
    protected $description;

    /** @var string $class TR class. */
    protected $class;
    
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