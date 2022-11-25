<?php
namespace VXN\Express\WP\Meta;

use VXN\Express\Fields\Field;
use VXN\Express\Fields\Checkbox;
use VXN\Express\Fields\Date_Field;
use VXN\Express\Fields\Email_Field;
use VXN\Express\Fields\Number_Field;
use VXN\Express\Fields\Select_Field;
use VXN\Express\Fields\Text_Field;
use VXN\Express\Fields\URL_Field;

/** 
 * This class to render fields in metabox
 * @package VXN\Express\WP\Meta
 * @author Vaksin <dev@vaks.in>
 * @since 1.1
 */
class Meta_Renderer {

	/**
	 * @param int $post_id 
	 * @param Field $field 
	 * @return void 
	 */
	public static function render_field($post_id, Field $field) {
		switch(true){
			case is_a($field, Text_Field::class):
				self::text_field($post_id, $field);
				break;
			case is_a($field, Select_Field::class):
				self::select_field($post_id, $field);
				break;	
			case is_a($field, Date_Field::class):
				self::date_field($post_id, $field);
				break;
			case is_a($field, Checkbox::class):
				self::checkbox($post_id, $field);
				break;
			case is_a($field, Number_Field::class):
				self::number_field($post_id, $field);
				break;                    
			case is_a($field, Email_Field::class):
				self::email_field($post_id, $field);
				break;
            case is_a($field, URL_Field::class):
                self::url_field($post_id, $field);
                break;                  
			default:
				break;
		}			
	}	

    /** @return void  */
    public static function open_section(){
        echo '<table class="form-table"><tbody>';
    }

    /** @return void  */
    public static function close_section(){
        echo '</tbody></table>';
    }

    /**
     * @param int $post_id 
     * @param Field $field 
     * @return void 
     */
    private static function text_field($post_id, Field $field) {
        $value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<input 
					type="text" 
					id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'" 
					value="' . esc_attr( $value ) . '" ' .
					($field['class'] ? 'class="' . esc_attr($field['class']) . '" ' : '' ) .
				'>
			</td>
		</tr>';		
	}

    /**
     * @param int $post_id 
     * @param Field $field 
     * @return void 
     */
    private static function url_field($post_id, Field $field) {
        $value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<input 
					type="url" 
					id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'" 
					value="' . esc_attr( $value ) . '" ' .
					($field['class'] ? 'class="' . esc_attr($field['class']) . '" ' : '' ) .
				'>
			</td>
		</tr>';		
	}

    /**
     * @param int $post_id 
     * @param Field $field 
     * @return void 
     */
    private static function number_field($post_id, Field $field) {
        $value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<input 
					type="number" ' . 
					($field['min'] ? 'min="' . $field['min'] . '" ' : '' ) .
					($field['max'] ? 'max="' . $field['max'] . '" ' : '' ) .
					'id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'" 
					value="' . esc_attr( $value ) . '" ' .
					($field['class'] ? 'class="' . esc_attr($field['class']) . '" ' : '' ) .
				'>
			</td>
		</tr>';		
	}	

    /**
     * @param int $post_id 
     * @param Field $field 
     * @return void 
     */
    private static function email_field($post_id, Field $field) {
        $value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<input 
					type="email" 
					id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'" 
					value="' . esc_attr( $value ) . '" ' .
					($field['class'] ? 'class="' . esc_attr($field['class']) . '" ' : '' ) .
				'>
			</td>
		</tr>';		
	}	

	/**
	 * @param int $post_id 
	 * @param Field $field 
	 * @return void 
	 */
	private static function select_field($post_id, Field $field){
        $value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<select 
					id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'">
					<option value="">' . __('Select...', VXN_EXPRESS_DOMAIN) . '</option>';

					foreach($field['options'] as $key => $label){
						echo '<option value="' . esc_attr($key) .'"' . selected( $key, $value, false ) . '>' . esc_html($label) .'</option>';
					}
		
		echo '
				</select>
			</td>
		</tr>';		
	}

    /**
     * @param int $post_id 
     * @param Field $field 
     * @return void 
     */
    private static function date_field($post_id, Field $field){
        $value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<input 
					type="date" ' .
                    ($field['min'] ? 'min="' . $field['min'] . '" ' : '' ) .
					($field['max'] ? 'max="' . $field['max'] . '" ' : '' ) .
					'id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'" 
					value="' . esc_attr( $value ) . '" ' .
					($field['class'] ? 'class="' . esc_attr($field['class']) . '" ' : '' ) .
				'>
			</td>
		</tr>';		
	}

	/**
	 * @param int $post_id 
	 * @param Field $field 
	 * @return void 
	 */
	private static function checkbox($post_id, Field $field){
		$value = get_post_meta( $post_id, $field['id'], true ) ? : $field['default'];

		echo '
		<tr>
			<th><label for="' . esc_attr($field['id']) .'">' . esc_html($field['title'])  .'</label></th>
			<td>
				<input 
					type="checkbox" 
					id="' . esc_attr($field['id']) .'" 
					name="' . esc_attr($field['id']) .'" 
					value="1" ' . 
					($value ? 'checked="checked" ' : '') . 
				'/>
				<label for="' . esc_attr($field['id']) .'">' .	$field['text_right'] . '</label>
			</td>
		</tr>';
	}
}