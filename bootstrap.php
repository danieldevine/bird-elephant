<?php

//setup composer autoloading
require __DIR__ . '/vendor/autoload.php';

//setup dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();