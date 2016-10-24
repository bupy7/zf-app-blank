<?php

/**
 * The ExAssetic module configurations.
 */

use Assetic\Filter\LessFilter;
use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\Yui\JsCompressorFilter;
use ExAssetic\Filter\LessFilterFactory;
use ExAssetic\Filter\Yui\CssCompressorFilterFactory;
use ExAssetic\Filter\Yui\JsCompressorFilterFactory;
use ExAssetic\Options\ModuleOptions;
use ExAssetic\Options\ModuleOptionsFactory;
use AsseticBundle\CacheBuster\LastModifiedStrategy;
use Assetic\Filter\UglifyJs2Filter;
use ExAssetic\Filter\UglifyJs2FilterFactory;

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
            'AsseticCacheBuster' => LastModifiedStrategy::class,
        ],
        'factories' => [
            LessFilter::class => LessFilterFactory::class,
            CssCompressorFilter::class => CssCompressorFilterFactory::class,
            JsCompressorFilter::class => JsCompressorFilterFactory::class,
            ModuleOptions::class => ModuleOptionsFactory::class,
            UglifyJs2Filter::class => UglifyJs2FilterFactory::class,
        ],
        'aliases' => [
            'LessFilter' => LessFilter::class,
            'CssCompressorFilter' => CssCompressorFilter::class,
            'JsCompressorFilter' => CssCompressorFilter::class,
            'UglifyJs2Filter' => UglifyJs2Filter::class,
        ],
    ],
];
