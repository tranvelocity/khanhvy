<?php
$env = 'prod';

if (strstr($_SERVER['HTTP_HOST'], 'local')) {
    $env = 'local';
}

if (strstr($_SERVER['HTTP_HOST'], 'stage')) {
    $env = 'stage';
}

require_once(ABSPATH . 'config/wp-config-' . $env . '.php');
