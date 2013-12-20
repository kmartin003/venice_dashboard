<?
ini_set('display_errors', 1);

require_once('../twitter-api-php/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "2229859416-O7Tlj8DcPWyO9f6REFzEDbfPk6n6KSB5IVyGhc4",
    'oauth_access_token_secret' => "7oL5Cci8PQRMdlPwC6SZ07iOZyTwEfeMxM3waTdffXaPW",
    'consumer_key' => "rTNAbJaLZ6Z80XfvCzOYw",
    'consumer_secret' => "c9ybjc2Anewwh0Jb8pzvQs8VxwJ0LXzf7xvNeLhw3AM"
);

$url = 'https://api.twitter.com/1.1/statuses/update.json';
$requestMethod = 'POST';

$postfields = array(
    'status' => 'No acqua alta expected this week!'
);

$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();
?>