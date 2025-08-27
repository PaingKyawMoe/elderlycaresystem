<?php

// DB Params (match docker-compose environment)
define('DB_HOST', 'db'); // use service name of MySQL container
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'mvcoop');

// Define App Root
define('APPROOT', dirname(dirname(__FILE__)));

// Define URL Root for Docker
define('URLROOT', 'http://localhost:8000');

// Define SITENAME
define('SITENAME', 'Elderly Care');

// Define Roles
define('Admin', 1);
define('User', 2);

define('OPENAI_API_KEY', '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');
