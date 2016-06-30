<?php

switch ($_SERVER["SERVER_NAME"]) {

    case 'example.com':
        $env = 'prod';
        break;

    case 'stag.example.com':
        $env = 'stag';
        break;

    case 'dev.example.com':
    case 'test.example.com':
        $env = 'dev';
        break;

    default:
        $env = 'local';
        break;
}

return $env;
