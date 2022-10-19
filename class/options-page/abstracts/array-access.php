<?php
namespace VXN\Express\Core\Options_page\Abstracts;

/**
 * Abstract class for implement ArrayAccess 
 * @package VXN\Express\Core\Options_page\Abstracts
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
abstract class Array_Access implements \ArrayAccess  {
    
    /**
     * @param mixed $offset 
     * @return bool 
     */
    public function offsetExists($offset): bool {
        return property_exists($this, $offset);
    }

    /**
     * @param mixed $offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * @param mixed $offset 
     * @param mixed $value 
     * @return void 
     */
    public function offsetSet($offset, $value): void {
        $this->$offset = $value;
    }

    /**
     * @param mixed $offset 
     * @return void 
     */
    public function offsetUnset($offset): void {
        unset($this->$offset);
    }
}