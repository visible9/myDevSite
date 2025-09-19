<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'example-block';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Example ACF Block', 'base-theme'),
    'description' => __('ACF example block.', 'base-theme'),
    'category' => 'custom',
    'icon' => 'block-default',
    'supports' => [
        'mode' => false,
        'align' => ['wide', 'full'],
        'anchor' => true,
    ],
];

$controller = function ($block_attributes) {
    return array_merge($block_attributes, []);
};
