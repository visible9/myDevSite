<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'tab-item';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Tab Item', 'base-theme'),
    'description' => __('Single tab content item.', 'base-theme'),
    'category' => 'custom',
    'icon' => 'minus',
    'parent' => ['acf/tabs-block'],
    'supports' => [
        'mode' => false,
        'align' => false,
        'anchor' => true,
        'jsx' => true,
    ],
];

$controller = function ($block_attributes) {
    return array_merge($block_attributes, []);
};
