<?php

/**
 * Register application modules
 */


$register_modules = array();

foreach ($modules as $module_key => $module) {
    $register_modules[$module_key] = [
        'className' => $module['namespace'] . '\Module',
        'path' => MODULES_PATH . '/' . $module_key . '/Module.php',
    ];
}

$application->registerModules($register_modules);
