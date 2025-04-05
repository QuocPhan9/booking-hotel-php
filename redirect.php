<?php

require __DIR__ . "/vendor/autoload.php";

$client = new Google\Client;

$client ->setClientId("API_KEY");
$client ->setClientSecret("API_SECRET");
$client-> setRedirectUri("http://localhost/booking-hotel-php/redirect.php");

if ( ! isset($_GET["code"])) {

    exit("Login failed");

}

$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

$client->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($client);

$userinfo = $oauth->userinfo->get();

var_dump(
    $userinfo->email,
    $userinfo->familyName,
    $userinfo->givenName,
    $userinfo->name
);