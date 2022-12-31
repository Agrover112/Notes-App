<?php

// Define database connection constants using environment variables
define('servername', getenv('DB_HOST'));
define('username', getenv('DB_USER'));
define('password', getenv('DB_PASS'));
define('dbname', getenv('DB_NAME'));
