<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerNamespaces(
    [
        'App\Controllers' => $config->application->controllersDir,
        'App\Models' => $config->application->modelsDir,
        'App\Forms' => $config->application->formsDir,
        'App\Libraries' => $config->application->libraryDir
    ]
)->register();
