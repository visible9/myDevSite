<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'tabs';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Tabs', 'base-theme'),
    'description' => __('Group of Tabs', 'base-theme'),
    'category' => 'custom',
    'icon' => 'welcome-widgets-menus',
    'supports' => [
        'mode' => false,
        'align' => ['wide', 'full'],
        'anchor' => true,
        'jsx' => true,
    ],
];

$controller = function ($block_attributes) {
    return array_merge($block_attributes, []);
};
