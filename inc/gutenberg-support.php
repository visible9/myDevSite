<?php

use theme\Util;

// Enqueue Styles & Scripts
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style(
        'blocks.css',
        \asset_path('styles/blocks.css')
    );

    wp_enqueue_script(
        'gutenberg.js',
        \asset_path('scripts/gutenberg.js'),
        [
            'runtime.js',
            'ext.js',
            'react-jsx-runtime',
            'wp-block-editor',
            'wp-components',
            'wp-compose',
            'wp-dom-ready',
            'wp-i18n',
            'wp-blocks',
            'wp-element',
            'wp-editor',
        ],
    );
});

add_action('init', function () {
    // Register ACF Gutenberg blocks
    if (function_exists('acf_register_block_type')) {
        $acf_blocks_dir = get_theme_file_path() . '/assets/gutenberg/acf-blocks';
        $acf_blocks = glob(get_theme_file_path() . '/assets/gutenberg/acf-blocks/**/index.php');

        foreach ($acf_blocks as $filename) {
            (function () use ($filename, $acf_blocks_dir) {
                require $filename;

                /**
                 * @global $controller
                 */
                $dir_name = str_replace($acf_blocks_dir, '', dirname($filename));
                $isAcfBlock = 0 === strpos($dir_name, '/acf-');
                $template = dirname($filename) . '/template.php';
                $hasTemplate = file_exists($template);
                $hasController = isset($controller);

                if (!isset($name)) {
                    user_error(
                        "error registering example block: {$filename} does not declare the block name in \$name",
                        E_USER_ERROR
                    );

                    return;
                }

                if (!$hasTemplate) {
                    user_error(
                        "error registering example block: {$filename} doesn't have a template.php file next to it!",
                        E_USER_ERROR
                    );
                }

                if ($isAcfBlock && $hasController) {
                    \acf_register_block_type(array_merge(
                        [
                            'name' => $name,
                            'render_callback' => function ($block, $content, $is_preview, $post_id) use ($template, $controller) {
                                $atts = $controller([
                                    'block' => $block,
                                    'content' => $content,
                                    'is_preview' => $is_preview,
                                    'post_id' => $post_id,
                                    'fields' => get_fields(),
                                ]);
                                render_block_template($template, $atts);
                            },
                        ],
                        $settings ?? []
                    ));
                } elseif ($isAcfBlock && !$hasController) {
                    \acf_register_block_type(array_merge(
                        [
                            'name' => $name,
                            'render_callback' => function ($block, $content, $is_preview, $post_id) use ($template) {
                                $atts = [
                                    'block' => $block,
                                    'content' => $content,
                                    'is_preview' => $is_preview,
                                    'post_id' => $post_id,
                                    'fields' => get_fields(),
                                ];

                                render_block_template($template, $atts);
                            },
                        ],
                        $settings ?? []
                    ));
                } else {
                    register_block_type($name);
                }
            })();
        }
    }

    // Register custom Gutenberg blocks
    $custom_blocks = glob(get_theme_file_path() . '/assets/gutenberg/custom-blocks/**/index.php');

    foreach ($custom_blocks as $filename) {
        (function () use ($filename) {
            require $filename;

            /**
             * @global $controller
             */
            $blockDir = dirname($filename);
            $template = $blockDir . '/template.php';
            $hasTemplate = file_exists($template);
            $blockJson = $blockDir . '/block.json';
            $hasBlockJson = file_exists($blockJson);
            $hasRender = isset($render);
            $hasController = isset($controller);
            $args = [];

            if (!$hasBlockJson) {
                user_error(
                    "error registering dynamic block: {$filename}. Metadata file not found at {$blockJson}."
                    . ' see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/'
                    . ' for details on block metadata files.',
                    E_USER_ERROR
                );

                return;
            }

            if ($hasRender && $hasTemplate) {
                user_error(
                    "error registering dynamic block: {$filename} declares a \$render callback
                        even though there is an index.blade.php template. Please use either one or the other!",
                    E_USER_ERROR
                );
            }

            if ($hasController && !$hasTemplate) {
                user_error(
                    "error registering dynamic block: {$filename} declares a \$controller function
 but does not provide an index.blade.php template. Please add a template for the block to function properly!",
                    E_USER_ERROR
                );
            }

            if ($hasController && $hasRender) {
                user_error(
                    "error registering dynamic block: {$filename} declares a \$controller function
 and \$render callback. Either use a \$controller with an index.blade.php template or a \$render callback!",
                    E_USER_ERROR
                );
            }

            if (!$hasTemplate && !$hasRender) {
                user_error(
                    "error registering dynamic block: {$filename} does provide neither a \$render callback
 nor is there an index.blade.php template next to it!",
                    E_USER_ERROR
                );
            }

            if (isset($render)) {
                $args['render_callback'] = $render;
            } elseif ($hasTemplate && !$hasController) {
                $args['render_callback'] = function ($block_attributes, $content, $block) use ($template) {
                    $atts = array_merge($block_attributes, [
                        'content' => $content,
                        'block' => $block,
                    ]);

                    return render_block_template($template, $atts);
                };
            } elseif ($hasTemplate && $hasController) {
                $args['render_callback'] = function ($block_attributes, $content, $block) use ($template, $controller) {
                    $atts = $controller($block_attributes, $content, $block);

                    return render_block_template($template, $atts);
                };
            }

            register_block_type($blockJson, $args);
        })();
    }
});
