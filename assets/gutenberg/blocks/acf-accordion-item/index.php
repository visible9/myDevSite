<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'accordion-item';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Accordion Item', 'base-theme'),
    'description' => __('', 'base-theme'),
    'category' => 'custom',
    'icon' => 'minus',
    'parent' => ['acf/accordion'],
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
