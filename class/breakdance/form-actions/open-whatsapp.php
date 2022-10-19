<?php
namespace VXN\Express\Core\Breakdance\Form_Actions;

use Breakdance\Forms\Actions\Action;

use function Breakdance\PluginsAPI\debug;

class Open_Whatsapp extends Action{

    /**
     * Get the displayable label of the action.
     * @return string
     */
    public static function name()
    {
        return 'Open WhatsApp';
    }

    /**
     * Get the URL friendly slug of the action.
     * @return string
     */
    public static function slug()
    {
        return 'vxn_open_whatsapp';
    }

    public function run($form, $settings, $extra)
    {
        // Do nothing on purpose, log the JS that was executed
        // $this->addContext('JavaScript', $settings['actions']['custom_javascript']);
        echo 'window.vxn_onFormSuccess();';
        return ['type' => 'success'];
    }

}