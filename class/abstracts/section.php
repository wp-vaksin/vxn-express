<?php
namespace VXN\Express\Core\Abstracts;

use VXN\Express\Core\Abstracts\Array_Access;
use VXN\Express\Core\Abstracts\Field;

/**
 * WordPress Page Section Class 
 * @package VXN\Express\Core\Abstracts
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.1
 */
abstract class Section extends Array_Access  {

    /** @var string $id The ID of the section */    
    protected $id;

    /** @var string $title The title of the section */
    protected $title;

    /** @var string $info The information of the section, will shown below of the title */
    protected $info;

    /** @var array $fields Fields in the section */
    protected $fields = [];

    /** @var bool $hr_top The horizontal line on top of section */
    protected $hr_top = false;

    /** @var bool $hr_bottom The horizontal line on bottom of section */
    protected $hr_bottom = false;
    
    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @param string $title 
     * @return $this 
     */
    public function set_title($title){
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $info 
     * @return $this 
     */
    public function set_info($info){
        $this->info = $info;
        return $this;
    }

    /**
     * @param Field $field 
     * @return $this 
     */
    public function add_field( Field $field ) {
        $this->fields[$field['id']] = $field;
        return $this;
    }

    /** @return $this  */
    public function add_hr_Top() {
        $this->hr_top = true;
        return $this;
    }
    
    /** @return $this  */
    public function add_hr_bottom() {
        $this->hr_bottom = true;
        return $this;
    }
}