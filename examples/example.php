<?php
require_once '../okw/CF/CF.php';
require_once '../okw/CF/CFException.php';


/**
 * In this example we try to create a subdomain(A-type DNS record).
 * Given we have our domain' DNS managed by CloudFlare.
 */

$email = '{EMAIL}';
$token = '{TOKEN}';

$zoneName = 'yoursite.com';
$hostName = 'new.yoursite.com';

$cf = new okw\CF\CF($email, $token);

try {

    $response = $cf->rec_new(array(
        'z'    => $zoneName,
        'name' => $hostName,
        'ttl'  => 1,
        'type'    => 'A',
        'content' => '1.2.3.4'
    ));

}catch (okw\CF\Exception\CFException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}


