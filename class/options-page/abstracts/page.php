<?php
namespace VXN\Express\Core\Options_page\Abstracts;

use VXN\Express\Core\Options_page\Section;

/**
 * Abstract class for option page 
 * @package VXN\Express\Core\Options_page\Abstracts
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Page extends Array_Access  {
    
    /** @var string $title Page title. */
    protected $title;

    /** @var string $description Page description. */
    protected $description;

    /** @var array $arr_tabs array of nav tabs. */
    protected $arr_tabs = [];

    /** @var string $menu_slug Menu slug for this page. */
    protected $menu_slug;

    /** @var string $option_group Option Group, should be automatically set based on Menu slug. */
    protected $option_group;

    /** @var string $option_name Option Name, should be automatically set based on Menu slug. */
    protected $option_name;

    /** @var string $slug Page slug, should be automatically set based on Menu slug. */
    protected $slug;

    /** @var array $sections array of sections on this page. */
    protected $sections = [];

    /** @var array $options array of options related this page. get the values from get_options(). */
    protected $options = [];

    
    /**
     * @param string $menu_slug 
     * @return $this 
     */
    public function set_menu_slug($menu_slug){
        $this->menu_slug = $menu_slug;
        $this->option_group = str_replace('-', '_', $menu_slug) . '_option_group';
        $this->option_name = str_replace('-', '_', $menu_slug) . '_options';
        $this->slug = $menu_slug . '-page';

        $this->options = get_option($this->option_name);
        return $this;
    }

    /**
     * @param array $arr_tabs 
     * @return $this 
     */
    public function set_arr_tabs($arr_tabs){
        $this->arr_tabs = $arr_tabs;
        return $this;
    }    

    /**
     * @param Section $section 
     * @return $this 
     */
    public function add_section(Section $section){
        $this->sections[$section['id']] = $section;
        return $this;
    }

    /** @return void  */
    public function add_admin_init() {
        add_action( 'admin_init', array( $this, 'admin_init_callback' ) );  
    }    
    

    /** @return void  */
    public function content_callback() {

        // open div
        echo '<div class="wrap">';
        
        //title
        echo '<h1>' . esc_html($this->title) . '</h1>';

        //description 
        echo $this->description ? '<p>'. sanitize_text_field($this->description) . '</p>' : '';

        // start nav tabs
        echo '<nav class="nav-tab-wrapper">';
        foreach($this->arr_tabs as $tab) {
            $active_class = $tab['slug'] == $this->menu_slug ? 'nav-tab-active' : '';
            printf(
                '<a href="%s" class="nav-tab %s">%s</a>',
                esc_url('?page=' . $tab['slug']),
                esc_html($active_class),
                esc_html($tab['title'])
            ); 
        }
        echo '</nav>';
        // end nav tabs

        // start options form
        echo '<form method="post" action="options.php">';
            settings_fields( $this->option_group );
            do_settings_sections( $this->slug );
            submit_button();        
        echo '</form>';
        // end options form

        //close div
        echo '</div>';
    }
    
    /** @return void  */
    public function admin_init_callback ()  {
		register_setting(
			$this->option_group, // option_group
			$this->option_name, // option_name
			array( $this, 'sanitize_callback' ) // sanitize_callback
		);        

        foreach ( $this->sections as $section ) {
            if ($section['hr_top']){
                add_settings_section( $section['id'] . '_hr_top', '', function () {echo '<hr>';}, $this->slug );
            }

            add_settings_section(
                $section['id'], // id
                $section['title'], // title
                array( $section, 'section_info_callback' ), // callback
                $this->slug  // page
            );
            
            foreach ( $section['fields'] as $field ) {                
                $field['name'] = $this->option_name . '[' . $field['id'] . ']';

                if(isset($this->options[$field['id']])){
                    $field['value'] = $this->options[$field['id']];
                }
                
                add_settings_field(
                    $field['id'], // id
                    $field['title'], // title
                    array( $field, 'render_callback' ), // callback
                    $this->slug, // page
                    $section['id'], // section
                    array_merge(
                        ['label_for' => $field['id']], 
                        $field['class'] ? ['class' => $field['class']] : []
                    )
                );
            }

            if ($section['hr_bottom']){
                add_settings_section( $section['id'] . '_hr_bottom', '', function () {echo '<hr>';}, $this->slug);
            }
        } 
    }
    
    /**
     * @param array $input 
     * @return array 
     */
    public function sanitize_callback ( $input ) { 
		$sanitary_values = [];
        foreach ( $this->sections as $section ) { 
            foreach ( $section['fields'] as $field ) {
                $id = $field['id'];
                $type = $field['type'];
    
                if ( isset( $input[$id] ) ) {
                    if ( $type === 'text' ) {
                        $sanitary_values[$id] = sanitize_text_field( $input[$id] );
                    } elseif ( $type === 'textarea' ) {
                        $sanitary_values[$id] = esc_textarea( $input[$id] );
                    } elseif ( $type === 'email' ) {
                        $sanitary_values[$id] = sanitize_email( $input[$id] );
                    } elseif ( $type === 'phone' ) {
                        $sanitary_values[$id] = preg_replace( '/[^\d+]/', '', $input[$id] );
                    } else {
                        $sanitary_values[$id] = $input[$id];
                    } 
                }
            }
        }
		return $sanitary_values;
    } 
}