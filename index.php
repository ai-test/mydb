<?php
// check php
if (version_compare(PHP_VERSION, '5.3.0', '<')) die('require PHP > 5.3.0 !');

// debug: true
define('APP_DEBUG', true);

// deny safe folder files generator
define('BUILD_DIR_SECURE', false);

// app
define('APP_PATH', './Application/');

// include ThinkPHP
require './ThinkPHP/ThinkPHP.php';