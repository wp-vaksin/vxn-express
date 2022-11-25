<?php
namespace VXN\Express\WP\Taxonomy;

use ArrayAccess;
use VXN\Express\Array_Access;

/** 
 * Class Taxonomy
 * @package VXN\Express\WP\Taxonomy
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
class Taxonomy implements ArrayAccess {
use Array_Access;
    
    /** @var string $taxonomy */
    protected $taxonomy;

    /** @var array $object_type default [] */
    protected $object_type = [];

    /** @var string $name */
    protected $name;

    /** @var string $singular_name */
	protected $singular_name;

    /** @var string $menu_name */
    protected $menu_name;

    /** @return void  */
    public function __construct($taxonomy, $name, $singular_name, $menu_name) {
        $this->taxonomy = $taxonomy;
        $this->name = $name;
        $this->singular_name = $singular_name;
        $this->menu_name = $menu_name;
    }

    /**
     * @param string|array $object_type 
     * @return $this 
     */
    public function add_object_type($object_type){
        if(is_array($object_type)){
            $this->object_type = array_merge($this->object_type, $object_type);
        }else{
            $this->object_type[] = $object_type;
        }
        
        return $this;
    }
}