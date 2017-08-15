<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * return [
 *     'environment name' => [
 *         'path' => 'directory storing the local files',
 *         'skipFiles'  => [
 *             // list of files that should only copied once and skipped if they already exist
 *         ],
 *         'setWritable' => [
 *             // list of directories that should be set writable
 *         ],
 *         'setExecutable' => [
 *             // list of files that should be set executable
 *         ],
 *         'relativeSymlinks' => 'Whether need to create relative symlinks (true/false)? By default: false.',
 *         'createSymlink' => [
 *             // list of symlinks to be created. Keys are symlinks, and values are the targets.
 *         ],
 *     ],
 * ];
 */
return [
    'dev' => [
        'path' => 'dev',
        'setWritable' => [
            'public/assets',
            'data/cache',
        ],
        'setExecutable' => [
            'bin/console',
            'bin/console-test',
        ],
        'relativeSymlinks' => true,
        'createSymlinks' => [
            'module/Application/assets/css/bs' => 'vendor/npm-asset/bootstrap/less'
        ],
    ],
];
