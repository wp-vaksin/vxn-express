<?php
namespace VXN\Express\Core;

use VXN\Express\Core\Breakdance\Dynamic_Data\Dynamic_Fields;

/**
 * Breakdance register 
 * @package VXN\Express\Core 
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Breakdance {
    
    /** @return void  */
    public static function register() {	
		Dynamic_Fields::register();	
    }
}