<?php
namespace VXN\Express\Core;
//  @example "3|0xxx-xxx-xxxxx" the result is 0812-2000-3131 for $phone +6281220003131
/**
 * Class of utility static functions
 * @package VXN\Express\Core 
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Util {    

    /**
     * To format phone number
     * <code>
     * $formated
     * </code>
     * @param string $phone  Example: +6281220003131
     * @param string $format Example: 3|0xxx-xxxx-xxxxx
     * @return string Result from example: 0812-2000-3131
     */
    public static function format_phone($phone, $format){
        
        if(!$format) {
            return $phone;
        }

        $opts = explode('|', $format);        
        $start = 0;
        
        if(count($opts)>1) {
            $start = intval($opts[0]);
            $format = $opts[1];
        }

        $arr_format = str_split($format);
        $arr_phone = str_split($phone);

        $i = $start;
        $result = '';

        foreach($arr_format as $value){
            if($value == 'x'){
                if($i >= count($arr_phone)){
                    break;
                }

                $result .= $arr_phone[$i];

                $i += 1;
            } else {
                $result .= $value;
            }
        }

        if($i <= count($arr_phone)){
            $result .= substr($phone, $i);
        }

        return $result;
    }
}
