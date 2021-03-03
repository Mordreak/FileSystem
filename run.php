<?php

require_once 'app/start.php';

use Sourcecode\Prompt;

define('APP_ROOT', getcwd());

$prompt = Prompt::getInstance();
$prompt->readCommand();
