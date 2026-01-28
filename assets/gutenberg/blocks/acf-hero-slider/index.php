<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'hero-slider';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Hero Slider', 'base-theme'),
    'description' => __('Slider with background image or video', 'base-theme'),
    'category' => 'custom',
    'icon' => 'align-full-width',
    'align' => 'full',
    'supports' => [
        'mode' => false,
        'align' => ['full', 'wide'],
        'anchor' => true,
        'jsx' => true,
    ],
];

$controller = function ($block_attributes) {
    return array_merge($block_attributes, []);
};
