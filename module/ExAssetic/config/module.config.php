<?php

/**
 * The ExAssetic module configurations.
 */

namespace ExAssetic;

return [
    'ex_assetic' => [],
    'service_manager' => [
        'invokables' => [
            'AsseticCacheBuster' => \AsseticBundle\CacheBuster\LastModifiedStrategy::class,
        ],
        'factories' => [
            \Assetic\Filter\Sass\SassFilter::class => Filter\Sass\SassFilterFactory::class,
            \Assetic\Filter\Yui\CssCompressorFilter::class => Filter\Yui\CssCompressorFilterFactory::class,
            \Assetic\Filter\UglifyJs2Filter::class => Filter\UglifyJs2FilterFactory::class,

            Options\ModuleOptions::class => Options\ModuleOptionsFactory::class,
        ],
        'aliases' => [
            'CssCompressorFilter' => \Assetic\Filter\Yui\CssCompressorFilter::class,
            'UglifyJs2Filter' => \Assetic\Filter\UglifyJs2Filter::class,
            'SassFilter' => \Assetic\Filter\Sass\SassFilter::class,
        ],
    ],
];
