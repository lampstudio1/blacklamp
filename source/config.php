<?php
require_once 'vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setApplicationName("Blacklamp");
$google_client->setClientId('1003920048784-nhd6obcgrjj6mfoebrglav6k1mn6icad.apps.googleusercontent.com');
$google_client->setClientSecret('9xiMTsyYlCIUfTWB5i984Jtg');
$google_client->setRedirectUri('https://blacklamp.lampstudio.xyz/sign');
$google_client->addScope('email');
$google_client->addScope('openid');

session_start();
?>
