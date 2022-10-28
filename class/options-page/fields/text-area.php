<?php
namespace VXN\Express\Core\Options_page\Fields;

use VXN\Express\Core\Options_page\Abstracts\Option_Field;

/**
 * Textarea input field for option page 
 * @package VXN\Express\Core\Options_page\Fields
 * @author Vaksin <dev@vaks.in>
 * @since 1.0.0
 */
class Text_Area extends Option_Field {

    /** @var int $rows Display rows of textare. */
    protected $rows = 7;

    /** @var int $cols Display columns of textare. */
    protected $cols = 60;

    /**
     * @param string $id 
     * @return void 
     */
    public function __construct($id) {
        $this->type = 'textarea';
        parent::__construct($id);
    }

    /**
     * @param int $rows 
     * @return $this 
     */
    public function set_rows($rows) {
        $this->rows = $rows;
        return $this;
    }

    /**
     * @param int $cols 
     * @return $this 
     */
    public function set_cols($cols) {
        $this->cols = $cols;
        return $this;
    }

    /** {@inheritdoc} */
    protected function render(): void {
        printf(
            '<textarea rows="%s" cols="%s" name="%s" id="%s" />%s</textarea>',
            esc_attr($this->rows),
            esc_attr($this->cols),
            esc_attr($this->name),
            esc_attr($this->id),
            esc_textarea($this->value)
        );

    }
}