<?php

$autoloader = require __DIR__.'/../vendor/autoload.php';
$autoloader->add('deit\\event', [ __DIR__.'/../src', __DIR__.'/../tests' ]);
