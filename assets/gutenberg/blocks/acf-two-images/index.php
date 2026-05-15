<?php

/**
 * The name variable is required and should NOT include the namespace.
 */
$name = 'two-images';

/**
 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
$settings = [
    'title' => __('Two Images', 'base-theme'),
    'description' => __('Block with two images side by side', 'base-theme'),
    'category' => 'custom',
    'icon' => 'format-image',
    'supports' => [
        'mode' => false,
        'align' => ['wide', 'full'],
        'anchor' => true,
        'jsx' => true,
    ],
];

