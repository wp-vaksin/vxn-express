<?php

add_action(
    'breakdance_register_template_types_and_conditions',
    function() {

        \Breakdance\ConditionsAPI\register(
            [
                'supports' => ['element_display'],
                'slug' => 'vxn-show-wa-form', // MUST BE UNIQUE
                'label' => 'Show WhatsApp Form',
                'category' => 'Express Add On',
                'operands' => ['is'],

                // providing a dropdown of values is optional. if 'values' is not provided, a text input will be provided instead of a dropdown
                'values' => function() { return [
                    [
                        'label' => 'Show Form',
                        'items' => [
                            [
                                'text' => 'True',
                                'value' => true
                            ],
                            [
                                'text' => 'False',
                                'value' => False
                            ]
                        ]
                    ]
                ]; },

                /*
                when specifying possible values for a dropdown,
                you can optionally make the dropdown a multiselect
                */
                // 'allowMultiselect' => false,

                /*
                this function will be called to evaluate the condition
                if it returns true, the element will be shown
                if it returns false, the element will be hidden
                */
                'callback' => function(string $operand, $value) {

                    if ($operand === 'is') {
                        return $value;
                    }
                    
                    return false;

                    $myVal = 'item-1'; // usually, you'd get $myVal from somewhere, i.e. global $post; $myVal = $post->ID;

                    /*
                    if allowMultiselect is false, $value will be a string.
                    use it like so:

                    if ($operand === 'equals') {
                        return $myVal === $value;
                    }

                    if ($operand === 'not equals') {
                        return $myVal !== $value;
                    }
                    */

                    /*
                    in our example, allowMultiselect is true, which means $value will be an array of strings
                    */
                    if ($operand === 'equals') {
                        return in_array($myVal, $value);
                    }

                    if ($operand === 'not equals') {
                        return !in_array($myVal, $value);
                    }

                    return false;
                },
            ]
        );

    }
);