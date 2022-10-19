<?php
namespace VXN\Express\Core\Options_page\Fields;

use VXN\Express\Core\Options_page\Abstracts\Field;

/**
 * Textarea input field for option page 
 * @package VXN\Express\Core\Options_page\Fields
 * @author Vaksin <dev@vaks.in>
 * @version 1.0.0
 */
class Text_Area extends Field {

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
        echo <<<EOT
            <textarea rows="$this->rows" cols="$this->cols" name="$this->name" id="$this->id" %s class="$this->id"/>$this->value</textarea>
        EOT;

    }
}