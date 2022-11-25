<?php
namespace VXN\Express;

/**
 * This trait for class who implement ArrayAccess 
 * @package VXN\Express
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
trait Array_Access  {
    
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