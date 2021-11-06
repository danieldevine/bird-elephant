# Manage Tweets
### How to build and send a tweet

The library provides some handy classes to build a tweet object. Method chaining is used to easily build up the tweet object before send. Here are some examples, everything here requires User Context auth.

#### Send a text only tweet

```php
$twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);

$tweet = (new \Coderjerk\BirdElephant\Tweet)->text("Coderjerk is so cool. I'd love to help his work out by sponsoring him.");

$twitter->tweets()->tweet($tweet);
```
#### Quote tweet
```php
use Coderjerk\BirdElephant\Compose\Tweet;

$tweet = (new Tweet)->text('more people need to be talking about this')
    ->quoteTweetId('1456978214837006343');

$twitter->tweets()->tweet($tweet);
```
#### Builders
The library provides object builders for Media, Replies, Polls and Geo data, which can then be passed as objects to the tweet builder. Sound complicated? It isn't.

#### Send a tweet with Geo Data
(requires the user to have enabled geo location in their Twitter settings)

```php
//  create a new Geo composer object and set the placeId property.
$geo = (new \Coderjerk\BirdElephant\Compose\Geo)->placeId('5a110d312052166f');

//set the geo object as the geo property of the tweet. notice hpw we're using method chaining to set other properties at the same time?
$tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text('more people need to be talking about this')
    ->quoteTweetId('1456978214837006343')
    ->geo($geo);

$twitter->tweets()->tweet($tweet);
```
#### Send a tweet with image media attachments
The Twitter API v2 doesn't yet support media uploads, so for the time being we are using the v1.1 media upload endpoint to upload an image and attach it to a tweet. We will match that functionality as it comes online in Twitter API v2

```php
// first, use the tweeets()->upload method to upload your image file
$image = $twitter->tweets()->upload('./img/chris_de_burgh.png');

//pass the returned media id to a media object as an array
$media = (new \Coderjerk\BirdElephant\Compose\Media)->mediaIds([$image->media_id_string]);

//compose the tweet and pass alog the media object
$tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text('Thanks @coderjerk')
    ->media($media);
```

#### Reply to a tweet
```php
//build a reply object with the id of the tweet to reply to
$reply = (new \Coderjerk\BirdElephant\Compose\Reply)->inReplyToTweetId('1456978214837006343');

$tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text('Agreed, Bird Elephant is the best twitter API v2 php library going.')
    ->reply($reply);
```

