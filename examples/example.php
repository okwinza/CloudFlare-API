<?
require_once '../okw/CF.php';
require_once '../okw/CFException.php';

$email = 'email';
$token = 'token';


$cf = new okw\CF($email,$token);

try {

    $response = $cf->rec_new(array(
        'z' => 'okwinza.ru',
        'name' => 'new.okwinza.ru',
        'ttl' => 1,
        'type' => 'A',
        'content' => '1.2.3.4'
    ));



    echo "<pre>" . print_r($response, 1) . "</pre>";


}catch(okw\CFException $e){
    echo 'Error: ' . $e->getMessage();
}


