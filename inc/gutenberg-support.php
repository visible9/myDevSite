<?php

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
            'wp-edit-post',
            'wp-blocks',
            'wp-i18n',
            'wp-components',
            'wp-rich-text',
        ],
    );

    wp_localize_script(
        'gutenberg.js',
        'globalData',
        [
            'acfBlocks' => function_exists('acf_get_block_types') ? acf_get_block_types() : [],
        ]
    );
});

add_action('init', function () {
    // Register ACF Gutenberg blocks
    if (function_exists('acf_register_block_type')) {
        $acf_blocks_dir = get_theme_file_path() . '/assets/gutenberg/blocks';
        $acf_blocks = glob(get_theme_file_path() . '/assets/gutenberg/blocks/**/index.php');

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
});
