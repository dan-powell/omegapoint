<?php

// Returns an image from a particular disk & path
// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/MediaResponseHandler.php';
(new App\MediaResponseHandler(__DIR__ . '/..'))->handle();
