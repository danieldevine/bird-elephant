<?php
require_once('bootstrap.php');

session_start();

if (!isset($_SESSION['token_credentials'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

$tokenCredentials = unserialize($_SESSION['token_credentials']);

$credentials = array(
    'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
    'consumer_key' => $_ENV['TWITTER_API_KEY'],
    'consumer_secret' => $_ENV['TWITTER_SECRET'],
    'token_identifier' => $tokenCredentials->getIdentifier(),
    'token_secret' => $tokenCredentials->getSecret(),
);

$twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);



//optional
$geo = new \Coderjerk\BirdElephant\Compose\Geo;
$media = new \Coderjerk\BirdElephant\Compose\Media;
$poll = new \Coderjerk\BirdElephant\Compose\Poll;
$reply = new \Coderjerk\BirdElephant\Compose\Reply;

$reply->inReplyToTweetId('1456978214837006343');
// //upload an image
// $image = $twitter->tweets()->upload('./img/chris.png');

// //pass the returned media id to the media object
// $media->mediaIds([$image->media_id_string]);

// //set geo information, requires opt in in user profile
// $geo->placeId('5a110d312052166f');

// //compose the tweet
// $tweet->text('you couldnt make it up @coderjerk')
//     ->replySettings('mentionedUsers')
//     ->geo($geo)
//     ->media($media);


//tweet builder
$tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text('cant stop thinkig about this')->quoteTweetId('1456978214837006343');

//send the tweet
$send = $twitter->tweets()->tweet($tweet);
dump($send);

// // $unsend = $twitter->tweets()->delete('1456905898044055554');
// // dump($unsend);

// // $tweet = $twitter->tweets()->get('1456928466629189633', ['expansions' => 'geo.place_id']);
// // dump($tweet);
