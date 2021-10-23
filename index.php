<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\ElephantBird;

$twitter = new ElephantBird;

$user = $twitter->user('coderjerk');

$followers = $user->followers();
$following = $user->following();

?>

<pre>
    use Coderjerk\ElephantBird\ElephantBird;

    $twitter = new ElephantBird;

    $user = $twitter->user('coderjerk');

    $followers = $user->followers();
    $following = $user->following();
</pre>
