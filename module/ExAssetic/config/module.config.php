<?php

/**
 * The ExAssetic module configurations.
 */

namespace ExAssetic;

return [
    'ex_assetic' => [
        'node_bin' => '/usr/bin/node',
        'node_paths' => [],
        'yui_path' => '',
        'java_path' => '/usr/bin/java',
        'uglify_js2_path' => '',
    ],
    'service_manager' => [
        'invokables' => [
            'AsseticCacheBuster' => \AsseticBundle\CacheBuster\LastModifiedStrategy::class,
        ],
        'factories' => [
            \Assetic\Filter\LessFilter::class => Filter\LessFilterFactory::class,
            \Assetic\Filter\Yui\CssCompressorFilter::class => Filter\Yui\CssCompressorFilterFactory::class,
            Options\ModuleOptions::class => Options\ModuleOptionsFactory::class,
            \Assetic\Filter\UglifyJs2Filter::class => Filter\UglifyJs2FilterFactory::class,
        ],
        'aliases' => [
            'LessFilter' => \Assetic\Filter\LessFilter::class,
            'CssCompressorFilter' => \Assetic\Filter\Yui\CssCompressorFilter::class,
            'UglifyJs2Filter' => \Assetic\Filter\UglifyJs2Filter::class,
        ],
    ],
];
