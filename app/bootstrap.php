<?php

// load config
require_once 'config/config.php';
require_once 'config/secrets.php';

// load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/ajax_handler.php';

//load libraries
require_once 'vendor/autoload.php';

// Autoload Core Libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
