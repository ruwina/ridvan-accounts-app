<?php

require_once __DIR__ . "/vendor/autoload.php";
$f3 = Base::instance();

/**
 * Load main Configuration
 */
$f3->config('config/config.ini');

/**
 * Load Route Config
 */
$f3->config('config/routes.ini');

$f3->run();

