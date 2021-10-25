<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\ElephantBird;
use Coderjerk\ElephantBird\Compliance\BatchCompliance;

$twitter = new ElephantBird;

//users example
$user = $twitter->user('coderjerk');

$followers = $user->followers();
$following = $user->following();
