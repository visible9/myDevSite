<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'accordion-block';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Accordion Block', 'base-theme'),
    'description' => __('', 'base-theme'),
    'category' => 'custom',
    'icon' => 'menu',
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
