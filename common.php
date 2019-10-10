<?php

define("DS", DIRECTORY_SEPARATOR);
define("DIR_ROOT", dirname(__FILE__) . DS);

set_time_limit(0);
ini_set('max_execution_time ', 0);

date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';