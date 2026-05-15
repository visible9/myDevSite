<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'popup-button';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title'       => __('Popup Button', 'base-theme'),
    'description' => __('A button that opens a popup overlay.', 'base-theme'),
    'category'    => 'custom',
    'icon'        => 'button',
    'supports'    => [
        'mode'   => false,
        'align'  => false,
        'anchor' => true,
    ],
];
