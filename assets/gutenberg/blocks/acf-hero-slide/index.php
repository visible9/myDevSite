<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'hero-slide';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Slide', 'base-theme'),
    'description' => __('Slide for Hero Slider', 'base-theme'),
    'category' => 'custom',
    'icon' => 'format-image',
    'parent' => ['acf/hero-slider'],
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
